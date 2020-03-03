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

use Illuminate\Http\Request;

Route::group(['middleware' => ['auth']], function() {
    Route::get('/', function () {
        return view('dashboard');
    });
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

Route::resource('/MICT-Tickets', 'mTicketsController',['only'=> ['index','create','store','show','edit','update']]);
Route::post('/MICT-Tickets/comments/{comment}', 'mTicketsController@comment');
Route::get('/MyTickets', 'mTicketsController@myTickets');
Route::post('/MICT-Tickets/report', 'mTicketsController@report');
Route::GET('/Sort', 'mTicketsController@index');


Route::GET('/Received_Calls', 'ReportsController@receivedCalls');

//Route::get('/departments', 'DepartmentsController@index');
//Route::post('/departments', 'DepartmentsController@store');
//Route::get('/departments/{department}/edit', 'DepartmentsController@edit');
//Route::put('/departments/{department}', 'DepartmentsController@update');
Route::resource('/departments','DepartmentsController');

Route::resource('/users','UsersController');

Route::resource('/Endorsement','EndorsementController');

Route::get('/dl',function (){
    return response()->download(public_path('Google_Event-1.mp3'));
});

Route::get('/clear-cache', function() {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    return "Cache cleared";
});

Auth::routes([
    'register' => false,
    'reset' => false,
]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/logout',function (){
    return view('auth.login');
});

