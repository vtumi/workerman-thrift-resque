<?php
namespace App\Thrift\Service\Resque;

use Resque;

class ResqueHandler implements ResqueIf
{
    public function enqueue(Params $params)
    {
        return Resque::enqueue($params->queue, "\\App\\Resque\\Job\\" . $params->job, $params->params, $params->trackStatus);
    }
}
