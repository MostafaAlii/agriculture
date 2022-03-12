<?php
namespace App\Providers;
use App\Http\Interfaces\Admin\AdminInterface;
use App\Http\Interfaces\Admin\UserInterface;
use App\Http\Interfaces\Admin\farmerInterface;
use App\Http\Interfaces\Admin\DepartmentInterface;

use App\Http\Repositories\Admin\AdminRepository;
use App\Http\Repositories\Admin\UserRepository;
use App\Http\Repositories\Admin\FarmerRepository;
use App\Http\Repositories\Admin\DepartmentRepository;
use Illuminate\Support\ServiceProvider;
class RepositoryServiceProvider extends ServiceProvider {
    public function register() {
        $this->app->bind(AdminInterface::class, AdminRepository::class);
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(farmerInterface::class, FarmerRepository::class);
        $this->app->bind(DepartmentInterface::class, DepartmentRepository::class);
    }

    public function boot() {
        //
    }
}
