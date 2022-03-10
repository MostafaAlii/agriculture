<?php
namespace App\Providers;
use App\Http\Interfaces\Admin\DepartmentInterface;
use App\Http\Repositories\Admin\DepartmentRepository;
use Illuminate\Support\ServiceProvider;
class RepositoryServiceProvider extends ServiceProvider {
    public function register() {
        $this->app->bind(DepartmentInterface::class, DepartmentRepository::class);
    }

    public function boot() {
        //
    }
}
