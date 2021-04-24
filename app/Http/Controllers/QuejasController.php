<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Config\Departamento_municipio;
use App\Models\quejas;
use Illuminate\Support\Facades\Validator;
use App\Models\consumidor;
use App\Models\comercio;
use App\Models\sucursal;
use Illuminate\Support\Collection;
use Carbon\Carbon;


class QuejasController extends Controller{


   public function sendqueja(Request $request){

      $validation = Validator::make($request->all(), [
         'anonima'            => 'required',
         'fecha'              => 'required',
         'comercio_direccion' => 'required',
         'comercio_name'      => 'required',
         'comercio_nit'       => 'required',
         'detalle_queja'      => 'required',
         'municipio'          => 'required',
      ]);

      if($validation->fails()){
         return response()->json(['codigo'=> 400, 'error_message' => $validation->messages()->first()]);
      }

      $fecha = Carbon::parse($request->fecha);

      $comercio = comercio::where('nit', $request->comercio_nit)->first();

      if(!$comercio){

         $comercio = comercio::create([
            'nombre' => $request->comercio_name,
            'nit'    => $request->comercio_nit,
         ]);

      }

      $sucursal = sucursal::where('id_comercio', $comercio->id)
                              ->where('direccion', $request->comercio_direccion)
                              ->where('id_municipio', $request->municipio)
                              ->first();

      if(!$sucursal){
         $sucursal = sucursal::create([
            'telefono'     => '',
            'id_comercio'  => $comercio->id,
            'direccion'    => $request->comercio_direccion,
            'id_municipio' => $request->municipio,
         ]);

      }


      if(isset($request->consumidor_nombre)){
         $consumidor = consumidor::create([
            'nombre'   => isset($request->consumidor_nombre) ?? '',
            'telefono' => isset($request->consumidor_telefono) ?? '',
            'correo'   => isset($request->consumidor_correo) ?? '',
         ]);
      }


      $queja = quejas::create([
         'codigo'        => $this->createRandom(),
         'fecha'         => $fecha,
         'id_consumidor' => isset($consumidor) ? $consumidor->id : 0,
         'id_comercio'   => $comercio->id,
         'id_sucursal'   => $sucursal->id,
         'motivo'        => $request->detalle_queja,
         'estado'        => 1,
      ]);

      return response()->json([
         'codigo' => 200,
         'message' => 'El codigo de la queja '.$queja->codigo.', puedes consultar el estado de la queja ingresando en el buscador el código.'
      ]);

   }

   public function buscarQueja(Request $request){

      $validation = Validator::make($request->all(), [
         'codigo' => 'required',
      ]);

      if($validation->fails()){
         return response()->json(['codigo'=> 400, 'error_message' => $validation->messages()->first()]);
      }

      $queja = quejas::with('comercio', 'sucursal')->where('codigo', $request->codigo)->first();

      if(!$queja){
         return response()->json(['codigo'=> 400, 'error_message' =>  "El Codigo de queja no existe en nuestros registros."]);
      }

      return response()->json([
         'codigo' => 200,
         'queja'  => $queja
      ]);

   }


   public function getQuejas(Request $request){

      $region       = isset($request->region)  ? true : false;
      $departamento = isset($request->departamento)   ? true : false;
      $municipio    = isset($request->municipio)   ? true : false;
      $date_start   = $request->has('fechaInicio') ? Carbon::parse($request->fechaInicio)->startOfDay() : Carbon::now()->subWeek(100)->startOfDay();
      $date_end     = $request->has('fechaFinal') ? Carbon::parse($request->fechaFinal)->startOfDay() : Carbon::now()->endOfDay();


      $comercios = comercio::where(function($query) use ($request){
         $query->where('nombre',  'LIKE',  '%'.$request->busqueda.'%');
      })->pluck('id')->toArray();


      if($region && $region!=0){
         $departamentos = Departamento_municipio::where('region', $request->region)->pluck('id');
         $municipios = Departamento_municipio::whereIn('codigo_depto', $departamentos)->pluck('id');
      }

      if($departamento){
         $municipios = Departamento_municipio::where('codigo_depto', $request->departamento)->pluck('id');
      }

      if($municipio){
         $municipios = [$request->municipio];
      }

      if (isset($municipios)) {
         $sucursal = sucursal::whereIn('id_comercio', $comercios)->whereIn('id_municipio', $municipios)->pluck('id');
         $fitro_sucursal= true;
      }else{
         $sucursal = [];
         $fitro_sucursal= false;
      }

      $quejas = quejas::with('comercio', 'sucursal','consumidor')
                        ->whereIn('id_comercio', $comercios)
                        ->whereBetween('fecha', [$date_start, $date_end])
                        ->when($fitro_sucursal, function($query) use ($sucursal){

                           return $query->whereIn('id_sucursal', $sucursal);

                        })
                        ->get();

      return response()->json([
         'codigo' => 200,
         'datos'  => $quejas
      ]);

   }


