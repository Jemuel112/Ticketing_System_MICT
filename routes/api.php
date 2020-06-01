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


Route::get('/departments', 'API\DepartmentController@index');
Route::get('/mTickets', 'API\MICTController@ticketCounter');
Route::post('/logout', 'API\MICTController@logout');
Route::get('/endorsements', 'EndorsementController@count');


//Route::get('/sample', 'DepartmentsController@sample');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

