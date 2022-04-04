<?php
use App\Http\Livewire;
use Illuminate\Http\Request;
use App\Http\Controllers\front;
use App\Http\Controllers\Dashboard\Admin\AdminDepartmentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\Admin\TagController;
use App\Http\Controllers\Dashboard\Admin\AreaController;
use App\Http\Controllers\Dashboard\Admin\BlogController;
use App\Http\Controllers\Dashboard\Admin\UserController;
use App\Http\Controllers\Dashboard\Admin\AdminController;
use App\Http\Controllers\Dashboard\Admin\StateController;
use App\Http\Controllers\Dashboard\Admin\FarmerController;
use App\Http\Controllers\Dashboard\Admin\OptionController;
use App\Http\Controllers\Dashboard\Admin\SliderController;
use App\Http\Controllers\Dashboard\Admin\CountryController;
use App\Http\Controllers\Dashboard\Admin\ProductController;
use App\Http\Controllers\Dashboard\Admin\ProfileController;
use App\Http\Controllers\Dashboard\Admin\SettingController;
use App\Http\Controllers\Dashboard\Admin\VillageController;
use App\Http\Controllers\Dashboard\Admin\CategoryController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Dashboard\Admin\AttributeController;
use App\Http\Controllers\Dashboard\Admin\DashboardController;
use App\Http\Controllers\Dashboard\Admin\ProvienceController;
use App\Http\Controllers\Dashboard\Admin\DepartmentController;
use App\Http\Controllers\Dashboard\Admin\FetchAddressController;
use App\Http\Controllers\Dashboard\Admin\TreeController;
use App\Http\Controllers\Dashboard\Admin\TreeTypeController;
use App\Http\Controllers\Dashboard\Admin\LandCategoryController;
use App\Http\Controllers\Dashboard\Admin\OrchardController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */


