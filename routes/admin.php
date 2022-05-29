<?php
use App\Http\Livewire;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\Admin\TagController;
use App\Http\Controllers\Dashboard\Admin\AreaController;
use App\Http\Controllers\Dashboard\Admin\BlogController;
use App\Http\Controllers\Dashboard\Admin\RoleController;
use App\Http\Controllers\Dashboard\Admin\TeamController;
use App\Http\Controllers\Dashboard\Admin\TreeController;
use App\Http\Controllers\Dashboard\Admin\UserController;
use App\Http\Controllers\Dashboard\Admin\AboutController;
use App\Http\Controllers\Dashboard\Admin\AdminController;
use App\Http\Controllers\Dashboard\Admin\BrandController;
use App\Http\Controllers\Dashboard\Admin\StateController;
use App\Http\Controllers\Dashboard\Admin\FarmerController;
use App\Http\Controllers\Dashboard\Admin\OptionController;
use App\Http\Controllers\Dashboard\Admin\OrdersController;
use App\Http\Controllers\Dashboard\Admin\ReviewController;
use App\Http\Controllers\Dashboard\Admin\SliderController;
use App\Http\Controllers\Dashboard\Admin\WorkerController;
use App\Http\Controllers\Dashboard\Admin\ContactController;
use App\Http\Controllers\Dashboard\Admin\CountryController;
use App\Http\Controllers\Dashboard\Admin\OrchardController;
use App\Http\Controllers\Dashboard\Admin\ProductController;
use App\Http\Controllers\Dashboard\Admin\ProfileController;
use App\Http\Controllers\Dashboard\Admin\SettingController;
use App\Http\Controllers\Dashboard\Admin\VillageController;
use App\Http\Controllers\Dashboard\Admin\CategoryController;
use App\Http\Controllers\Dashboard\Admin\LandAreaController;
use App\Http\Controllers\Dashboard\Admin\TreeTypeController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Dashboard\Admin\AttributeController;
use App\Http\Controllers\Dashboard\Admin\CourseBeeController;
use App\Http\Controllers\Dashboard\Admin\DashboardController;
use App\Http\Controllers\Dashboard\Admin\ProvienceController;
use App\Http\Controllers\Dashboard\Admin\SubscribeController;
use App\Http\Controllers\Dashboard\Admin\BeeKeepersController;
use App\Http\Controllers\Dashboard\Admin\CawProjectController;
use App\Http\Controllers\Dashboard\Admin\DepartmentController;
use App\Http\Controllers\Dashboard\Admin\FarmerCropController;
use App\Http\Controllers\Dashboard\Admin\SummerCropController;
use App\Http\Controllers\Dashboard\Admin\WinterCropController;
use App\Http\Controllers\Dashboard\Admin\AgriServiceController;
use App\Http\Controllers\Dashboard\Admin\BeeDisastersController;
use App\Http\Controllers\Dashboard\Admin\FetchAddressController;
use App\Http\Controllers\Dashboard\Admin\LandCategoryController;
use App\Http\Controllers\Dashboard\Admin\WaterServiceController;
use App\Http\Controllers\Dashboard\Admin\FarmerServiceController;
use App\Http\Controllers\Dashboard\Admin\IncomeProductController;
use App\Http\Controllers\Dashboard\Admin\PaymentMethodController;
use App\Http\Controllers\Dashboard\Admin\PrecipitationController;
use App\Http\Controllers\Dashboard\Admin\ProductCouponController;
use App\Http\Controllers\Dashboard\Admin\ChickenProjectController;
use App\Http\Controllers\Dashboard\Admin\OutcomeProductController;
use App\Http\Controllers\Dashboard\Admin\ProtectedHouseController;

