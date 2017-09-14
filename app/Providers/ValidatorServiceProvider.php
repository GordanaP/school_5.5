<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

class ValidatorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('alpha_spaces', function($attribute, $value)
        {
            return preg_match('/^[a-zA-Z ]+$/', $value);
        });

        Validator::extend('alpha_num_spaces', function($attribute, $value)
        {
            return preg_match('/^[a-zA-Z1-9 ]+$/', $value);
        });

        Validator::extend('alpha_dash_spaces', function($attribute, $value)
        {
            return preg_match('/^[a-zA-Z1-9-_ ]+$/', $value);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
