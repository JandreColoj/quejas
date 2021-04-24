<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Config\Departamento_municipio;

class GeneralController extends Controller{


   public function getDepartamentos($codigo){

      if($codigo==='0') {
         $departamentos = Departamento_municipio::where('codigo_depto',0)->get();

      }else{
         $departamentos = Departamento_municipio::where('codigo_depto',0)->where('region',$codigo)->get();
      }


      return response()->json(['datos' => $departamentos, 'codigo' => $codigo]);
   }

   public function getMunicipio($codigo){

      $departamentos = Departamento_municipio::where('codigo_depto',$codigo)->get();

      return response()->json(['datos' => $departamentos]);
   }

   public function getRegion(){

      $regiones = Departamento_municipio::where('region',"!=", "")->get()->groupBy('region');

      return response()->json(['datos' => $regiones]);
   }



}