use App\Http\Controllers\Dashboard\Admin\AdminDepartmentController;
use App\Http\Controllers\Dashboard\Admin\AgriToolServiceController;
use App\Http\Controllers\Dashboard\Admin\WholeSaleProductController;
use App\Http\Controllers\Dashboard\Admin\CurrencyController;
use App\Http\Controllers\Dashboard\Admin\UnitController;

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
            Route::get('/subscribe', [SubscribeController::class,'data'])->name('subscribe');
            Route::delete('/subscribe.destroy/{id}', [SubscribeController::class,'destroy'])->name('subscribe.destroy');
            Route::delete('/subscribe/bulk_delete/{ids}', [SubscribeController::class,'bulkDelete'])->name('subscribe.bulk_delete');
            // Route::get('/subscribe/sendmails', [SubscribeController::class,'sendMails'])->name('subscribe.sendmails');
            /********************************* Start Admin & Employee Routes ************************************/
            Route::resource('Admins', AdminController::class)->except(['show']);
            Route::get('/Admins/data', [AdminController::class,'data'])->name('admins.data');
            Route::delete('/admins/bulk_delete/{ids}', [AdminController::class,'bulkDelete'])->name('admins.bulk_delete');
            Route::get('/admin/profile/{id}', [AdminController::class,'showProfile'])->name('admin.profile');
            Route::put('/admin/profileupdate/{id}', [AdminController::class,'updateAccount'])->name('admin.updateAccount'); // update admin form account
            Route::put('/admin/profileupdateinfo/{id}', [AdminController::class,'updateInformation'])->name('admin.updateInformation'); //update admin form information

            Route::get('/admin/change_status/{id}', [AdminController::class,'change_status'])->name('change_status');



            // route for auth profile Authadmin *******************************************************************
            /********************************* Start Worker Routes ************************************/
            Route::resource('workers', WorkerController::class)->except(['show']);
            Route::get('/workers/data', [WorkerController::class,'data'])->name('workers.data');
            Route::delete('/workers/bulk_delete/{ids}', [WorkerController::class,'bulkDelete'])->name('workers.bulk_delete');
            Route::get('/worker/profile/{id}', [WorkerController::class,'showProfile'])->name('worker.profile');
            Route::put('/worker/profileupdate/{id}', [WorkerController::class,'updateAccount'])->name('worker.updateAccount'); // update worker form account
            Route::put('/worker/profileupdateinfo/{id}', [WorkerController::class,'updateInformation'])->name('worker.updateInformation'); //update worker form information
            // end worker route*******************************************************************
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
            Route::get('/farmer/product/{farmer_id}', [FarmerController::class,'getProduct'])->name('farmer.product.data');
            Route::get('/farmer/product/details/{product_id}', [FarmerController::class,'getProductDetails'])->name('farmer.product.detailspage');
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

            /********************************* currency Routes ************************************/
            Route::resource('Currencies', CurrencyController::class)->except(['show']);
            Route::get('/Currencies/data', [CurrencyController::class,'data'])->name('currencies.data');
            Route::delete('/Currencies/bulk_delete/{ids}', [CurrencyController::class,'bulkDelete'])->name('currencies.bulk_delete');
            /********************************* End Currency Routes ************************************/

            /********************************* Unit Routes ************************************/
            Route::resource('Units', UnitController::class)->except(['show']);
            Route::get('/Units/data', [UnitController::class,'data'])->name('units.data');
            Route::delete('/Units/bulk_delete/{ids}', [UnitController::class,'bulkDelete'])->name('units.bulk_delete');
            /********************************* End Unit Routes ************************************/

            /********************************* Start settings Routes ************************************/
            Route::get('Settings', [SettingController::class, 'index'])->name('settings');
            Route::post('Settings/store', [SettingController::class, 'store'])->name('settings.store');
            /********************************* End settings Pages Routes ************************************/

            /*******admin departments route********/
            Route::resource('AdminDepartments', AdminDepartmentController::class)->except(['show']);
            /*********end admin departments route ********/

            /*******admin departments route********/

            Route::resource('orchards', OrchardController::class)->except(['show']);
            Route::get('/orchards/data', [OrchardController::class,'data'])->name('orchards.data');
            Route::delete('/orchards/bulk_delete/{ids}', [OrchardController::class,'bulkDelete'])->name('orchards.bulk_delete');
            Route::get('/orchards/orchard_statistic/', [OrchardController::class,'statistics'])->name('orchards.statistics');

            Route::get('/orchards/admin/{village_id}', [OrchardController::class, 'getAdmin']);// route ajax for get village admins
            Route::get('/orchards/farmer/{village_id}', [OrchardController::class, 'getFarmer']);// route ajax for get village farmers
            Route::get('/orchards/farmerInf/{farmer_id}', [OrchardController::class, 'getFarmerInf']);// route ajax for get village farmers


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

            /******start precipitation ********/
            Route::resource('Precipitations', PrecipitationController::class)->except(['show']);
            Route::get('/Precipitations/data', [PrecipitationController::class,'data'])->name('precipitation.data');
            Route::delete('/Precipitations/bulk_delete/{ids}', [PrecipitationController::class,'bulkDelete'])->name('precipitation.bulk_delete');
