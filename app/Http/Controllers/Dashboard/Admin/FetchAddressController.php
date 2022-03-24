<?php

namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Province;
use App\Models\State;
use App\Models\Village;

class FetchAddressController extends Controller
{
    //--------------------------------------------
    public function fetch_provience($id)
    {
        $data= Province::where('country_id',$id)->get()->pluck("name", "id");
        return response()->json($data); //then sent this data to ajax success
       
    }
    //--------------------------------------------
    public function fetch_area($id)
    {
        $data= Area::where('province_id',$id)->get()->pluck("name", "id");
        return response()->json($data); //then sent this data to ajax success
       
    }
    //--------------------------------------------
    public function fetch_state($id)
    {
        $data= State::where('area_id',$id)->get()->pluck("name", "id");
        return response()->json($data); //then sent this data to ajax success
       
    }
    //--------------------------------------------
    public function fetch_village($id)
    {
        $data= Village::where('state_id',$id)->get()->pluck("name", "id");
        return response()->json($data); //then sent this data to ajax success
       
    }
}
