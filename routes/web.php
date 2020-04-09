<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', function () {
    return view('home');
});



 Route::get('/get_recipes', 'InfoController@getRecipes')->middleware('auth');
 Route::post('/recipe_order', 'InfoController@recipeOrder')->middleware('auth');
 Route::get('/pos', 'InfoController@index')->middleware('auth');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
    Route::resource('products','ProductController');
    Route::resource('extras','ExtraController');
});
