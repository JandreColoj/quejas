<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleClient;

class LoginController extends Controller{

   /*
   |--------------------------------------------------------------------------
   | Login Controller
   |--------------------------------------------------------------------------
   |
   | This controller handles authenticating users for the application and
   | redirecting them to your home screen. The controller uses a trait
   | to conveniently provide its functionality to your applications.
   |
   */

   use AuthenticatesUsers;

   /**
    * Where to redirect users after login.
    *
    * @var string
    */
   protected $redirectTo = RouteServiceProvider::HOME;

   private $url_SW = '';
   private $client_id = '';
   private $client_secret = '';

   public function __construct(){
      $this->middleware('guest')->except('logout');
   }

   public function credential(){

      $this->url_SW = session('enviroment')=='test' ? env('pagalob2b_test') : env('pagalob2b_live');
      $this->client_id = session('enviroment')=='test' ? env('client_id_test') : env('client_id');
      $this->client_secret = session('enviroment')=='test' ? env('client_secret_test') : env('client_secret');
   }

   /*
   |--------------------------------------------------------------------------
   | Autenticacion con laravel passport en WS de pagalob2b
   |--------------------------------------------------------------------------
   |
   | Esta funcion envia las credenciales del usuario para obtener un token
   | para poder acceder a todas las funciones de pagalob2b.
   |
   */
    protected function getToken(Request $request){

      $this->credential();

      $guzzle = new GuzzleClient(['http_errors' => false]);

      $response = $guzzle->post($this->url_SW.'oauth/token', [
         ['allow_redirects' => [
            'max' => 10,
         ]],

         'form_params' => [
            'grant_type'    => 'password',
            'client_id'     => $this->client_id,
            'client_secret' => $this->client_secret,
            'username'      => $request->email,
            'password'      => $request->password,
            'scope'         => '*',
         ],
      ]);


      if($response->getStatusCode()==200) {

         $result =  json_decode((string) $response->getBody(), true);

         $request->session()->put('access_token',  $result['token_type'].' '.$result['access_token']);

         if($request->session()->has('access_token')){

            $guzzle = new GuzzleClient([
               'http_errors' => false,
               'headers' => [ 'Authorization' => session('access_token')],
            ]);

            $response = $guzzle->get($this->url_SW.'api/infoUser/');

            if($response->getStatusCode()==200){

               $datos = json_decode($response->getBody(), true);


               if($datos['datos']['tipo_usuario']!='administrador'){
                  return  redirect()->back()->withErrors(['Su usuario no tiene permisos para ingresar.'])->withInput();
               }

               //VALIDA SI ES USUARIO ADMINISTRADOR

               if ($datos['datos']['rol']=='admin.admin') {
                  $rol='admin';
               }else if($datos['datos']['rol']=='admin.operativo'){
                  $rol='operativo';
               }

               $request->session()->put('rol', $rol);

               return redirect('home');

            }else{

               return  redirect()->back()->withErrors(['Ocurrio un error al obtener la información del usuario. '])->withInput();
            }

            return redirect('home');

         }

      }else{

         $request->session()->forget('access_token');
         return  redirect()->back()->withErrors(['Las credenciales introducidas son incorrectas. '])->withInput();
      }

   }


}
