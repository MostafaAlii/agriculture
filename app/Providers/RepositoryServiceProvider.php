<?php
namespace App\Providers;
use App\Http\Interfaces\Admin\DepartmentInterface;
use App\Http\Interfaces\Admin\UserInterface;
use App\Http\Repositories\Admin\DepartmentRepository;
use App\Http\Repositories\Admin\UserRepository;
use Illuminate\Support\ServiceProvider;
class RepositoryServiceProvider extends ServiceProvider {
    public function register() {
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(DepartmentInterface::class, DepartmentRepository::class);
    }

    public function boot() {
        //
    }
}
