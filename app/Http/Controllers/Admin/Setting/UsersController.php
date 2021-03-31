<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Usuario\Roles;
use App\Models\Config\Agencias;
use App\Models\Config\Zonas;
use App\Models\Usuario\RoleUsuario;
use GuzzleHttp\Client as GuzzleClient;
use App\User;

class UsersController extends Controller{

   private $url_SW = '';

   public function __construct(){
      $this->url_SW = session('enviroment')=='test' ? env('pagalob2b_test') : env('pagalob2b_live');
   }

   public function getUsuarios(Request $request){

      $guzzle = new GuzzleClient([
         'http_errors' => false,
         'headers' => [
            'Content-Type' => 'application/json',
            'Authorization' => session('access_token'),
         ]
      ]);

      $response = $guzzle->post($this->url_SW.'api/admin/config/usuario/getUsuarios', ['body'=> json_encode($request->all())]);

      if($response->getStatusCode()==200){
         return $response->getBody();
      }else{
         return response()->json(['codigo'=> 400, 'error_message' => 'Ocurrio un error en la conexion']);
      }

   }

   public function saveUser(Request $request){

      $guzzle = new GuzzleClient([
         'http_errors' => false,
         'headers' => [
            'Content-Type' => 'application/json',
            'Authorization' => session('access_token'),
         ]
      ]);

      $response = $guzzle->post($this->url_SW.'api/admin/config/usuario/saveUser', ['body'=> json_encode($request->all())]);

      if($response->getStatusCode()==200){
         return $response->getBody();
      }else{
         return response()->json(['codigo'=> 400, 'error_message' => 'Ocurrio un error en la conexion']);
      }

   }

   public function updateUser(Request $request){

      $guzzle = new GuzzleClient([
         'http_errors' => false,
         'headers' => [
            'Content-Type' => 'application/json',
            'Authorization' => session('access_token'),
         ]
      ]);

      $response = $guzzle->post($this->url_SW.'api/admin/config/usuario/updateUser', ['body'=> json_encode($request->all())]);

      if($response->getStatusCode()==200){
         return $response->getBody();
      }else{
         return response()->json(['codigo'=> 400, 'error_message' => 'Ocurrio un error en la conexion']);
      }

   }




}
