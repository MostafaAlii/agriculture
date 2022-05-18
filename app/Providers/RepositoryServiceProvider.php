<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Http\Interfaces\Admin\TagInterface;
use App\Http\Repositories\Admin\TagRepository;

use App\Http\Interfaces\Admin\AreaInterface;
use App\Http\Repositories\Admin\AreaRepository;

use App\Http\Interfaces\Admin\BlogInterface;
use App\Http\Repositories\Admin\BlogRepository;

use App\Http\Interfaces\Admin\TreeInterface;
use App\Http\Repositories\Admin\TreeRepository;

use App\Http\Interfaces\Admin\StateInterface;
use App\Http\Repositories\Admin\StateRepository;

use App\Http\Interfaces\Admin\OptionInterface;
use App\Http\Repositories\Admin\OptionRepository;

use App\Http\Interfaces\Admin\SliderInterface;
use App\Http\Repositories\Admin\SliderRepository;
use App\Http\Interfaces\Admin\BrandInterface;
use App\Http\Repositories\Admin\BrandRepository;

use App\Http\Interfaces\Admin\OrchardInterface;
use App\Http\Repositories\Admin\OrchardRepository;

use App\Http\Interfaces\Admin\ProductInterface;
use App\Http\Repositories\Admin\ProductRepository;

use App\Http\Interfaces\Admin\ProfileInterface;
use App\Http\Repositories\Admin\ProfileRepository;

use App\Http\Interfaces\Admin\SettingInterface;
use App\Http\Repositories\Admin\SettingRepository;

use App\Http\Interfaces\Admin\UserInterface;
use App\Http\Repositories\Admin\UserRepository;

use App\Http\Interfaces\Admin\VillageInterface;
use App\Http\Repositories\Admin\VillageRepository;

use App\Http\Interfaces\Admin\TreeTypeInterface;
use App\Http\Repositories\Admin\TreeTypeRepository;

use App\Http\Interfaces\Admin\AdminDepartmentInterface;
use App\Http\Repositories\Admin\AdminDepartmentRepository;

use App\Http\Interfaces\Admin\AdminInterface;
use App\Http\Repositories\Admin\AdminRepository;

use App\Http\Interfaces\Admin\WorkerInterface;
use App\Http\Repositories\Admin\WorkerRepository;

use App\Http\Interfaces\Admin\CategoryInterface;
use App\Http\Repositories\Admin\CategoryRepository;

use App\Http\Interfaces\Admin\AttributeInterface;
use App\Http\Repositories\Admin\AttributeRepository;

use App\Http\Interfaces\Admin\farmerInterface;
use App\Http\Repositories\Admin\FarmerRepository;

use App\Http\Interfaces\Admin\ProvienceInterface;
use App\Http\Repositories\Admin\ProvienceRepository;

use App\Http\Interfaces\Admin\CountryInterface;
use App\Http\Repositories\Admin\CountryRepository;

use App\Http\Interfaces\Admin\DepartmentInterface;
use App\Http\Repositories\Admin\DepartmentRepository;

use App\Http\Interfaces\Admin\LandCategoryInterface;
use App\Http\Repositories\Admin\LandCategoryRepository;

use App\Http\Interfaces\Admin\ProductCouponInterface;
use App\Http\Repositories\Admin\ProductCouponRepository;

use App\Http\Interfaces\Admin\OrderInterface;
use App\Http\Repositories\Admin\OrderRepository;

use App\Http\Interfaces\Admin\ProtectedHouseInterface;
use App\Http\Repositories\Admin\ProtectedHouseRepository;

use App\Http\Interfaces\Admin\ContactInterface;
use App\Http\Repositories\Admin\ContactRepository;

use App\Http\Interfaces\Admin\RoleRepositoryInterface;
use App\Http\Repositories\Admin\RoleRepository;

// ------------------------Front Uses-------------------------------
use App\Http\Interfaces\Front\CommentInterface;
use App\Http\Repositories\Front\CommentRepository;

