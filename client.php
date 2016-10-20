<?php
require_once __DIR__ . '/vendor/autoload.php';

use Thrift\Protocol\TBinaryProtocol;
use Thrift\Transport\TSocket;
use Thrift\Transport\TBufferedTransport;
use App\Thrift\Service\Resque\ResqueClient;
use App\Thrift\Service\Resque\Request;

// Init
$socket = new TSocket('127.0.0.1', 9090);
$transport = new TBufferedTransport($socket, 1024, 1024);
$protocol = new TBinaryProtocol($transport);
$client = new ResqueClient($protocol);

// Config
$socket->setSendTimeout(30 * 1000);
$socket->setRecvTimeout(30 * 1000);

// Connect
$transport->open();

// 添加作业
$request = new Request();
$request->queue = 'default';
$request->job = 'Demo';
$request->params = ['str' => 'this is a test!'];
$request->trackStatus = true;
$response = $client->enqueue($request);

// 删除作业
/*
$request = new Request();
$request->queue = 'default';
$request->job = 'Demo';
$response = $client->dequeue($request);

$request = new Request();
$request->queue = 'default';
$request->job = 'Demo';
$request->id = '';
$response = $client->dequeue($request);

$request = new Request();
$request->queue = 'default';
$request->job = 'Demo';
$request->params = ['str' => 'this is a test!'];
$response = $client->dequeue($request);

$request = new Request();
$request->queue = 'default';
$request->jobs = ['Demo1', 'Demo2'];
$response = $client->dequeue($request);
 */

// 作业状态
/*
$id = '';
$response = $client->track($id);
*/

// Print response...
var_dump($response);

// Close
$transport->close();
