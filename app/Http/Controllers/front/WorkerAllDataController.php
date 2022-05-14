<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Front\WorkerAllDataInterface;

class WorkerAllDataController extends Controller
{
    protected $Data;
    public function __construct(WorkerAllDataInterface $Data) {
        $this->Data = $Data;
    }


    public function get_worker()
    {
        return $this->Data->get_worker();
    }

    public function worker_detail($id)
    {
        return $this->Data->worker_detail($id);
    }
}
?>
