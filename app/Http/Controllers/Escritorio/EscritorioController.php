<?php

namespace App\Http\Controllers\Escritorio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario\UserRegister;
use GuzzleHttp\Client as GuzzleClient;
use App\User;
use Auth;

class EscritorioController extends Controller{

   private $url_SW = '';

   public function __construct(){
      $this->middleware('AccesToken');
      $this->url_SW = session('enviroment')=='test' ? env('pagalob2b_test') : env('pagalob2b_live');
   }

   public function getDetails(Request $request){

      $guzzle = new GuzzleClient([
         'http_errors' => false,
         'headers' => [
            'Content-Type' => 'application/json',
            'Authorization' => session('access_token'),
         ]
      ]);

      $response = $guzzle->post($this->url_SW.'api/admin/escritorio/getDetails', ['body'=> json_encode($request->all())]);

      if($response->getStatusCode()==200){
         return $response->getBody();
      }else{
         $result = json_decode($response->getBody(), true);
         return response()->json(['codigo'=> 400, 'result' => $result['message_error']]);
      }
   }

   public function detalleVenta(Request $request){

      $guzzle = new GuzzleClient([
         'http_errors' => true,
         'headers' => [
            'Content-Type' => 'application/json',
            'Authorization' => session('access_token'),
         ]
      ]);

      $response = $guzzle->post($this->url_SW.'api/admin/escritorio/detalleVenta', ['body'=> json_encode($request->all())]);

      if($response->getStatusCode()==200){
         return $response->getBody();
      }else{
         $result = json_decode($response->getBody(), true);
         return response()->json(['codigo'=> $result['codigo'], 'message_error' => $result['message_error']]);
      }

   }

}
