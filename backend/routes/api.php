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

// Selection Post
Route::get('/selection-post', 'Api\Client\SelectionPost\IndexSelectionPostController');
Route::get('/selection-post/{selectionPostId}', 'Api\Client\SelectionPost\ShowSelectionPostController');

Route::middleware('auth:api')->group(function() {

    // User
    Route::get('/user', 'Api\ShowUserController')->name('api.user.show');
});
