<?php
namespace  App\Http\Repositories\Front;
use App\Models\Worker;
use App\Http\Interfaces\Front\WorkerAllDataInterface;
use Livewire\WithPagination;

class WorkerAllDataRepository implements WorkerAllDataInterface{
    use WithPagination;
    //--------------------------------------------------------------------
    public function get_worker() {
        $data['workers']= Worker::orderby('id','desc')->paginate(6);
        return view('livewire.front.workers',$data);
    }
    //--------------------------------------------------------------------
    public function worker_detail($id) {
        $real_id=decrypt($id);
        $data['workers']= Worker::findOrFail($real_id);
        $data['comments'] = $data['workers']->comments()->whereNull('parent_id')->orderby('id','desc')->simplePaginate(5);

        $workerSum =  $data['workers']->ratings->sum(function($item){ // $item isrelated to the guardTable (User or Other)
            return $item->pivot->rating;
        });
        if($data['workers']->ratings->count()){
            $data['avg'] = 10*($workerSum /  $data['workers']->ratings->count());
        }else{ $data['avg']=0;}
        return view('livewire.front.worker_details',$data);
    }
}
?>
