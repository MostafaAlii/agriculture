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
    public function chicken_project_statistics(){
        return $this->Data->chicken_project_statistics();

    }
}
