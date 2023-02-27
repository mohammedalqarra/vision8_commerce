<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();
        $ip = request()->ip();

        if ($ip == '127.0.0.1') {
            $ip = '188.161.71.10';
            // $ip = '102.177.124.255';
        }
        $country = Http::get('http://www.geoplugin.net/json.gp?ip=' . $ip)->json();

        //$weather = Http::get('https://api.openweathermap.org/data/2.5/weather?q=Gaza&appid=24182f6e46329d7365f1ba44b5959c70&units=metric')->json();
        $weather = Http::get('https://api.openweathermap.org/data/2.5/weather?q='.$country['geoplugin_regionName'].'&appid=24182f6e46329d7365f1ba44b5959c70&units=metric')->json();

      //  dd($country);
        //dd($weather);

        //     dd(request()->ip());

        View::share('weather', $weather);
    }
}
