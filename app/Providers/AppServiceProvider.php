<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use View;
use Illuminate\Support\Facades\Auth;
define("CUSTOMMER",1);
define("HOTELADMIN",2);
define("SYSTEMADMIN",4);
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('GreaterThan','CustomValidator@GreaterThan');

        Validator::replacer('GreaterThan', function($message, $attribute, $rule, $parameters) {
            return str_replace(':field', $parameters[0], $message);
        });
        View::composer('touradmin.layout.header',function($view){
            $userid=Auth::user()->id;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
