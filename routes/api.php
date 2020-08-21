<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::namespace('Api\v1')->group(function () {
//    Route::get('categorias', 'CategoryController@index');
//    Route::post('categorias', 'CategoryController@store');
//    Route::put('categorias/{id}', 'CategoryController@update');
//    Route::delete('categorias/{id}', 'CategoryController@destroy');
//});

Route::namespace('Api\v1')->group(function () {
    Route::prefix('v1')->group(function () {

        /**
         * Rota de Categorias
         */
        Route::get('categories/{id}/products', 'CategoryController@products');
        Route::apiResource('categorias', 'CategoryController');

        /**
         * Rota de Produtos
         */
        Route::apiResource('produtos', 'ProductController');

    });
});
