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
      $this->middleware('auth');
   }

   public function index(){

         return view('admin.provider.index');

   }

   public function reportes(){

         return view('admin.reportes.index');

   }


}
