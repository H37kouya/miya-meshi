<?php

Route::middleware('auth:api')->group(function() {

    // SelectionPost
    Route::get('/selection-post', 'Api\Admin\SelectionPost\IndexSelectionPostController')->name('admin.selectionPost.index');
    Route::post('/selection-post', 'Api\Admin\SelectionPost\RegisterSelectionPostController')->name('admin.selectionPost.register');
    Route::get('/selection-post/{selectionPostId}', 'Api\Admin\SelectionPost\ShowSelectionPostController')->name('admin.selectionPost.show');
    Route::put('/selection-post/{selectionPostId}', 'Api\Admin\SelectionPost\UpdateSelectionPostController')->name('admin.selectionPost.update');
    Route::delete('/selection-post/{selectionPostId}', 'Api\Admin\SelectionPost\DeleteSelectionPostController')->name('admin.selectionPost.delete');

    Route::get('/shop', 'Api\Admin\Shop\IndexShopController')->name('admin.shop.index');
    Route::post('/shop', 'Api\Admin\Shop\RegisterShopController')->name('admin.shop.register');
    Route::get('/shop/{shopId}', 'Api\Admin\Shop\GetShopController')->name('admin.shop.show');
    Route::put('/shop/{shopId}', 'Api\Admin\Shop\UpdateShopController')->name('admin.shop.update');
    Route::delete('/shop/{shopId}', 'Api\Admin\Shop\DeleteShopController')->name('admin.shop.delete');

    Route::post('/shop/menu', 'Api\Admin\ShopMenu\RegisterShopMenuController')->name('admin.shopMenu.register');
});
