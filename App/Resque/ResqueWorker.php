<?php
/**
 * Resque worker.
 *
 * @author tumi<tumi@phphy.com>
 */
namespace App\Resque;

use Resque;
use Resque_Log;
use Resque_Worker;
use Psr\Log\LogLevel;
use Workerman\Worker;
use Workerman\Lib\Timer;

class ResqueWorker extends Worker
{
    /**
     * 设置redis服务器
     * @var string
     */
    public $server = '127.0.0.1:6379';

    /**
     * 设置日志级别
     * @var integer
     */
    public $logLevel = 0;

    /**
     * 设置监视队列
     * @var string
     */
    public $queue = '*';

    /**
     * 设置定时器
     * @var float
     */
    public $interval = 1;

    /**
     * construct
     */
    public function __construct()
    {
        parent::__construct();

        $worker = null;
        $this->onWorkerStart = function () use (&$worker) {
            Resque::setBackend($this->server);
            $logger = new Resque_Log($this->logLevel);

            $queues = explode(',', $this->queue);
            $worker = new Resque_Worker($queues);
            $worker->setLogger($logger);
            $logger->log(LogLevel::NOTICE, 'Starting worker {worker}', array('worker' => $worker));
            $worker->work($this->interval);
        };
        $this->onWorkerStop = function () use (&$worker) {
            $worker->shutdown = true;
        };
    }
}
