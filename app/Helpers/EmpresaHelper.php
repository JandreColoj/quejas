<?php
namespace App\Helpers;

use App\Models\Admin\UsuarioEmpresa;
use App\Models\Admin\Empresas\Empresas;

class EmpresaHelper{

   public static function getID($id_user = false){

      if(!$id_user){
         $id_user = auth()->id();
      }

      $usuario =  UsuarioEmpresa::where('id_user', $id_user)->first();

      return $usuario->id_empresa;

   }

 
 

}
