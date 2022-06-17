<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Dashboard\BeeKeeperRequest;
use App\Http\Interfaces\Admin\BeekeeperInterface;

class BeeKeepersController extends Controller
{
    protected $Data;
    public function __construct(BeekeeperInterface $Data) {
        $this->middleware('permission:bee-keepers', ['only' => ['index']]);
        $this->middleware('permission:bee-keepers-create', ['only' => ['create','store']]);
        $this->middleware('permission:bee-keepers-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:bee-keepers-delete', ['only' => ['destroy']]);
        $this->middleware('permission:bee-keepers-delete-all', ['only' => ['bulkDelete']]);
        $this->middleware('permission:bee-keepers-statistics', ['only' => ['statistics']]);
        $this->middleware('permission:bee-keepers-details-statistics', ['only' => ['beekeeper_details_statistics']]);
        $this->Data = $Data;
    }
    public function index(){
            return $this->Data->index();
    }

    public function data(){
        return $this->Data->data();
    }

    public function create(){
        return $this->Data->create();
    }
    public function store(BeeKeeperRequest $request){
        return $this->Data->store($request);
    }
    public function edit( $id){
        return $this->Data->edit($id);
    }
    public function update( BeeKeeperRequest $request, $id){
        return $this->Data->update($request,$id);
    }
    public function destroy($id){
        return $this->Data->destroy($id);
    }
    public function bulkDelete(Request $request){
        return $this->Data->bulkDelete($request);
    }

    //index for report
    public function index_statistics(){
        return $this->Data->index_statistics();

    }
// filter for report
    public function statistics(Request $request){
        return $this->Data->statistics($request);

    }

}
