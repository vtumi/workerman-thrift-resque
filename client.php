<?php
require_once __DIR__ . '/vendor/autoload.php';

use Thrift\Protocol\TBinaryProtocol;
use Thrift\Transport\TSocket;
use Thrift\Transport\TBufferedTransport;
use App\Thrift\Service\Resque\ResqueClient;
use App\Thrift\Service\Resque\Params;

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

// Call...
$params = new Params();
$params->queue = 'default';
$params->job = 'Demo';
$params->params = ['str' => 'this is a test!'];
$response = $client->enqueue($params);

// Print response...
var_dump($response);

// Close
$transport->close();