require __DIR__ . '/auth.php';

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:admin'],

    ], function () {
        route::get('/home/admin', Livewire\front\Home2::class)->name('home.admin');
        // route for admin to go to website

        Route::group(['prefix' => 'dashboard_admin'], function () {
            /********************************* Start Admins Dashboard Routes ************************************/
            Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
            /********************************* End Admins Pages Routes ************************************/
            /********************************* Start Admin & Employee Routes ************************************/
            Route::resource('Admins', AdminController::class)->except(['show']);
            Route::get('/Admins/data', [AdminController::class,'data'])->name('admins.data');
            Route::delete('/admins/bulk_delete/{ids}', [AdminController::class,'bulkDelete'])->name('admins.bulk_delete');
            Route::get('/admin/profile/{id}', [AdminController::class,'showProfile'])->name('admin.profile');
            Route::put('/admin/profileupdate/{id}', [AdminController::class,'updateAccount'])->name('admin.updateAccount'); // update admin form account
            Route::put('/admin/profileupdateinfo/{id}', [AdminController::class,'updateInformation'])->name('admin.updateInformation'); //update admin form information
            // route for auth profile Authadmin *******************************************************************
            Route::resource('profile', ProfileController::class)->except(['show']); // route for dashboard profile Auth admin
            Route::put('/profile/profileupdate/{id}', [ProfileController::class,'updateAccount'])->name('profile.updateAccount'); // update auth form account
            Route::put('/profile/profileupdateinfo/{id}', [ProfileController::class,'updateInformation'])->name('profile.updateInformation'); //update auth form information

            // ajax routes ***********************************
            Route::get('/admin/province/{country_id}', [ProfileController::class, 'getProvince']);// route ajax for get country provinces
            Route::get('/admin/area/{province_id}', [ProfileController::class, 'getArea']);// route ajax for get province areas
            Route::get('/admin/state/{area_id}', [ProfileController::class, 'getState']);// route ajax for get areas states
            Route::get('/admin/village/{state_id}', [ProfileController::class, 'getVillage']);// route ajax for get state villages
            /********************************* End Admin & Employee Routes ************************************/
            /********************************* Start Farmer routes ************************************/
            Route::resource('farmers',FarmerController::class)->except(['show']);
            Route::get('/farmers/data', [FarmerController::class,'data'])->name('farmers.data');
            Route::delete('/farmers/bulk_delete/{ids}', [FarmerController::class,'bulkDelete'])->name('farmers.bulk_delete');
            Route::get('/farmer/profile/{id}', [FarmerController::class,'showProfile'])->name('farmer.profile');
            Route::put('/farmer/profileupdate/{id}', [FarmerController::class,'updateAccount'])->name('farmer.updateAccount'); // update farmer form account
            Route::put('/farmer/profileupdateinfo/{id}', [FarmerController::class,'updateInformation'])->name('farmer.updateInformation'); //update farmer form information
            /********************************* end Farmer routes ************************************/
            /********************************* Start User or vendor Routes ************************************/
            Route::resource('users', UserController::class)->except(['show']);
            Route::get('/users/data', [UserController::class,'data'])->name('users.data');
            Route::delete('/users/bulk_delete/{ids}', [UserController::class,'bulkDelete'])->name('users.bulk_delete');
            Route::get('/user/profile/{id}', [UserController::class,'showProfile'])->name('user.profile');
            Route::put('/user/profileupdate/{id}', [UserController::class,'updateAccount'])->name('user.updateAccount'); // update user form account
            Route::put('/user/profileupdateinfo/{id}', [UserController::class,'updateInformation'])->name('user.updateInformation'); //update user form information
            /********************************* end User or vendor Routes ************************************/

            /********************************* Countries Routes ************************************/
            Route::resource('Countries', CountryController::class)->except(['show']);
            Route::get('/Countries/data', [CountryController::class,'data'])->name('Countries.data');
            Route::delete('/Countries/bulk_delete/{ids}', [CountryController::class,'bulkDelete'])->name('Countries.bulk_delete');
            /********************************* End Countries Routes ************************************/

            /********************************* Areas Routes ************************************/
            Route::resource('Areas', AreaController::class)->except(['show']);
            Route::get('/Areas/data', [AreaController::class,'data'])->name('areas.data');
            Route::delete('/Areas/bulk_delete/{ids}', [AreaController::class,'bulkDelete'])->name('areas.bulk_delete');
            /********************************* End Areas Routes ************************************/

            /********************************* Proviences Routes ************************************/
            Route::resource('Proviences', ProvienceController::class)->except(['show']);
            Route::get('/Proviences/data', [ProvienceController::class,'data'])->name('proviences.data');
            Route::delete('/Proviences/bulk_delete/{ids}', [ProvienceController::class,'bulkDelete'])->name('proviences.bulk_delete');
            /********************************* End Proviences Routes ************************************/

            /********************************* States Routes ************************************/
            Route::resource('States', StateController::class)->except(['show']);
            Route::get('/States/data', [StateController::class,'data'])->name('states.data');
            Route::delete('/States/bulk_delete/{ids}', [StateController::class,'bulkDelete'])->name('states.bulk_delete');
            /********************************* End States Routes ************************************/
            /********************************* Villages Routes ************************************/
            Route::resource('Villages', VillageController::class)->except(['show']);
            Route::get('/Villages/data', [VillageController::class,'data'])->name('villages.data');
            Route::delete('/Villages/bulk_delete/{ids}', [VillageController::class,'bulkDelete'])->name('villages.bulk_delete');
            /********************************* End Villages Routes ************************************/

            /********************************* Start settings Routes ************************************/
            Route::get('Settings', [SettingController::class, 'index'])->name('settings');
            Route::post('Settings/store', [SettingController::class, 'store'])->name('settings.store');
            /********************************* End settings Pages Routes ************************************/

            /*******admin departments route********/
            Route::resource('AdminDepartments', AdminDepartmentController::class)->except(['show']);
            /*********end admin departments route ********/

            /*******admin departments route********/
            Route::resource('Orchards', OrchardController::class)->except(['show']);
            Route::get('/Orchards/data', [OrchardController::class,'data'])->name('orchards.data');
            Route::get('/Orchards/admin/{village_id}', [OrchardController::class, 'getAdmin']);// route ajax for get village admins
            Route::get('/Orchards/farmer/{village_id}', [OrchardController::class, 'getFarmer']);// route ajax for get village farmers
            Route::get('/Orchards/farmerInf/{farmer_id}', [OrchardController::class, 'getFarmerInf']);// route ajax for get village farmers


            /*********end admin departments route ********/

            /*******Tree  route********/
            Route::resource('Trees', TreeController::class)->except(['show']);
            Route::get('/Trees/data', [TreeController::class,'data'])->name('trees.data');
            Route::delete('/Trees/bulk_delete/{ids}', [TreeController::class,'bulkDelete'])->name('trees.bulk_delete');

            /*********end Tree  route ********/

            /*******Tree Type  route********/
            Route::resource('TreeTypes', TreeTypeController::class)->except(['show']);
            Route::get('/TreeTypes/data', [TreeTypeController::class,'data'])->name('treeTypes.data');
            Route::delete('/TreeTypes/bulk_delete/{ids}', [TreeTypeController::class,'bulkDelete'])->name('treeTypes.bulk_delete');


            /*********end Tree Type  route ********/

            /*******land category Type  route********/
            Route::resource('LandCategories', LandCategoryController::class)->except(['show']);
            Route::get('/LandCategories/data', [LandCategoryController::class,'data'])->name('landCategories.data');
            Route::delete('/LandCategories/bulk_delete/{ids}', [LandCategoryController::class,'bulkDelete'])->name('landCategories.bulk_delete');

            /*********end Tree Type  route ********/


            /********************************* Department Routes ************************************/
            Route::resource('Departments', DepartmentController::class)->except(['show']);
            Route::get('/Departments/data', [DepartmentController::class,'data'])->name('departments.data');
            Route::delete('/Departments/bulk_delete/{ids}', [DepartmentController::class,'bulkDelete'])->name('departments.bulk_delete');
            /********************************* End Department Routes ************************************/

            /********************************* Category Routes ************************************/
            Route::resource('Categories', CategoryController::class)->except(['show']);
            Route::get('/Categories/data', [CategoryController::class,'data'])->name('categories.data');
            Route::delete('/Categories/bulk_delete/{ids}', [CategoryController::class,'bulkDelete'])->name('categories.bulk_delete');
            /********************************* End Category Routes ************************************/

            /********************************* Blog Routes ************************************/
            Route::resource('blogs', BlogController::class)->except(['show']);
            Route::get('/blogs/data', [BlogController::class,'data'])->name('blogs.data');
            Route::delete('/blogs/bulk_delete/{ids}', [BlogController::class,'bulkDelete'])->name('blogs.bulk_delete');
            /********************************* End Blog Routes ************************************/
            /********************************* Tags Routes ************************************/
            Route::resource('tags', TagController::class)->except(['show']);
            Route::get('/tags/data', [TagController::class,'data'])->name('tags.data');
            Route::delete('/tags/bulk_delete/{ids}', [TagController::class,'bulkDelete'])->name('tags.bulk_delete');
            /********************************* End Tags Routes ************************************/
            /********************************* Tags Routes ************************************/
            Route::resource('Attributes', AttributeController::class)->except(['show']);
            Route::get('/Attributes/data', [AttributeController::class,'data'])->name('Attributes.data');
            Route::delete('/Attributes/bulk_delete/{ids}', [AttributeController::class,'bulkDelete'])->name('attributes.bulk_delete');
            /********************************* End Tags Routes ************************************/

            /********************************* Address Routes ************************************/
                //-------------------when change on any select-------------------
                Route::GET('/fetch_provience/{country_id}',[FetchAddressController::class,'fetch_provience']);
                Route::GET('/fetch_area/{provience}',[FetchAddressController::class,'fetch_area']);
                Route::GET('/fetch_state/{area}',[FetchAddressController::class,'fetch_state']);
                Route::GET('/fetch_village/{state}',[FetchAddressController::class,'fetch_village']);
                /********************************* End Address Routes ************************************/

                /********************************* Options Routes ************************************/
                Route::resource('/Options', OptionController::class);
                Route::get('/option_data', [OptionController::class,'data'])->name('option_data');
                Route::delete('/Options/bulk_delete/{ids}', [OptionController::class,'bulkDelete'])->name('options.bulk_delete');
                /********************************* End Options Routes ************************************/

                /********************************* Start Products Routes ************************************/
                Route::group(['prefix' => 'Products'], function () {
                    Route::get('/',[ProductController::class, 'index']) -> name('products');
                    Route::get('/products_data', [ProductController::class,'data'])->name('products_data');
                    Route::get('create',[ProductController::class, 'create'])->name('products.generalInformation');
                    Route::post('create',[ProductController::class, 'generalInformationStore'])->name('products.generalInformation.store');
                    Route::get('price/{id}',[ProductController::class, 'additionalPrice'])->name('products.prices');
                    Route::post('price',[ProductController::class, 'additionalPriceStore'])->name('products.prices.store');
                    Route::get('stock/{id}',[ProductController::class, 'additionalStock'])->name('products.stock');
                    Route::post('stock',[ProductController::class, 'additionalStockStore'])->name('products.stock.store');
                    Route::get('/product_edit/{id}', [ProductController::class,'edit'])->name('product_edit');
                    Route::post('/product_update', [ProductController::class,'update'])->name('product_update');
                    Route::delete('/product_delete/{id}', [ProductController::class,'destroy'])->name('product_delete');
                    Route::delete('/products/bulk_delete/{ids}', [ProductController::class,'bulkDelete'])->name('products.bulk_delete');

                });
                /********************************* End Products Routes ************************************/

                /********************************* Slider Routes ************************************/
                Route::resource('sliders', SliderController::class)->except(['show']);
                Route::get('/sliders/data', [SliderController::class,'data'])->name('sliders.data');
                Route::delete('/sliders/bulk_delete/{ids}', [SliderController::class,'bulkDelete'])->name('sliders.bulk_delete');
                /********************************* End Slider Routes ************************************/
        });
    });
