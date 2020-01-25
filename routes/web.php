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

Route::group(['middleware' => ['auth']], function() {
    Route::get('/', function () {
        return view('dashboard');
    });
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

Route::resource('/MICT-Tickets', 'mTicketsController',['only'=> ['index','create','store','show','edit']]);


//Route::get('/departments', 'DepartmentsController@index');
//Route::post('/departments', 'DepartmentsController@store');
//Route::get('/departments/{department}/edit', 'DepartmentsController@edit');
//Route::put('/departments/{department}', 'DepartmentsController@update');
Route::resource('/departments','DepartmentsController');



Route::resource('/users','UsersController');


Route::get('/clear-cache', function() {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    return  'CACHE CLEARED'; //Return anything
});

Auth::routes([
    'register' => false,
    'reset' => false,
]);

Route::get('/home', 'HomeController@index')->name('home');

