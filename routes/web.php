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



Auth::routes();

Route::get('/', 'WelcomeController@index');

Route::group(['prefix' => 'public/'], function(){
   Route::get('getRegion', 'GeneralController@getRegion');
   Route::get('getDepartamentos/{codigo}', 'GeneralController@getDepartamentos');
   Route::get('getMunicipio/{codigo}', 'GeneralController@getMunicipio');

   Route::post('sendqueja', 'QuejasController@sendqueja');
   Route::post('buscarQueja', 'QuejasController@buscarQueja');
});


Route::group(['prefix' => 'api/'], function(){
   Route::post('getQuejas', 'QuejasController@getQuejas');
   Route::post('generateReportGeneral', 'QuejasController@generateReportGeneral');
});

Route::get('/home', 'HomeController@index');
Route::get('/reportes', 'HomeController@reportes');

Route::get('/logout', function () {
	Auth::logout();
   return redirect('/');
});
