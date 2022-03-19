<?php
namespace App\Providers;
use App\Http\Interfaces\Admin\AdminInterface;
use App\Http\Interfaces\Admin\UserInterface;
use App\Http\Interfaces\Admin\farmerInterface;
use App\Http\Interfaces\Admin\CountryInterface;
use App\Http\Interfaces\Admin\DepartmentInterface;
use App\Http\Interfaces\Admin\ProfileInterface;
use App\Http\Interfaces\Admin\ProvienceInterface;
use App\Http\Interfaces\Admin\AreaInterface;

use App\Http\Repositories\Admin\AdminRepository;
use App\Http\Repositories\Admin\UserRepository;
use App\Http\Repositories\Admin\FarmerRepository;
use App\Http\Repositories\Admin\CountryRepository;
use App\Http\Repositories\Admin\DepartmentRepository;
use App\Http\Repositories\Admin\ProfileRepository;
use App\Http\Repositories\Admin\ProvienceRepository;
use App\Http\Repositories\Admin\AreaRepository;
use Illuminate\Support\ServiceProvider;
class RepositoryServiceProvider extends ServiceProvider {
    public function register() {
        $this->app->bind(AdminInterface::class, AdminRepository::class);
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(farmerInterface::class, FarmerRepository::class);
        $this->app->bind(CountryInterface::class, CountryRepository::class);
        $this->app->bind(ProvienceInterface::class, ProvienceRepository::class);
        $this->app->bind(AreaInterface::class, AreaRepository::class);
        $this->app->bind(DepartmentInterface::class, DepartmentRepository::class);
        $this->app->bind(ProfileInterface::class, ProfileRepository::class);
    }

    public function boot() {
        //
    }
}
