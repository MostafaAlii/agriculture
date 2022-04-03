<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Http\Interfaces\Admin\TagInterface;
use App\Http\Interfaces\Admin\AreaInterface;
use App\Http\Interfaces\Admin\BlogInterface;
use App\Http\Interfaces\Admin\UserInterface;
use App\Http\Interfaces\Admin\AdminInterface;
use App\Http\Interfaces\Admin\StateInterface;
use App\Http\Interfaces\Admin\farmerInterface;
use App\Http\Interfaces\Admin\OptionInterface;
use App\Http\Interfaces\Admin\SliderInterface;
use App\Http\Repositories\Admin\TagRepository;
use App\Http\Interfaces\Admin\CountryInterface;
use App\Http\Interfaces\Admin\ProductInterface;
use App\Http\Interfaces\Admin\ProfileInterface;
use App\Http\Interfaces\Admin\SettingInterface;
use App\Http\Interfaces\Admin\VillageInterface;
use App\Http\Interfaces\Front\CommentInterface;
use App\Http\Repositories\Admin\AreaRepository;

use App\Http\Repositories\Admin\BlogRepository;
use App\Http\Repositories\Admin\UserRepository;
use App\Http\Interfaces\Admin\CategoryInterface;
use App\Http\Repositories\Admin\AdminRepository;
use App\Http\Repositories\Admin\StateRepository;
use App\Http\Interfaces\Admin\AttributeInterface;
use App\Http\Interfaces\Admin\ProvienceInterface;
use App\Http\Repositories\Admin\FarmerRepository;
use App\Http\Repositories\Admin\OptionRepository;
use App\Http\Repositories\Admin\SliderRepository;
use App\Http\Interfaces\Admin\DepartmentInterface;
use App\Http\Repositories\Admin\CountryRepository;
use App\Http\Repositories\Admin\ProductRepository;
use App\Http\Repositories\Admin\ProfileRepository;
use App\Http\Repositories\Admin\SettingRepository;
use App\Http\Repositories\Admin\VillageRepository;
use App\Http\Repositories\Front\CommentRepository;
use App\Http\Repositories\Admin\CategoryRepository;

use App\Http\Repositories\Admin\AttributeRepository;
use App\Http\Repositories\Admin\ProvienceRepository;
use App\Http\Repositories\Admin\DepartmentRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(SettingInterface::class, SettingRepository::class);
        $this->app->bind(CountryInterface::class, CountryRepository::class);
        $this->app->bind(ProvinceInterface::class, ProvinceRepository::class);
        $this->app->bind(AreaInterface::class, AreaRepository::class);
        $this->app->bind(StateInterface::class, StateRepository::class);
        $this->app->bind(VillageInterface::class, VillageRepository::class);
        $this->app->bind(AdminInterface::class, AdminRepository::class);
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(farmerInterface::class, FarmerRepository::class);
        $this->app->bind(ProfileInterface::class, ProfileRepository::class);
        $this->app->bind(CountryInterface::class, CountryRepository::class);
        $this->app->bind(ProvienceInterface::class, ProvienceRepository::class);
        $this->app->bind(AreaInterface::class, AreaRepository::class);
        $this->app->bind(StateInterface::class, StateRepository::class);
        $this->app->bind(VillageInterface::class, VillageRepository::class);
        $this->app->bind(DepartmentInterface::class, DepartmentRepository::class);
        $this->app->bind(SliderInterface::class, SliderRepository::class);
        $this->app->bind(BlogInterface::class, BlogRepository::class);
        $this->app->bind(TagInterface::class, TagRepository::class);
        $this->app->bind(AttributeInterface::class, AttributeRepository::class);
        $this->app->bind(OptionInterface::class, OptionRepository::class);
        $this->app->bind(ProductInterface::class, ProductRepository::class);
        $this->app->bind(CategoryInterface::class, CategoryRepository::class);


        $this->app->bind(CommentInterface::class, CommentRepository::class);
        
    }

    public function boot()
    {
        //
    }
}
