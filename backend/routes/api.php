<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->group(function() {

    // User
    Route::get('/user', 'Api\ShowUserController');

    // Admin SelectionPost
    Route::get('/admin/selection-post', 'Api\Admin\SelectionPost\IndexSelectionPostController');
    Route::post('/admin/selection-post', 'Api\Admin\SelectionPost\RegisterSelectionPostController');
    Route::get('/admin/selection-post/{selectionPostId}', 'Api\Admin\SelectionPost\ShowSelectionPostController');
    Route::put('/admin/selection-post/{selectionPostId}', 'Api\Admin\SelectionPost\UpdateSelectionPostController');
});
