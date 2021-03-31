<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleClient;
use App\User;
use Auth;

class HomeController extends Controller{

   private $url_SW = '';

   public function __construct(){
      // dd([session('enviroment'),session('access_token')]);
      $this->middleware('AccesToken');
      $this->url_SW = session('enviroment')=='test' ? env('pagalob2b_test') : env('pagalob2b_live');
   }

   public function index(){

      $infoUser = $this->infoUser();
      $datos = $infoUser['datos'];

      if (session('rol')=='admin') {
         return view('dashboard.index', compact('datos'));
      }else if(session('rol')=='operativo'){
         return view('admin.provider.index');
      }
   }

   public function infoUser(){

      $guzzle = new GuzzleClient([
         'http_errors' => false,
         'headers' => [ 'Authorization' => session('access_token')],
      ]);

      $response = $guzzle->get($this->url_SW.'api/infoUser/');

      if($response->getStatusCode()==200){

         return  json_decode($response->getBody(), true);

      }else{
         return false;
      }

   }

   public function parametros(){

      $guzzle = new GuzzleClient([
         'http_errors' => false,
         'headers' => [ 'Authorization' => session('access_token')],
      ]);

      $response = $guzzle->get($this->url_SW.'api/admin/parametros');

      if($response->getStatusCode()==200){

         return  json_decode($response->getBody(), true);

      }else{
         return false;
      }

   }
}
