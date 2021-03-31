<?php

namespace App\Http\Middleware;

use Closure; 

class Roles{

   public function handle($request, Closure $next, $roles_permitted){

      if($request->session()->has('rol')){

         $roles = explode('|', $roles_permitted);

         foreach ($roles as $rol){
            if ($rol===session('rol')) {
               return $next($request);
            }   
         }
         
      }
      
      return redirect()->route('login');
   }

}
