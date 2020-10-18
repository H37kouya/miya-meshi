<?php

Route::middleware('auth:api')->group(function() {

    // SelectionPost
    Route::get('/selection-post', 'Api\Admin\SelectionPost\IndexSelectionPostController')->name('admin.selectionPost.index');
    Route::post('/selection-post', 'Api\Admin\SelectionPost\RegisterSelectionPostController')->name('admin.selectionPost.register');
    Route::get('/selection-post/{selectionPostId}', 'Api\Admin\SelectionPost\ShowSelectionPostController')->name('admin.selectionPost.show');
    Route::put('/selection-post/{selectionPostId}', 'Api\Admin\SelectionPost\UpdateSelectionPostController')->name('admin.selectionPost.update');
});
