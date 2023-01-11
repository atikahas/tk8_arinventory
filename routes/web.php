<?php

use Illuminate\Support\Facades\Route;

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
Route::get('data/getPublicItem.json', 'App\Http\Controllers\DropdownController@getPublicItem');
Route::get('data/getPublicBooking.json', 'App\Http\Controllers\DropdownController@getPublicBooking');


Route::group(['namespace' => 'App\Http\Controllers'], function()
{   

    Route::get('/', 'LoginController@show')->name('login.show');
    Route::get('/register', 'RegisterController@show')->name('register.show');
    Route::post('/register', 'RegisterController@register')->name('register.perform');
    Route::post('/login', 'LoginController@login')->name('login.perform');
        
        Route::group(['middleware' => ['auth', 'permission']], function() {
            Route::get('/logout', 'LogoutController@perform')->name('logout.perform');

            Route::get('data/getLocation', 'DropdownController@getLocation');
            Route::get('data/getCategory', 'DropdownController@getCategory');
            Route::get('data/getSubCategory', 'DropdownController@getSubCategory');
            Route::get('data/getCategoryExpenses', 'DropdownController@getCategoryExpenses');
            Route::get('data/getExpenseCategory', 'DropdownController@getExpenseCategory');
            Route::get('data/getExpenseSubCategory', 'DropdownController@getExpenseSubCategory');
            Route::get('data/getExpenseName', 'DropdownController@getExpenseName');

            Route::group(['prefix' => 'users'], function() {
                Route::get('/', 'UsersController@index')->name('users.index');
                Route::get('/create', 'UsersController@create')->name('users.create');
                Route::post('/create', 'UsersController@store')->name('users.store');
                Route::get('/{user}/show', 'UsersController@show')->name('users.show');
                Route::get('/{user}/edit', 'UsersController@edit')->name('users.edit');
                Route::patch('/{user}/update', 'UsersController@update')->name('users.update');
                Route::delete('/{user}/delete', 'UsersController@destroy')->name('users.destroy');
            });

            Route::group(['prefix' => 'posts'], function() {
                Route::get('/', 'PostsController@index')->name('posts.index');
                Route::get('/create', 'PostsController@create')->name('posts.create');
                Route::post('/create', 'PostsController@store')->name('posts.store');
                Route::get('/{post}/show', 'PostsController@show')->name('posts.show');
                Route::get('/{post}/edit', 'PostsController@edit')->name('posts.edit');
                Route::patch('/{post}/update', 'PostsController@update')->name('posts.update');
                Route::delete('/{post}/delete', 'PostsController@destroy')->name('posts.destroy');
            });

            Route::group(['prefix' => 'items'], function() {
                Route::get('/', 'ItemsController@index')->name('items.index');
                Route::get('/create', 'ItemsController@create')->name('items.create');
                Route::post('/create', 'ItemsController@store')->name('items.store');
                Route::get('/{item}/show', 'ItemsController@show')->name('items.show');
                Route::get('/edit/{item}/', 'ItemsController@edit')->name('items.edit');
                Route::patch('/{item}/update', 'ItemsController@update')->name('items.update');
            });

            Route::group(['prefix' => 'expenses'], function() {
                Route::get('/', 'ExpensesController@index')->name('expenses.index');
                Route::get('/create', 'ExpensesController@create')->name('expenses.create');
                Route::post('/create', 'ExpensesController@store')->name('expenses.store');
                Route::get('/{expense}/show', 'ExpensesController@show')->name('expenses.show');
                Route::get('/{expense}/edit', 'ExpensesController@edit')->name('expenses.edit');
                Route::patch('/{expense}/update', 'ExpensesController@update')->name('expenses.update');
                Route::get('/summary', 'ExpensesController@summary')->name('expenses.summary');
            });

            Route::group(['prefix' => 'booking'], function() {
                Route::get('/', 'BookingController@index')->name('booking.index');
                Route::get('/create', 'BookingController@create')->name('booking.create');
                Route::post('/create', 'BookingController@store')->name('booking.store');
                Route::get('/{booking}/show', 'BookingController@show')->name('booking.show');
                Route::get('/{booking}/edit', 'BookingController@edit')->name('booking.edit');
                Route::patch('/{booking}/update', 'BookingController@update')->name('booking.update');
            });

            Route::resource('roles', RolesController::class);
            Route::resource('permissions', PermissionsController::class);

            Route::get('/home', 'HomeController@index')->name('home.index');
        });

});