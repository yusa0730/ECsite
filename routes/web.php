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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'ItemsController@index');
Route::get('/item/{item}', 'ItemsController@show');
Route::post('/checkitem','CheckitemController@store');
Route::get('/checkitem', 'CheckitemController@index');
Route::put('/checkitem/{id}', 'CheckitemController@update');
Route::delete('/checkitem/{id}', 'CheckitemController@destroy')->name('checkitem.destroy');
Route::get('/buy', 'BuyController@index');
Route::post('/buy', 'BuyController@store');
Route::resource('users', 'UsersController');
Route::get('/favorites', 'FavoritesController@index');
// Route::get('likes', 'UsersController@favorites')->name('users.likes');


Route::group(['middleware' => 'auth'],function(){
    Route::group(['prefix'=>'/{id}'],function(){
        Route::post('favorite', 'FavoritesController@store')->name('favorites.favorite');
        Route::delete('unfavorite', 'FavoritesController@destroy')->name('favorites.unfavorite');
    });
});

Route::group(['middleware' => ['auth']], function (){
    Route::get('messages/index', 'MessagesController@index')->name('messages.index');
    Route::post('messages/index', 'MessagesController@store')->name('messages.store');
    Route::delete('messages/index/{id}', 'MessagesController@destroy')->name('messages.destroy');
});
