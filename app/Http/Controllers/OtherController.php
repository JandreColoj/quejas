<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleClient;
use App\User;
use Auth;

class OtherController extends Controller{

   public function test(){
      session(['enviroment' => 'test']);
      return redirect()->route('login');
   }

   public function production(){
      session(['enviroment' => 'production']);
      return redirect()->route('login');
   }


}
