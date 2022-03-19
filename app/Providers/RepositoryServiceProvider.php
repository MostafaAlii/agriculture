<?php

namespace App\Providers;

use App\Http\Interfaces\Admin\AdminInterface;
use App\Http\Interfaces\Admin\UserInterface;
use App\Http\Interfaces\Admin\farmerInterface;
use App\Http\Interfaces\Admin\CountryInterface;
use App\Http\Interfaces\Admin\DepartmentInterface;
use App\Http\Interfaces\Admin\ProvinceInterface;
use App\Http\Interfaces\Admin\AreaInterface;
use App\Http\Interfaces\Admin\StateInterface;
use App\Http\Interfaces\Admin\VillageInterface;
use App\Http\Interfaces\Admin\OrchardInterface;



use App\Http\Repositories\Admin\CountryRepository;
use App\Http\Repositories\Admin\ProvinceRepository;
use App\Http\Repositories\Admin\AreaRepository;
use App\Http\Repositories\Admin\StateRepository;
use App\Http\Repositories\Admin\OrchardRepository;

use App\Http\Repositories\Admin\VillageRepository;


use App\Http\Repositories\Admin\AdminRepository;
use App\Http\Repositories\Admin\UserRepository;
use App\Http\Repositories\Admin\FarmerRepository;
use App\Http\Repositories\Admin\DepartmentRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(OrchardInterface::class, OrchardRepository::class);
        $this->app->bind(CountryInterface::class, CountryRepository::class);
        $this->app->bind(ProvinceInterface::class, ProvinceRepository::class);
        $this->app->bind(AreaInterface::class, AreaRepository::class);
        $this->app->bind(StateInterface::class, StateRepository::class);
        $this->app->bind(VillageInterface::class, VillageRepository::class);
        $this->app->bind(AdminInterface::class, AdminRepository::class);
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(farmerInterface::class, FarmerRepository::class);
        $this->app->bind(CountryInterface::class, CountryRepository::class);
        $this->app->bind(DepartmentInterface::class, DepartmentRepository::class);
    }

    public function boot()
    {
        //
    }
}
