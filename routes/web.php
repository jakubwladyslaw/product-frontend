<?php
Route::prefix('product')->middleware('web')->group(function () {
    Route::get('delete/{id}', 'Jakub\ProductFrontend\Http\Controllers\ProductController@productDelete')->name('product.delete');
    Route::get('{id}', 'Jakub\ProductFrontend\Http\Controllers\ProductController@productForm')->name('product.form');
    Route::post('{id}', 'Jakub\ProductFrontend\Http\Controllers\ProductController@product');

});
Route::prefix('products')->middleware('web')->group(function () {
    Route::get('', 'Jakub\ProductFrontend\Http\Controllers\ProductsController@productsGet')->name('products');
});