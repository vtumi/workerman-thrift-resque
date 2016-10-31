<?php
/**
 * This file is part of workerman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link http://www.workerman.net/
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Thrift;

use App\Worker;
use Thrift\Transport\TSocket;

class ThriftWorker extends Worker
{
    /**
     * Thrift processor
     * @var object
     */
    protected $processor = null;

    /**
     * 使用的协议,默认TBinaryProtocol,可更改
     * @var string
     */
    public $thriftProtocol = 'TBinaryProtocol';

    /**
     * 使用的传输类,默认是TBufferedTransport，可更改
     * @var string
     */
    public $thriftTransport = 'TBufferedTransport';

    /**
     * 设置类名称
     * @var string
     */
    public $class = '';

    /**
     * construct
     */
    public function __construct($socket_name)
    {
        parent::__construct($socket_name);
        $this->onWorkerStart = array($this, 'onStart');
        $this->onConnect = array($this, 'onConnect');
    }

    /**
     * 进程启动时做的一些初始化工作
     * @return void
     */
    public function onStart()
    {
        // 检查类是否设置
        if (!$this->class) {
            throw new \Exception('ThriftWorker->class not set');
        }

        // 设置进程名称
        if ($this->name == 'none') {
            $this->name = $this->class;
        }

        // 检查类是否存在
        $processor_class_name = "\\App\\Thrift\\Service\\" . $this->class . "\\" . $this->class . 'Processor';
        if (!class_exists($processor_class_name)) {
            ThriftWorker::log("Class $processor_class_name not found");
            return;
        }

        // 检查类是否存在
        $handler_class_name = "\\App\\Thrift\\Service\\" . $this->class . "\\" . $this->class . 'Handler';
        if (!class_exists($handler_class_name)) {
            ThriftWorker::log("Class $handler_class_name not found");
            return;
        }

        $handler = new $handler_class_name();
        $this->processor = new $processor_class_name($handler);
    }

    /**
     * 处理收到的数据
     * @param TcpConnection $connection
     * @return void
     */
    public function onConnect($connection)
    {
        $socket = $connection->getSocket();
        $t_socket = new TSocket();
        $t_socket->setHandle($socket);
        $transport_name = '\\Thrift\\Transport\\' . $this->thriftTransport;
        $transport = new $transport_name($t_socket);
        $protocol_name = '\\Thrift\\Protocol\\' . $this->thriftProtocol;
        $protocol = new $protocol_name($transport);

        // 执行处理
        try {
            // 先初始化一个
            $protocol->fname = 'none';
            // 业务处理
            $this->processor->process($protocol, $protocol);
        } catch (\Exception $e) {
            ThriftWorker::log('CODE:' . $e->getCode() . ' MESSAGE:' . $e->getMessage() . "\n" . $e->getTraceAsString() . "\nCLIENT_IP:" . $connection->getRemoteIp() . "\n");
            $connection->send($e->getMessage());
        }

    }

}
