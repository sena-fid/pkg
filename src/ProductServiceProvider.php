<?php

namespace App\Product;
use Illuminate\Support\ServiceProvider;


class ProductServiceProvider extends ServiceProvider
{

    public function boot()
    {

        // $this->app->make('App/Products/Http/Controllers/ProductController');

        $this->loadRoutesFrom(__DIR__. '/routes/web.php');
        $this->loadViewsFrom(__DIR__. '/views', 'product');

        // $this->mergeConfigFrom(

        //     __DIR__ . '/config/product.php',
        //     'product'

        // );

        // $this->publishes([

        //     __DIR__ . '/config/product.php' => config_path('product.php'),

        // ]);






    }



    public function register()
    {



    }

}
