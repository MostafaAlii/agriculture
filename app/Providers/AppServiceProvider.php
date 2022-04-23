<?php
namespace App\Providers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
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
        Blade::if('check_guard',function(){
            if(Auth::guard('vendor')->check()){
               return false;
            }elseif(Auth::guard('web')->check()){
                return false;
            }elseif(Auth::guard('admin')->check()){
                return false;
            }
            else{
                return true;
            }

        });
    }
}