use App\Http\Interfaces\Front\SearchInterface;
use App\Http\Repositories\Front\SearchRepository;

use App\Http\Interfaces\Front\RatingInterface;
use App\Http\Repositories\Front\RatingRepository;

use App\Http\Interfaces\Front\FarmerAllDataInterface;
use App\Http\Repositories\Front\FarmerAllDataRepository;

use App\Http\Interfaces\Front\WorkerAllDataInterface;
use App\Http\Repositories\Front\WorkerAllDataRepository;

use App\Http\Interfaces\Admin\PaymentMethodInterface;
use App\Http\Repositories\Admin\PaymentMethodRepository;

use App\Http\Interfaces\Front\PaymentInterface;
use App\Http\Repositories\Front\PaymentRepository;

use App\Http\Interfaces\Admin\AgriServiceInterface;
use App\Http\Repositories\Admin\AgriServiceRepository;

use App\Http\Interfaces\Admin\WaterServiceInterface;
use App\Http\Repositories\Admin\WaterServiceRepository;

use App\Http\Interfaces\Admin\AgriToolServiceInterface;
use App\Http\Repositories\Admin\AgriToolServiceRepository;

use App\Http\Interfaces\Admin\FarmerServiceInterface;
use App\Http\Repositories\Admin\FarmerServiceRepository;



use App\Http\Interfaces\Admin\WinterCropInterface;
use App\Http\Repositories\Admin\WinterCropRepository;

use App\Http\Interfaces\Admin\SummerCropInterface;
use App\Http\Repositories\Admin\SummerCropRepository;



use App\Http\Interfaces\Admin\FarmerCropInterface;
use App\Http\Repositories\Admin\FarmerCropRepository;

use App\Http\Interfaces\Admin\PrecipitationInterface;
use App\Http\Repositories\Admin\PrecipitationRepository;

use App\Http\Interfaces\Admin\LandAreaInterface;
use App\Http\Repositories\Admin\LandAreaRepository;

use App\Http\Interfaces\Admin\CawProjectInterface;
use App\Http\Repositories\Admin\CawProjectRepository;

use App\Http\Interfaces\Admin\ChickenProjectInterface;
use App\Http\Repositories\Admin\ChickenProjectRepository;

use App\Http\Interfaces\Admin\BeeDisasterInterface;
use App\Http\Repositories\Admin\BeeDisasterRepository;

use App\Http\Interfaces\Admin\CourseBeeInterface;
use App\Http\Repositories\Admin\CourseBeeRepository;

use App\Http\Interfaces\Admin\BeekeeperInterface;
use App\Http\Repositories\Admin\BeekeeperRepository;

use App\Http\Interfaces\Admin\WholeSaleProductInterface;
use App\Http\Repositories\Admin\WholeSaleProductRepository;

use App\Http\Interfaces\Admin\OutcomeProductInterface;
use App\Http\Repositories\Admin\OutcomeProductRepository;

use App\Http\Interfaces\Admin\IncomeProductInterface;
use App\Http\Repositories\Admin\IncomeProductRepository;

use App\Http\Interfaces\Admin\SubscribeInterface;
use App\Http\Repositories\Admin\SubscribeRepository;

use App\Http\Interfaces\Admin\CurrencyInterface;
use App\Http\Repositories\Admin\CurrencyRepository;

use App\Http\Interfaces\Admin\UnitInterface;
use App\Http\Repositories\Admin\UnitRepository;

