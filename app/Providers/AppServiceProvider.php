<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Khachhang;
use App\Models\Sanpham;
use App\Models\Donhang;
use App\Models\Admin;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        view()->composer('*', function($view){
            $sanpham12 = Sanpham::all()->count();
            $donhang12 = Donhang::all()->count();
            $khachhang12 = Khachhang::all()->count();
            $admin12 = Admin::all()->count();

            $view->with(compact('sanpham12', 'donhang12', 'khachhang12', 'admin12'));
        });

            
        
        
    }
}
