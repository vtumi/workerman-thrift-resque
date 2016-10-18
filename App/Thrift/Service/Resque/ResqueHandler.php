<?php
namespace App\Thrift\Service\Resque;

use Resque;

class ResqueHandler implements ResqueIf
{
    public function enqueue(Request $request)
    {
        return Resque::enqueue($request->queue, "\\App\\Resque\\Job\\" . $request->job, $request->params, $request->trackStatus);
    }
}
