<?php
namespace App\Http\Interfaces\Front;
interface WorkerAllDataInterface {
    public function get_worker();
    public function worker_details($id);
}
?>
