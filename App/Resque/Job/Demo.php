<?php
namespace App\Resque\Job;

class Demo
{
    public function perform()
    {
        \Workerman\Worker::log($this->args['str']);
    }
}
