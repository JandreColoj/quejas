<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleClient;
use App\User;
use Auth;

class WelcomeController extends Controller{

   public function index(){
      return view('welcome');
   }

}