class RepositoryServiceProvider extends ServiceProvider {
    public function register() {
        $this->app->bind(CurrencyInterface::class, CurrencyRepository::class);
        $this->app->bind(UnitInterface::class, UnitRepository::class);
        $this->app->bind(OutcomeProductInterface::class, OutcomeProductRepository::class);
        $this->app->bind(IncomeProductInterface::class, IncomeProductRepository::class);
        $this->app->bind(WholeSaleProductInterface::class, WholeSaleProductRepository::class);
        $this->app->bind(BeeDisasterInterface::class, BeeDisasterRepository::class);
        $this->app->bind(CourseBeeInterface::class, CourseBeeRepository::class);
        $this->app->bind(BeekeeperInterface::class, BeekeeperRepository::class);
        $this->app->bind(CawProjectInterface::class, CawProjectRepository::class);
        $this->app->bind(ChickenProjectInterface::class, ChickenProjectRepository::class);
        $this->app->bind(PrecipitationInterface::class, PrecipitationRepository::class);
        $this->app->bind(LandAreaInterface::class, LandAreaRepository::class);
        $this->app->bind(FarmerCropInterface::class, FarmerCropRepository::class);
        $this->app->bind(SummerCropInterface::class, SummerCropRepository::class);
        $this->app->bind(WinterCropInterface::class, WinterCropRepository::class);
        $this->app->bind(FarmerServiceInterface::class, FarmerServiceRepository::class);
        $this->app->bind(AgriServiceInterface::class, AgriServiceRepository::class);
        $this->app->bind(WaterServiceInterface::class, WaterServiceRepository::class);
        $this->app->bind(AgriToolServiceInterface::class, AgriToolServiceRepository::class);
        $this->app->bind(ProtectedHouseInterface::class, ProtectedHouseRepository::class);
        $this->app->bind(OrchardInterface::class, OrchardRepository::class);
        $this->app->bind(TreeInterface::class, TreeRepository::class);
        $this->app->bind(TreeTypeInterface::class, TreeTypeRepository::class);
        $this->app->bind(LandCategoryInterface::class, LandCategoryRepository::class);
        $this->app->bind(AdminDepartmentInterface::class, AdminDepartmentRepository::class);
        $this->app->bind(SettingInterface::class, SettingRepository::class);
        $this->app->bind(CountryInterface::class, CountryRepository::class);
        $this->app->bind(ProvinceInterface::class, ProvinceRepository::class);
        $this->app->bind(AreaInterface::class, AreaRepository::class);
        $this->app->bind(StateInterface::class, StateRepository::class);
        $this->app->bind(VillageInterface::class, VillageRepository::class);
        $this->app->bind(AdminInterface::class, AdminRepository::class);
        $this->app->bind(WorkerInterface::class, WorkerRepository::class);
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(farmerInterface::class, FarmerRepository::class);
        $this->app->bind(ProfileInterface::class, ProfileRepository::class);
        $this->app->bind(ProvienceInterface::class, ProvienceRepository::class);
        $this->app->bind(DepartmentInterface::class, DepartmentRepository::class);
        $this->app->bind(SliderInterface::class, SliderRepository::class);
        $this->app->bind(BrandInterface::class, BrandRepository::class);
        $this->app->bind(BlogInterface::class, BlogRepository::class);
        $this->app->bind(TagInterface::class, TagRepository::class);
        $this->app->bind(AttributeInterface::class, AttributeRepository::class);
        $this->app->bind(OptionInterface::class, OptionRepository::class);
        $this->app->bind(ProductInterface::class, ProductRepository::class);
        $this->app->bind(ProductCouponInterface::class, ProductCouponRepository::class);
        $this->app->bind(CategoryInterface::class, CategoryRepository::class);
        $this->app->bind(OrderInterface::class, OrderRepository::class);
        $this->app->bind(SubscribeInterface::class, SubscribeRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        // Front Binding
        $this->app->bind(CommentInterface::class, CommentRepository::class);
        $this->app->bind(RatingInterface::class, RatingRepository::class);
        $this->app->bind(SearchInterface::class, SearchRepository::class);
        $this->app->bind(FarmerAllDataInterface::class, FarmerAllDataRepository::class);
        $this->app->bind(WorkerAllDataInterface::class, WorkerAllDataRepository::class);
        $this->app->bind(PaymentMethodInterface::class, PaymentMethodRepository::class);
        $this->app->bind(PaymentInterface::class, PaymentRepository::class);
        $this->app->bind(ContactInterface::class, ContactRepository::class);

    }

    public function boot()
    {
        //
    }
}
