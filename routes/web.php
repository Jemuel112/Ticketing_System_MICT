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
use Illuminate\Support\Facades\Artisan;

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', function () {
        return view('dashboard');
    });
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

Route::resource('/MICT-Tickets', 'mTicketsController', ['only' => ['index', 'create', 'store', 'show', 'edit', 'update']]);
Route::post('/MICT-Tickets/comments/{comment}', 'mTicketsController@comment');
Route::get('/MyTickets', 'mTicketsController@myTickets');
Route::post('/MICT-Tickets/report', 'mTicketsController@report');
Route::GET('/All_Sort', 'mTicketsController@index');
Route::GET('/My_Sort', 'mTicketsController@myTickets');


Route::get('/Received_Calls', 'ReportsController@receivedCalls')->name('received.calls');
Route::POST('/Received_Calls/Report', 'ReportsController@reportreceivedCalls')->name('report.received.calls');

Route::resource('/departments', 'DepartmentsController');

Route::resource('/users', 'UsersController');

//Route::get('/Endorsement/{Endorsement}','EndorsementController@show');
Route::resource('/Endorsement', 'EndorsementController');


Route::get('/Endorsement/{id}/dl', 'EndorsementController@download');


//Route::get('/dl',function (){
//    return response()->download(public_path('Google_Event-1.mp3'),'sadsdasd.ico');
//});

Route::get('/clear-cache', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    $tickets = \App\mTicket::where('status', 'Resolve')->get();
    foreach ($tickets as $ticket){
        $ticket->status = 'Resolved';
        $ticket->save();
    }
    return "Cache cleared";
});

Auth::routes([
    'register' => false,
    'reset' => false,
]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/logout', function () {
    return view('auth.login');
});

