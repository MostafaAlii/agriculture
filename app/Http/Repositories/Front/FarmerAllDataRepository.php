<?php
namespace  App\Http\Repositories\Front;
use App\Models\Farmer;
use App\Http\Interfaces\Front\FarmerAllDataInterface;
use Livewire\WithPagination;

class FarmerAllDataRepository implements FarmerAllDataInterface{
    use WithPagination;
    //--------------------------------------------------------------------
    public function get_farmer() {
        $data['farmers']= Farmer::orderby('id','desc')->paginate(6);
        //$data['farmers']= Farmer::orderby('id','desc')->paginate(12);
        return view('livewire.front.farmers',$data);
    }
    //--------------------------------------------------------------------
    public function farmer_detail($id) {
        $real_id=decrypt($id);
        $data['farmers']= Farmer::findOrFail($real_id);
        $data['comments'] = $data['farmers']->comments()->whereNull('parent_id')->orderby('id','desc')->simplePaginate(5);

        $farmerSum =  $data['farmers']->ratings->sum(function($item){ // $item isrelated to the guardTable (User or Other)
            return $item->pivot->rating;
        });
        if($data['farmers']->ratings->count()){
            $data['avg'] = 10*($farmerSum /  $data['farmers']->ratings->count());
        }else{ $data['avg']=0;}
        return view('livewire.front.farmer_details',$data);
    }
}
?>
