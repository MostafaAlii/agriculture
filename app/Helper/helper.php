<?php
use Gloudemans\Shoppingcart\Facades\Cart;

define('PAGINATION_COUNT', 1);
//////////// Admin Auth date  Helper Function ////
if (! function_exists('admin')) {
	function admin(){
		return auth()->guard('admin');
	}
}

if (! function_exists('vendor')) {
	function vendor(){
		return auth()->guard('vendor');
	}
}

if (! function_exists('farmer')) {
	function farmer(){
		return auth()->guard('web');
	}
}
//////////// Admin Auth date  Helper Function /////

if(!function_exists('load_dep')){
    function load_dep($select =null,$dep_hide=null){

        $admin_departments =  App\Models\AdminDepartment::select('admin_department_translations.name as text',
            'admin_departments.id as id','admin_departments.parent as parent')

            ->join('admin_department_translations','admin_departments.id','=','admin_department_translations.admin_department_id')
            ->get(['text','parent','id']);

        $dep_arr =[];
        foreach ($admin_departments as $admin_department){
            $list_arr =[];
            $list_arr['icon']='';
            $list_arr['li_attr'] = '';
            $list_arr['a_attr']  = '';
            $list_arr['children']=[];
            if($select !== null && $select == $admin_department->id)
            {
                $list_arr['state']   = [
                'opened'=>true,
                    'selected'=>true,
                    'disabled'=>false,
                ];
            }
            if($dep_hide !== null and  $dep_hide == $admin_department->id)
            {

                $list_arr['state']   = [
                    'opened'=>false,
                    'selected'=>false,
                    'disabled'=>true,
                    'hidden'=>true,
                ];
            }
            $list_arr['id']=$admin_department->id;
            $list_arr['parent']=$admin_department->parent>0?$admin_department->parent:"#";
            $list_arr['text']=$admin_department->text;
            array_push($dep_arr,$list_arr);
        }
        return json_encode($dep_arr,JSON_UNESCAPED_UNICODE);
    }
}

if(!function_exists('setting')){
    function setting(){
        return App\Models\Setting::orderBy('id','desc')->first();
    }
}

if(!function_exists('treeTypes')){
    function treeTypes(){
        return App\Models\TreeType::get();
    }
}

if(!function_exists('land_category')){
    function land_category($id){
        return App\Models\LandCategory::where('id',$id)->first();
    }
}

if(!function_exists('country')){
    function country(){
        return App\Models\Country::orderBy('id','desc')->first();
    }
}

if(!function_exists('up')){
    function up(){
        return new App\Http\Controllers\Upload;
    }
}

if(!function_exists('image_validate')){
    function image_validate($ext=null){
        if($ext ===null){
            return 'required|image|mimes:png,jpg,jpeg';
        }else{
            return 'image|'.$ext;
        }
    }
}

function uploadImage($folder,$image){
    $image->store('/', $folder);
    $filename = $image->hashName();
    return  $filename;
}
//////////// Discount Coupon  Helper Function /////
if(!function_exists('getCalcDiscountNumbers')){
    function getCalcDiscountNumbers() {
        $subtotal = Cart::instance('cart')->subtotal();
        $discount = session()->has('coupon') ? session()->get('coupon')['discount'] : 0.00;
        $subtotal_after_discount = $subtotal - $discount;
        $tax = config('cart.tax') / 100;
        $taxSymbol = config('cart.tax') . '%';
        $productTaxesInCart = round($subtotal_after_discount * $tax, 2);
        $newSubTotal = $subtotal + $productTaxesInCart;
        $shipping = session()->has('shipping') ? session()->get('shipping')['cost'] : 0.00;
        $total = ($newSubTotal + $shipping) > 0 ? round($newSubTotal + $shipping, 2) : 0.00;
        return collect([
            'subtotal' => $subtotal,
            'tax' => $tax,
            'taxSymbol' => $taxSymbol,
            'productTaxesInCart' => (float)$productTaxesInCart,
            'newSubTotal' => (float)$newSubTotal,
            'discount' => (float)$discount,
            'shipping' => (float)$shipping,
            'total' => (float)$total,
        ]);
    }
}