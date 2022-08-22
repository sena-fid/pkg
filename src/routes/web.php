<?php

use Illuminate\Support\Facades\Route;
use Products\ProductController;


// Route::get('product', function(){

//     return view('product::index');
// });

Route::group(['namespace' => 'App\Product\Http\Controllers'], function() {

    Route::get('/', [ProductController::class, 'index'])->name('index');

});


    // Route::post('/store', [ProductController::class, 'store'])->name('store');
    // Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('edit');
    // Route::get('/detail/{id}', [ProductController::class, 'detail'])->name('detail');
    // Route::post('/update/{product}', [ProductController::class, 'update'])->name('update');

    // Route::post('/filtreleme-sonuclari', [ProductController::class, 'search'])->name('search');

    // Route::post('file-import', [ProductController::class, 'fileImport'])->name('file-import');

    // Route::post('store/property', [ProductController::class, 'propertyStore'])->name('store.property');
    // Route::get('/destroy/{property}', [ProductController::class, 'propertyDestroy'])->name('property.destroy');
    // Route::post('/propertyUpdate', [ProductController::class, 'propertyUpdate'])->name('property.propertyUpdate');


