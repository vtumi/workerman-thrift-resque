<?php
namespace App\Thrift\Service\Resque;

use Resque;
use Resque_Job_Status;

class ResqueHandler implements ResqueIf
{
    public function enqueue(Request $request)
    {
        if ($request->job) {
            return Resque::enqueue($request->queue, "\\App\\Resque\\Job\\" . $request->job, $request->params, $request->trackStatus);
        }

        return false;
    }

    public function dequeue(Request $request)
    {
        if ($request->job) {
            if ($request->id) {
                return Resque::dequeue($request->queue, [$request->job => $request->id]);
            } elseif ($request->params) {
                return Resque::dequeue($request->queue, [$request->job => $request->params]);
            }

            return Resque::dequeue($request->queue, [$request->job]);
        } elseif ($request->jobs) {
            return Resque::dequeue($request->queue, $request->jobs);
        }

        return false;
    }

    public function track($id)
    {
        $status = new Resque_Job_Status($id);
        return $status->get();
    }
}
