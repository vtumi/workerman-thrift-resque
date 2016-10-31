<?php
/**
 * run with command
 * php start.php start
 */

require_once __DIR__ . '/vendor/autoload.php';

use App\Worker;
use App\Thrift\ThriftWorker;
use App\Resque\ResqueWorker;

// 检查扩展
if (!extension_loaded('pcntl')) {
    exit("Please install pcntl extension. See http://doc3.workerman.net/install/install.html\n");
}

if (!extension_loaded('posix')) {
    exit("Please install posix extension. See http://doc3.workerman.net/install/install.html\n");
}

Worker::$logFile = __DIR__ . '/workerman.log';
Worker::$pidFile = __DIR__ . '/workerman.pid';

// 初始化所有服务
$worker = new ThriftWorker('tcp://0.0.0.0:9090');
$worker->count = 16;
$worker->class = 'Resque';

$worker = new ResqueWorker();
$worker->count = 16;

// 运行所有服务
Worker::runAll();
