<?php

namespace App\Http\Controllers\Dashboard\Admin;
use App\Models\ChickenProject;
use App\Models\Farmer;
use App\Models\Admin;
use App\Models\Area;
use App\Models\State;
use App\Models\Village;

use App\Models\AdminDepartment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\Traits\UploadT;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\Dashboard\ChickenRequest;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\ChickenProjectInterface;

class ChickenProjectController extends Controller
{


    protected $Data;
    public function __construct(ChickenProjectInterface $Data) {
        $this->middleware('permission:chicken-project', ['only' => ['index']]);
        $this->middleware('permission:chicken-project-create', ['only' => ['create','store']]);
        $this->middleware('permission:chicken-project-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:chicken-project-delete', ['only' => ['destroy']]);
        $this->middleware('permission:chicken-project-delete-all', ['only' => ['bulkDelete']]);
        $this->middleware('permission:chicken-report-statistics', ['only' => ['chicken_project_statistics']]);
        $this->Data = $Data;
    }

    public function index() {
        return $this->Data->index();
    }
    public function data() {
        return $this->Data->data();
    }
    public function create() {
        return $this->Data->create();
    }

    public function store(ChickenRequest $request) {
        return $this->Data->store($request);
    }

    public function edit($id) {
        return $this->Data->edit($id);
    }

    public function update(ChickenRequest $request, $id) {
        return $this->Data->update($request,$id);
    }

    public function destroy($id) {
        return $this->Data->destroy($id);
    }
    public function bulkDelete(Request $request) {
        return $this->Data->destroy($request);
    }
// index for report
    public function chicken_statistic_index() {
        return $this->Data->chicken_statistic_index();
    }
//filter for report
    public function chicken_project_statistics(Request $request){
        return $this->Data->chicken_project_statistics($request);

    }
}
