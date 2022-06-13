<?php
namespace App\Http\Repositories\Admin;
use App\Models\{Tag, Farmer, Product, Category};
use Illuminate\Support\Facades\{DB, View, Crypt};
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Traits\UploadT;
use App\Http\Interfaces\Admin\ProductInterface;
class ProductRepository implements ProductInterface {
    use UploadT;
    public function index() {
        return view('dashboard.admin.products.index');
    }

    public function create() {
        $data = [];
        $data['farmers']        =       Farmer::select('id', 'firstname', 'lastname')->get();
        $data['tags']           =       Tag::select('id')->get();
        $data['categories']    =       Category::select('id')->get();
        //dd($data['categories']);
        return view('dashboard.admin.products.generalInformation.create', $data);
    }
}
