<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\ProfileInterface;
use App\Http\Requests\Dashboard\AdminRequest;
use App\Http\Requests\Dashboard\ProfileAccountRequest;
use App\Http\Requests\Dashboard\ProfileInformationRequest;
use App\Models\Admin;
use App\Models\Country;
use App\Models\Province;
use App\Models\ProvinceTranslation;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\UploadT;
class ProfileController extends Controller {
    use UploadT;
    protected $Data;
    public function __construct(ProfileInterface $Data) {
        $this->Data = $Data;
    }
    public function index() {

        return $this->Data->index();
    }
    public function edit($id) {
        return $this->Data->edit($id);
    }// end of edit

    public function updateAccount(ProfileAccountRequest $request,$id) {
        return $this->Data->updateAccount($request,$id);

    }// end of update
    public function updateInformation(ProfileInformationRequest $request,$id) {
        return $this->Data->updateInformation($request,$id);
    }// end of update
    public function getProvince($country_id)
    {
        return $this->Data->getProvince($country_id);
    }
    public function getArea($province_id)
    {
        return $this->Data->getArea($province_id);
    }

}
