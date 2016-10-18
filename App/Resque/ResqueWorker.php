<?php
namespace App\Resque;

use Resque;
use Resque_Worker;
use Workerman\Worker;
use Psr\Log\LogLevel;

class ResqueWorker extends Worker
{
    /**
     * 设置类名称
     * @var string
     */
    public $server = '127.0.0.1:6379';
    public $queue = '*';
    public $interval = 0.5;

    /**
     * construct
     */
    public function __construct()
    {
        parent::__construct();

        $worker = null;
        $this->onWorkerStart = function() use(&$worker) {
            Resque::setBackend($this->server);

            $queues = explode(',', $this->queue);
            $worker = new Resque_Worker($queues);
            $worker->logger->log(LogLevel::NOTICE, 'Starting worker {worker}', array('worker' => $worker));
            $worker->work($this->interval);
        };

        $this->onWorkerStop = function () use (&$worker) {
            $worker->unregisterWorker();
        };
    }
}
