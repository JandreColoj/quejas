<?php

namespace App\Http\Controllers\Clientes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleClient;

class ClientesController extends Controller{

   private $url_SW = '';

   public function __construct(){
      $this->url_SW = session('enviroment')=='test' ? env('pagalob2b_test') : env('pagalob2b_live');
   }

   public function index(){
      return view('admin.clientes.clientes');
   }

   public function getClientes(Request $request){

      $guzzle = new GuzzleClient([
         'http_errors' => false,
         'headers' => [
            'Content-Type' => 'application/json',
            'Authorization' => session('access_token'),
         ]
      ]);

      $response = $guzzle->post($this->url_SW.'api/admin/client/getClient', ['body'=> json_encode($request->all())]);

      if($response->getStatusCode()==200){
         return $response->getBody();
      }else{
         return response()->json(['codigo'=> 400, 'error_message' => 'Ocurrio un error en la conexion']);
      }

   }

   public function detailClient($id_cliente){

      $guzzle = new GuzzleClient([
         'http_errors' => false,
         'headers' => [
            'Content-Type' => 'application/json',
            'Authorization' => session('access_token'),
         ]
      ]);

      $response = $guzzle->get($this->url_SW.'api/admin/client/getClient/'.$id_cliente);


      if($response->getStatusCode()==200){
         return $response->getBody();
      }else{
         return response()->json(['codigo'=> 400, 'error_message' => 'Ocurrio un error en la conexion']);
      }

   }
}
