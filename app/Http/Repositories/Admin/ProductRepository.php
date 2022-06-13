<?php
namespace App\Http\Repositories\Admin;
use App\Models\{Tag, Farmer, Product, Category, Unit};
use Illuminate\Support\Facades\{DB, Crypt};
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
        /*$data = [];
        $data['farmers']        =       Farmer::select('id', 'firstname', 'lastname')->get();
        $data['tags']           =       Tag::select('id')->get();
        $data['categories']    =       Category::select('id')->get();*/
        //dd($data['categories']);
    //return view('dashboard.admin.products.create'/*, $data*/);
    $product = Product::create([
            'name'          =>      '', // For Create Empty Row
        ]);
		if (!empty($product)) {
            return redirect()->route('Products.edit', encrypt($product->id));
            //return redirect(aurl('products/'.$product->id.'/edit'));
		}
    }

    public function store($request) {
    }

    public function edit($id) {
        $real_id= Crypt::decrypt($id);
        $data = [];
        $data['product']        =       Product::findOrfail($real_id);
        $data['farmers']        =       Farmer::select('id', 'firstname', 'lastname')->get();
        $data['tags']           =       Tag::select('id')->get();
        $data['categories']    =       Category::select('id')->get();
        $data['units']    =       Unit::select('id')->get();
        return view('dashboard.admin.products.create', $data);
    }
}
