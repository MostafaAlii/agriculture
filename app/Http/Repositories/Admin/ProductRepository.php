<?php
namespace App\Http\Repositories\Admin;
use App\Models\Tag;
use App\Models\Farmer;
use App\Models\Product;
use App\Traits\UploadT;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Crypt;
use App\Http\Interfaces\Admin\ProductInterface;

class ProductRepository implements ProductInterface {
    use UploadT;
    public function index() {
        return view('dashboard.admin.products.index');
    }
}
