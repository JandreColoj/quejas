<?php

namespace App\Http\Controllers\Admin\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pagalo\ParametroCategoria;
use App\Models\Pagalo\TiposEmpresa;
use App\Models\Pagalo\ParametroPlataforma;
use App\Models\Pagalo\ParametroLenguaje;
use App\Models\Pagalo\Modulos;
use App\Models\Pagalo\PlanConfiguracion;

class DatosController extends Controller{

   public function indexcategoriaEmpresa(){

      $categoria = ParametroCategoria::all();

      if($categoria){
         return response()->json(['datos' => $categoria], 200);
      }else{
         return response()->json(['mensaje' =>  'No se encuentran datos de la empresa'],404);
      }

   }

   public function indextipoEmpresa(){

      $tipos = TiposEmpresa::where('estado',1)->get();

      if($tipos){
         return response()->json(['datos' => $tipos], 200);
      }else{
         return response()->json(['mensaje' =>  'No se encuentran datos de la empresa'],404);
      }

   }

   public function listaModulos(){
      $plan = Modulos::all();

      if (!$plan) {
         return response()->json(['mensaje' =>  'Error al traer los modulos'],404);
      }
      return response()->json(['datos' => $plan], 200);
   }

   // public function listadoplataformas(){
   //    $plataforma = ParametroPlataforma::all();

   //    if (!$plataforma) {
   //       return response()->json(['mensaje' =>  'Error al traer plataformas'],404);
   //    }

   //    return response()->json(['datos' => $plataforma], 200);
   // }

   // public function listadolenguajes(){
   //    $lenguajes = ParametroLenguaje::all();

   //    if (!$lenguajes) {
   //       return response()->json(['mensaje' =>  'Error al traer lenguajes de programación'],404);
   //    }

   //    return response()->json(['datos' => $lenguajes], 200);
   // }

   public function planConfiguracion(){

      $plan = PlanConfiguracion::with("plan")->get();
      if (!$plan) {
         return response()->json(['mensaje' => 'Error al traer los planes'],404);
      }
      return response()->json(['datos' => $plan], 200);
   }


}
