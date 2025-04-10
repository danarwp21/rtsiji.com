<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\KandidateController;


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

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/get-nama', 'CheckingController@getNamaByNik')->name('get-nama');
Route::get('/input_pilihan', 'VoteController@pilih')->middleware('auth');
Route::post('/vote/{id}', 'VoteController@vote')->name('vote')->middleware('auth');

Route::get('/admin', 'AdminController@index')->name('admin');
Route::post('/admin/candidate', 'AdminController@store')->name('admin.store')->middleware('auth');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/kandidate/create', 'KandidateController@create')->name('kandidate.create');
    Route::get('/warga', 'AdminController@warga')->name('warga.index');
    Route::post('/kandidate', 'KandidateController@store')->name('kandidate.store');
    Route::delete('/kandidate/{id}', 'KandidateController@destroy')->name('kandidate.destroy');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/vote', 'VoteController@index')->name('vote.index');
    Route::post('/vote_save', 'VoteController@store')->name('vote.store');
});

Route::get('/vote/report', 'VoteController@report')->name('vote.report');