   function createRandom() {

      $chars = "abcdefghijkmnopqrstuvwxyz023456789";
      srand((double)microtime()*1000000);
      $i = 0;
      $pass = '' ;

      while ($i <= 7) {
          $num = rand() % 33;
          $tmp = substr($chars, $num, 1);
          $pass = $pass . $tmp;
          $i++;
      }

      return $pass;
   }


   public function generateReportGeneral(Request $request){

      $region       = isset($request->region)  ? true : false;
      $departamento = isset($request->departamento)   ? true : false;
      $municipio    = isset($request->municipio)   ? true : false;
      $date_start   = $request->has('fechaInicio') ? Carbon::parse($request->fechaInicio)->startOfDay() : Carbon::now()->subWeek(100)->startOfDay();
      $date_end     = $request->has('fechaFinal') ? Carbon::parse($request->fechaFinal)->startOfDay() : Carbon::now()->endOfDay();

      $comercios = comercio::where(function($query) use ($request){
         $query->where('nombre',  'LIKE',  '%'.$request->busqueda.'%');
      })->pluck('id')->toArray();


      if($region && $region!=0){
         $departamentos = Departamento_municipio::where('region', $request->region)->pluck('id');
         $municipios = Departamento_municipio::whereIn('codigo_depto', $departamentos)->pluck('id');
      }

      if($departamento){
         $municipios = Departamento_municipio::where('codigo_depto', $request->departamento)->pluck('id');
      }

      if($municipio){
         $municipios = [$request->municipio];
      }

      if (isset($municipios)) {
         $sucursal = sucursal::whereIn('id_comercio', $comercios)->whereIn('id_municipio', $municipios)->pluck('id');
         $fitro_sucursal= true;
      }else{
         $sucursal = [];
         $fitro_sucursal= false;
      }

      $quejas = quejas::with('comercio', 'sucursal','consumidor')
                        ->whereIn('id_comercio', $comercios)
                        ->whereBetween('fecha', [$date_start, $date_end])
                        ->when($fitro_sucursal, function($query) use ($sucursal){

                           return $query->whereIn('id_sucursal', $sucursal);

                        })->get();

      $id_comercios = $quejas->pluck('id_comercio');

      $comercios = comercio::whereNotIn('id', $id_comercios)->get();


      /************ TOP COMERCIOS ************/
         $top_comercios = $quejas->groupBy('comercio.nombre')->transform(function ($values, $key){
            return [
               'name'  => $key,
               'total' =>  $values->count('id'),
            ];
         });

      /************ TOP sucursal ************/
         $top_sucursales = $quejas->groupBy('sucursal.direccion')->transform(function ($values, $key){
            return [
               'name'  => $values[0]->comercio->nombre. ' - '.$key,
               'total' =>  $values->count('id'),
            ];
         });

      /************ region ************/
         $regiones = $quejas->groupBy('sucursal.ubicacion.departamento.region')->transform(function ($values, $key){
            return [
               'name'  => $key,
               'y' =>  $values->count('id'),
            ];
         });

      /************ departamentos ************/
         $departamentos = $quejas->groupBy('sucursal.ubicacion.departamento.nombre')->transform(function ($values, $key){
            return [
               'name'  => $key,
               'y' =>  $values->count('id'),
            ];
         });

      /************ municipios ************/
         $municipios = $quejas->groupBy('sucursal.ubicacion.nombre')->transform(function ($values, $key){
            return [
               'name'  => $key,
               'y' =>  $values->count('id'),
            ];
         });

      /************ DAYS quejas ************/
      $quejas_day = $quejas->sortBy('id')->groupBy(function($queja) {
         return Carbon::parse($queja->fecha)->format('d/m/Y'); // grouping by years
      })->transform(function ($item, $key){
         return [
            'name'     => $key,
            'cantidad' => $item->count('id'),
         ];
      });


      $response = [
         'top_comercios' =>  [
            'comercios' => $top_comercios->pluck('name'),
            'quejas'    => $top_comercios->pluck('total'),
         ],
         'top_sucursales' =>  [
            'sucursales' => $top_sucursales->pluck('name'),
            'quejas'    => $top_sucursales->pluck('total'),
         ],
         'regiones'      => $regiones->values(),
         'departamentos' => $departamentos->values(),
         'municipios'    => $municipios->values(),

         'quejas_day'  => [
            'name'     => $quejas_day->pluck('name'),
            'cantidad' => $quejas_day->pluck('cantidad'),
         ],
         'total_quejas'  => $quejas->count('id'),

         'queja'         => $quejas,
         'notComercios'  => $comercios
      ];

      return response()->json($response);

   }

}
