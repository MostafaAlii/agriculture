<?php
namespace App\Providers;

use App\Models\Admin;
use App\Models\Farmer;
use App\Models\Department;
use App\Models\User;
use App\Models\Category;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        Paginator::useBootstrap();
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
      //  Schema::defaultStringLength(191);
        Blade::if('check_guard',function(){
            if(Auth::guard('vendor')->check()){
               return false;
            }elseif(Auth::guard('web')->check()){
                return false;
            }elseif(Auth::guard('admin')->check()){
                return false;
            }elseif(Auth::guard('worker')->check()){
                return false;
            }else{
                return true;
            }
        });
        
    }
}
