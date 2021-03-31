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

Route::get('/logout', function () {
	Session::flush();
   return redirect('/login');
});

Route::get('pdf', 'Providers\providerController@generatePDF_detail'); #


Route::get('enviroment_test', 'OtherController@test');
Route::get('enviroment_production', 'OtherController@production');

#LOGIN EN WS PAGALOB2B
Route::post('login_pagalob2b', 'Auth\LoginController@getToken')->name('login_pagalob2b');
Route::get('infoUser', 'GeneralController@infoUser')->middleware('AccesToken');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');


Route::group(['middleware'=> 'Roles:admin|operativo'],function (){
   Route::get('providers', 'Providers\providerController@index')->name('providers'); #

   Route::group(['prefix' => 'api/'], function(){

      Route::group(['prefix' => 'registros/'], function(){

         Route::post('getProviders', 'Providers\providerController@getProviders'); #
         Route::get('getProvider/{id}', 'Providers\providerController@getProvider'); #

         Route::get('getCategorias', 'Afiliaciones\AfiliacionesController@getCategorias');
         Route::get('listadotipos', 'Afiliaciones\AfiliacionesController@listadotipos');
         Route::put('update', 'Afiliaciones\AfiliacionesController@updateRegister');
         Route::post('saveImage', 'Afiliaciones\AfiliacionesController@saveImage');
         Route::post('checkDocument', 'Afiliaciones\AfiliacionesController@checkDocument');
         Route::post('newbank', 'Afiliaciones\AfiliacionesController@newbank');
         Route::put('updateBank/{id}', 'Afiliaciones\AfiliacionesController@updateBank');

         //Comisiones
         Route::post('getTipoComision', 'Providers\providerController@getTipoComision'); #
         Route::post('setTipoComision', 'Providers\providerController@setTipoComision'); #
         Route::post('detailComision', 'Providers\providerController@detailComision'); #
         Route::post('generatePDF_detail', 'Providers\providerController@generatePDF_detail'); #

         //Productos
         Route::get('getProducts/{id_provider}', 'Providers\providerController@getProducts');
         Route::post('setCommissionProduct', 'Providers\providerController@setCommissionProduct');

         //Promotions
         Route::post('getPromotions/{id_provider}', 'Providers\providerController@getPromotions');


         Route::get('habilitar/{id}', 'Providers\providerController@habilitar'); #
         Route::get('deshabilitar/{id}', 'Providers\providerController@deshabilitar'); #


         Route::group(['prefix' => 'product/'], function(){
            Route::post('exportExcel', 'Providers\providerController@exportExcelProducts'); #
            Route::post('updateComision/{id}', 'Providers\providerController@updateComision'); #
         });

      });

   });

});

Route::group(['middleware'=> 'Roles:admin'],function (){

   Route::get('clientes', 'Clientes\ClientesController@index')->name('clientes'); #

   Route::get('escritorio', 'HomeController@index')->name('escritorio'); #
   Route::get('ajustesGenerales', 'Admin\Setting\GeneralController@index')->name('ajustesGenerales'); #
   Route::get('registro', 'Afiliaciones\RegistroController@index')->name('registro');
   Route::get('afiliaciones', 'Afiliaciones\AfiliacionesController@index')->name('afiliaciones');
   Route::get('pedidos', 'Pedidos\PedidosController@index')->name('pedidos'); #
   Route::get('inventario', 'Inventario\InventarioController@index')->name('inventario');
   Route::get('ventaPOS', 'Inventario\VentaPosController@index')->name('ventaPOS');
   Route::get('reportes', 'Reportes\ReportesController@index')->name('reportes');

   Route::group(['prefix' => 'api/'], function(){

      Route::group(['prefix' => 'config/'], function(){

         Route::group(['prefix' => 'usuario/'], function(){
            Route::post('getUsuarios', 'Admin\Setting\UsersController@getUsuarios'); #
            Route::post('saveUser', 'Admin\Setting\UsersController@saveUser'); #
            Route::post('updateUser', 'Admin\Setting\UsersController@updateUser'); #
         });

      });

      Route::group(['prefix' => 'inventario/'], function(){
         Route::post('setInventario', 'Inventario\InventarioController@setInventario');
         Route::get('getInventario', 'Inventario\InventarioController@getInventario');
         Route::get('getInventarioAll', 'Inventario\InventarioController@getInventarioAll');
         Route::post('subInventario', 'Inventario\InventarioController@subInventario');
         Route::get('getInventarioAgencia/{agencia}', 'Inventario\InventarioController@getInventarioAgencia');
      });

      Route::group(['prefix' => 'pedidos/'], function(){
         Route::post('getPedidos', 'Pedidos\PedidosController@getPedidos');
         Route::post('getPedidos/exportExcel', 'Pedidos\PedidosController@exportExcel');
         Route::get('getPedido/{id}', 'Pedidos\PedidosController@getPedido');
         Route::get('getPedido/{id}', 'Pedidos\PedidosController@getPedido');
         // Route::get('getCommerce', 'Transacciones\TransaccionesController@getCommerce');
         // Route::get('getZona', 'Transacciones\TransaccionesController@getZona');
         // Route::get('getAgencia', 'Transacciones\TransaccionesController@getAgencia');
         // Route::get('getConsultor', 'Transacciones\TransaccionesController@getConsultor');
         // Route::get('getColaborador', 'Transacciones\TransaccionesController@getColaborador');
      });

      Route::group(['prefix' => 'escritorio/'], function(){
         Route::post('getDetails', 'Escritorio\EscritorioController@getDetails'); #
         Route::post('detalleVenta', 'Escritorio\EscritorioController@detalleVenta'); #
         Route::post('getMetas', 'Escritorio\EscritorioController@getMetas');
      });

      Route::group(['prefix' => 'clientes/'], function(){
         Route::post('getClientes', 'Clientes\ClientesController@getClientes');
         Route::get('getClientes/{id}', 'Clientes\ClientesController@detailClient');
      });

      Route::group(['prefix' => 'reports/'], function(){
         Route::post('generateReportGeneral', 'Reportes\ReportesController@generateReportGeneral');
         Route::get('getResumen', 'Reportes\ReportesController@getResumen');
         Route::post('exportExcel', 'Reportes\ReportesController@exportExcel');
         Route::get('getProviders', 'Reportes\ReportesController@getProviders');
      });

      Route::get('categoriasEmpresa','Admin\Setting\DatosController@indexcategoriaEmpresa');
      Route::get('tiposempresa','Admin\Setting\DatosController@indextipoEmpresa');
      Route::get('planConfiguracion', 'Admin\Setting\DatosController@planConfiguracion');

      Route::get('parametros', 'HomeController@parametros');


   });

   Route::post('creacionEmpresa','Afiliaciones\RegistroController@createRegister');

});