//            Route::get('/Precipitations/statistic/', [PrecipitationController::class,'statistics'])->name('precipitation.statistics');
            Route::get('/Precipitations/index_statistic', [PrecipitationController::class,'index_statistic'])->name('precipitations.index_statistic');;
            Route::get('dtable-custom-statistics', [PrecipitationController::class,'get_custom_statistics']);
            Route::get('/Precipitations/index_details_statistic', [PrecipitationController::class,'get_details_statistics_index'])->name('precipitations.index_details_statistic');
            Route::get('dtable-details-statistics', [PrecipitationController::class,'get_details_statistics']);
            Route::get('/Precipitations/graph', [DashboardController::class,'index'])->name('precipitation.graph');

            /***********end precipitation ****/

            /******start LandArea ********/
            Route::resource('LandAreas', LandAreaController::class)->except(['show']);
            Route::get('/LandAreas/data', [LandAreaController::class,'data'])->name('landAreas.data');
            Route::delete('/LandAreas/bulk_delete/{ids}', [LandAreaController::class,'bulkDelete'])->name('landAreas.bulk_delete');
            Route::get('/LandAreas/statistic/', [LandAreaController::class,'getStatisticaldata'])->name('landAreas.getStatisticaldata');
            Route::get('/LandAreas/statistic_detail/', [LandAreaController::class,'statistic_land_area_detail'])->name('land_area_details.statistic');
            Route::get('/LandAreas/statistic_state/', [LandAreaController::class,'statistic_land_area_state'])->name('land_area_state.statistic');
            /***********end LandArea ****/

            /******start protected hoses********/
            Route::resource('ProtectedHouse', ProtectedHouseController::class)->except(['show']);
            Route::get('/ProtectedHouse/data', [ProtectedHouseController::class,'data'])->name('protectedHouse.data');
            Route::delete('/ProtectedHouse/bulk_delete/{ids}', [ProtectedHouseController::class,'bulkDelete'])->name('protectedHouse.bulk_delete');
            Route::get('/ProtectedHouse/protected_house_statistic/', [ProtectedHouseController::class,'protected_house_statistics'])->name('protected_house.statistic');
            Route::get('/ProtectedHouse/protected_house_g_statistic/', [ProtectedHouseController::class,'protected_house_gov_statistics'])->name('protected_house_g.statistic');
            Route::get('/ProtectedHouse/protected_house_p_statistic/', [ProtectedHouseController::class,'protected_house_private_statistics'])->name('protected_house_p.statistic');
            /***********end protected hoses***/

            /******start agriculture service********/
            Route::resource('AgricultureServices', AgriServiceController::class)->except(['show']);
            Route::get('/AgricultureServices/data', [AgriServiceController::class,'data'])->name('agriculture_service.data');
            Route::delete('/AgricultureServices/bulk_delete/{ids}', [AgriServiceController::class,'bulkDelete'])->name('agriculture_service.bulk_delete');
            /***********end agriculture service****/
            /******start agriculture tool service********/
            Route::resource('AgricultureToolServices', AgriToolServiceController::class)->except(['show']);
            Route::get('/AgricultureToolServices/data', [AgriToolServiceController::class,'data'])->name('agriculture_tool_service.data');
            Route::delete('/AgricultureToolServices/bulk_delete/{ids}', [AgriToolServiceController::class,'bulkDelete'])->name('agriculture_tool_service.bulk_delete');
            /***********end agriculture tool service****/

            /******start water service *******/
            Route::resource('WaterServices', WaterServiceController::class)->except(['show']);
            Route::get('/WaterServices/data', [WaterServiceController::class,'data'])->name('water_service.data');
            Route::delete('/WaterServices/bulk_delete/{ids}', [WaterServiceController::class,'bulkDelete'])->name('water_service.bulk_delete');
            /***********end water service ****/

            /******start Farmer service********/
            Route::resource('FarmerServices', FarmerServiceController::class)->except(['show']);
            Route::get('/FarmerServices/data', [FarmerServiceController::class,'data'])->name('farmer_service.data');
            Route::delete('/FarmerServices/bulk_delete/{ids}', [FarmerServiceController::class,'bulkDelete'])->name('farmer_service.bulk_delete');
            Route::get('/FarmerServices/statistic/', [FarmerServiceController::class,'statistics'])->name('farmer_service.statistics');
            /***********end Farmer service****/


            Route::resource('WinterCrops', WinterCropController::class)->except(['show']);
            Route::get('/WinterCrops/data', [WinterCropController::class,'data'])->name('winter_crops.data');
            Route::delete('/WinterCrops/bulk_delete/{ids}', [WinterCropController::class,'bulkDelete'])->name('winter_crops.bulk_delete');

            /***********end Crops ****/
            /******start Crops ********/

            Route::resource('SummerCrops', SummerCropController::class)->except(['show']);
            Route::get('/SummerCrops/data', [SummerCropController::class,'data'])->name('summer_crops.data');
            Route::delete('/SummerCrops/bulk_delete/{ids}', [SummerCropController::class,'bulkDelete'])->name('summer_crops.bulk_delete');



            /******start farmer crops********/
            Route::resource('FarmerCrops', FarmerCropController::class)->except(['show']);
            Route::get('/FarmerCrops/data', [FarmerCropController::class,'data'])->name('farmer_crop.data');
            Route::delete('/FarmerCrops/bulk_delete/{ids}', [FarmerCropController::class,'bulkDelete'])->name('farmer_crop.bulk_delete');
            Route::get('/FarmerCrops/statistic/', [FarmerCropController::class,'statistics'])->name('farmer_crops.statistics');


            /***********end farmer crops****/

            /******start animals ********/
            Route::resource('Animals', CawProjectController::class)->except(['show']);
            Route::get('/Animals/data', [CawProjectController::class,'data'])->name('animals.data');
            Route::delete('/Animals/bulk_delete/{ids}', [CawProjectController::class,'bulkDelete'])->name('animals.bulk_delete');
            Route::get('/Animals/statistic/', [CawProjectController::class,'statistics'])->name('animals.statistics');
            Route::get('/Animals/ship_statistic/', [CawProjectController::class,'ship_statistics'])->name('ship.statistics');
            Route::get('/Animals/caw_statistic/', [CawProjectController::class,'caw_statistics'])->name('caw.statistics');
            Route::get('/Animals/fish_statistic/', [CawProjectController::class,'fish_statistics'])->name('fish.statistics');
            /***********end animals ****/

            /******start chicken project ********/
            Route::resource('Chickens', ChickenProjectController::class)->except(['show']);
            Route::get('/Chickens/data', [ChickenProjectController::class,'data'])->name('chicken.data');
            Route::delete('/Chickens/bulk_delete/{ids}', [ChickenProjectController::class,'bulkDelete'])->name('chicken.bulk_delete');
            Route::get('/Chickens/chicken_statistic/', [ChickenProjectController::class,'chicken_project_statistics'])->name('chicken.statistics');
            /***********end chicken project ****/

            /*******Course Bees  route********/
            Route::resource('CourseBees', CourseBeeController::class)->except(['show']);
            Route::get('/CourseBees/data', [CourseBeeController::class,'data'])->name('courseBees.data');
            Route::delete('/CourseBees/bulk_delete/{ids}', [CourseBeeController::class,'bulkDelete'])->name('courseBees.bulk_delete');
            /*********end Course Bees  route ********/

            /******* Bees  Disaster route********/
            Route::resource('BeeDisasters', BeeDisastersController::class)->except(['show']);
            Route::get('/BeeDisasters/data', [BeeDisastersController::class,'data'])->name('beeDisasters.data');
            Route::delete('/BeeDisasters/bulk_delete/{ids}', [BeeDisastersController::class,'bulkDelete'])->name('beeDisasters.bulk_delete');
            /*********end  Bees Disaster route ********/

            /******* Beekeeper  route********/
            Route::resource('BeeKeepers', BeeKeepersController::class)->except(['show']);
            Route::get('/BeeKeepers/data', [BeeKeepersController::class,'data'])->name('beekeepers.data');
            Route::delete('/BeeKeepers/bulk_delete/{ids}', [BeeKeepersController::class,'bulkDelete'])->name('beekeepers.bulk_delete');
            Route::get('/BeeKeepers/statistic/', [BeeKeepersController::class,'statistics'])->name('beekeepers.statistics');
            Route::get('/BeeKeepers/details_beekeeper_statistic/', [BeeKeepersController::class,'beekeeper_details_statistics'])->name('details_beekeeper.statistics');
            /*********end  Beekeeper  route ********/

            /******* whole sale product  route********/
            Route::resource('WholeSaleProducts', WholeSaleProductController::class)->except(['show']);
            Route::get('/WholeSaleProducts/data', [WholeSaleProductController::class,'data'])->name('whole_sale_products.data');
            Route::delete('/WholeSaleProducts/bulk_delete/{ids}', [WholeSaleProductController::class,'bulkDelete'])->name('whole_sale_products.bulk_delete');
            /*********end  whole sale product  route ********/

            /********************************* outcome products Routes ************************************/
            Route::resource('OutcomeProducts', OutcomeProductController::class)->except(['show']);
            Route::get('/OutcomeProducts/data', [OutcomeProductController::class,'data'])->name('outcome_products.data');
            Route::delete('/OutcomeProducts/bulk_delete/{ids}', [OutcomeProductController::class,'bulkDelete'])->name('outcome_products.bulk_delete');
            Route::get('/OutcomeProducts/statistic/', [OutcomeProductController::class,'outcome_product_statistics'])->name('outcome_product.statistics');
            Route::get('/OutcomeProducts/index_outcome_products', [OutcomeProductController::class,'index_outcome_products'])->name('index_outcome_products');
            Route::get('dtable_weekly_monthly_anual_outcome_product', [OutcomeProductController::class,'get_weekly_monthly_anual_outcome_product_statistics'])->name('dtable_weekly_monthly_anual_outcome_product');

            Route::get( '/OutcomeProducts/index_outcome_local_products', [OutcomeProductController::class,'index_outcome_local_products'])->name('index_outcome_local_products');
            Route::get('dtable_weekly_monthly_anual_outcome_local_product', [OutcomeProductController::class,'get_weekly_monthly_anual_outcome_local_product_statistics'])->name('dtable_weekly_monthly_anual_outcome_local_product');

            Route::get('/OutcomeProducts/index_outcome_imported_products', [OutcomeProductController::class,'index_outcome_imported_products'])->name('index_outcome_imported_products');
            Route::get('dtable_weekly_monthly_anual_outcome_imported_product', [OutcomeProductController::class,'get_weekly_monthly_anual_outcome_imported_product_statistics'])->name('dtable_weekly_monthly_anual_outcome_imported_product');

            Route::get('/OutcomeProducts/index_outcome_iraq_products', [OutcomeProductController::class,'index_outcome_iraq_products'])->name('index_outcome_iraq_products');
            Route::get('dtable_weekly_monthly_anual_outcome_iraq_product', [OutcomeProductController::class,'get_weekly_monthly_anual_outcome_iraq_product_statistics'])->name('dtable_weekly_monthly_anual_outcome_iraq_product');

            /********************************* End outcome products Routes ************************************/

            /********************************* outcome products Routes ************************************/
            Route::resource('IncomeProducts', IncomeProductController::class)->except(['show']);
            Route::get('/IncomeProducts/data', [IncomeProductController::class,'data'])->name('income_products.data');
            Route::delete('/IncomeProducts/bulk_delete/{ids}', [IncomeProductController::class,'bulkDelete'])->name('income_products.bulk_delete');
            Route::get('/IncomeProducts/statistic/', [IncomeProductController::class,'income_product_statistics'])->name('income_product.statistics');
            Route::get('/IncomeProducts/index_income_products', [IncomeProductController::class,'index_income_products'])->name('index_income_products');
            Route::get('dtable_weekly_monthly_anual_income_product', [IncomeProductController::class,'get_weekly_monthly_anual_income_product_statistics'])->name('dtable_weekly_monthly_anual_income_product');

            Route::get('/IncomeProducts/index_income_local_products', [IncomeProductController::class,'index_income_local_products'])->name('index_income_local_products');
            Route::get('dtable_weekly_monthly_anual_income_local_product', [IncomeProductController::class,'get_weekly_monthly_anual_income_local_product_statistics'])->name('dtable_weekly_monthly_anual_income_local_product');

            Route::get('/IncomeProducts/index_income_imported_products', [IncomeProductController::class,'index_income_imported_products'])->name('index_income_imported_products');
            Route::get('dtable_weekly_monthly_anual_income_imported_product', [IncomeProductController::class,'get_weekly_monthly_anual_income_imported_product_statistics'])->name('dtable_weekly_monthly_anual_income_imported_product');

            Route::get('/IncomeProducts/index_income_iraq_products', [IncomeProductController::class,'index_income_iraq_products'])->name('index_income_iraq_products');
            Route::get('dtable_weekly_monthly_anual_income_iraq_product', [IncomeProductController::class,'get_weekly_monthly_anual_income_iraq_product_statistics'])->name('dtable_weekly_monthly_anual_income_iraq_product');

            /********************************* End outcome products Routes ************************************/

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
                    Route::get('/',[ProductController::class, 'index'])->name('products');
                    Route::get('/products_data', [ProductController::class,'data'])->name('products_data');
                    Route::get('create',[ProductController::class, 'create'])->name('products.generalInformation');
                    Route::post('create',[ProductController::class, 'generalInformationStore'])->name('products.generalInformation.store');
                    Route::get('price/{id}',[ProductController::class, 'additionalPrice'])->name('products.prices');
                    Route::post('price',[ProductController::class, 'additionalPriceStore'])->name('products.prices.store');
                    Route::get('stock/{id}',[ProductController::class, 'additionalStock'])->name('products.stock');
                    Route::post('stock',[ProductController::class, 'additionalStockStore'])->name('products.stock.store');
                    Route::get('/product_edit/{id}', [ProductController::class,'edit'])->name('product_edit');
                    Route::post('/product_update', [ProductController::class,'update'])->name('product_update');
                    Route::get('restore',[ProductController::class, 'restore'])->name('products.trashed');
                    Route::get('/trashed_data', [ProductController::class,'trashed_data'])->name('trashed_data');
                    Route::put('restore/{id}',[ProductController::class, 'updateRestore'])->name('products.restore');
                    Route::delete('/product_delete/{id}', [ProductController::class,'destroy'])->name('product_delete');
                    Route::delete('/product_destroy/{id}', [ProductController::class,'forceDestroy'])->name('product_force_delete');
                    Route::delete('/products/bulk_delete/{ids}', [ProductController::class,'bulkDelete'])->name('products.bulk_delete');
                });
                /********************************* End Products Routes ************************************/

                /********************************* Start Coupon Routes ************************************/
                Route::resource('ProductCoupons', ProductCouponController::class)->except(['show']);
                Route::get('ProductCoupons/data', [ProductCouponController::class,'data'])->name('Coupons.data');
                Route::delete('ProductCoupons/bulk_delete/{ids}', [ProductCouponController::class,'bulkDelete'])->name('Coupons.bulk_delete');
                /********************************* End Coupon Routes ************************************/

                /********************************* Slider Routes ************************************/
                Route::resource('sliders', SliderController::class)->except(['show']);
                Route::get('/sliders/data', [SliderController::class,'data'])->name('sliders.data');
                Route::delete('/sliders/bulk_delete/{ids}', [SliderController::class,'bulkDelete'])->name('sliders.bulk_delete');
                /********************************* End Slider Routes ************************************/

                /********************************* brand Routes ************************************/
                Route::resource('brands', BrandController::class)->except(['show']);
                Route::get('/brands/data', [BrandController::class,'data'])->name('brands.data');
                Route::delete('/brands/bulk_delete/{ids}', [BrandController::class,'bulkDelete'])->name('brands.bulk_delete');
                /********************************* End brand Routes ************************************/

                /********************************* Start Orders **********************************/
                Route::resource('Orders', OrdersController::class)->except(['destory', 'create', 'store', 'show']);
                Route::get('Orders/data', [OrdersController::class,'data'])->name('orders.data');
                Route::get('Orders/showOrder/{id}', [OrdersController::class,'showOrder'])->name('order.show');
                Route::get('Orders/printOrder/{id}', [OrdersController::class,'printOrder'])->name('order.print');
                /********************************* End Orders **********************************/

                /********************************* Start Contact Us **********************************/
                Route::get('contact_us', [ContactController::class,'show'])->name('contact_us');
                route::POST('/replayMail/{mail}',[ContactController::class,'replay'])->name('mail.replay');
                route::POST('/sendMail',[ContactController::class,'send'])->name('mail.send');
                route::POST('/deleteMail',[ContactController::class,'delete'])->name('mail.delete');
                /********************************* End Contact Us **********************************/

                /********************************* Start Roles **********************************/
                Route::resource('Roles',RoleController::class);
                Route::get('/data', [RoleController::class,'data'])->name('roles.data');
                Route::delete('/Roles/bulk_delete/{ids}', [RoleController::class,'bulkDelete'])->name('roles.bulk_delete');
                /********************************* End Roles **********************************/
                 /********************************* end mail **********************************/

                 /********************************* about us **********************************/
                Route::get('about_us.show', [AboutController::class,'show'])->name('about_us/show');
                Route::post('about_us.save', [AboutController::class,'save'])->name('about_us/save');

                /***********************************Review***************************************/
                Route::resource('review', ReviewController::class)->except(['show']);
                Route::get('/review/data', [ReviewController::class,'data'])->name('review.data');
                Route::delete('/review/bulk_delete/{ids}', [ReviewController::class,'bulkDelete'])->name('review.bulk_delete');
                /*****************************************************************************/

                 /*********************************Team*****************************************/
                 Route::resource('team', TeamController::class)->except(['show']);
                 Route::get('/team/data', [TeamController::class,'data'])->name('team.data');
                 Route::delete('/team/bulk_delete/{ids}', [TeamController::class,'bulkDelete'])->name('team.bulk_delete');
                 /*****************************************************************************/


        });
    });
