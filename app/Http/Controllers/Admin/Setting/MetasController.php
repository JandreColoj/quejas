<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request; 
use App\Models\Config\Agencias;
use App\Models\Config\Metas;
use App\Models\Usuario\UserRegister; 
use App\Models\Config\Zonas; 
use App\Models\Pagalo\Transacciones; 
use Carbon\Carbon; 
use App\User;

class MetasController extends Controller{

   private $estado_produccion; 

   public function __construct(){
      $this->estado_produccion = env('APP_ENV')=='local' ? 'T' :'L'; 
   }


   public function index(){
      return view('admin.config.metas.metasView');
   }

 
   public function getAgencias(){

      $agencias = Agencias::with('Zona')->where('estado',1)->get();

      return response()->json(['agencias' =>  $agencias]);
   }

   public function getConsultor(){

      $consultores = User::with('RolUsuario','Zona')
                     ->whereHas('RolUsuario', function($query){
                        $query->whereHas('Rol', function($q){
                           $q->where('slug','consultor');
                        });
                     })->where('estado',1)->get();

      return response()->json(['consultores' =>  $consultores]);
   }

   public function setMeta(Request $request){ 
     
      $mes = new Carbon(date('Y').'-'.$request->mes.'-01 00:00:00'); 
 

      if(isset($request->rol_usuario)){
          
         $meta = Metas::updateOrCreate(
            [ 'id_consultor' => $request->id,
              'mes'          => $mes
            ],
            [
               'afiliaciones' => $request->cantidad,  
               'facturacion'  => $request->facturacion,
            ]
         );

      }else{

         $meta = Metas::updateOrCreate(
            [ 'id_agencia' => $request->id,
              'mes'        => $mes
            ],
            [
               'afiliaciones' => $request->cantidad,  
               'facturacion'  => $request->facturacion,
            ]
         );
   
      }

      return response()->json(['meta' =>  $meta]);
   }

   public function setMetaGeneral(Request $request){ 
       
      $mes = new Carbon(date('Y').'-'.$request->mes.'-01 00:00:00'); 
      
      #agencias
      if($request->tipo==1){

         $agencias = Agencias::where('estado',1)->get();

         foreach ($agencias as   $agencia) {

            $meta = Metas::updateOrCreate(
               [ 'id_agencia' => $agencia->id,
                 'mes'        => $mes
               ],
               [
                  'afiliaciones' => $request->cantidad,  
                  'facturacion'  => $request->facturacion,
               ]
            );
      
         }


      }else if($request->tipo==2){

         $consultores = User::with('RolUsuario','Zona')
                           ->whereHas('RolUsuario', function($query){
                              $query->whereHas('Rol', function($q){
                                 $q->where('slug','consultor');
                              });
                           })->where('estado',1)->get();

         foreach ($consultores as   $consultor) {

            $meta = Metas::updateOrCreate(
               [ 'id_consultor' => $consultor->id,
                  'mes' => $mes
               ],
               [
                  'afiliaciones' => $request->cantidad,  
                  'facturacion'  => $request->facturacion,
               ]
            );
      
         }

      }

      return response()->json(['meta' =>  $meta]);
   }

   public function getMeta(Request $request){ 

      if(isset($request->mes)){
         $inicio = new Carbon(date('Y').'-'.$request->mes.'-01 00:00:00');  
         $fin = $inicio->copy()->endOfMonth();  
      }else{
         $inicio = Carbon::now()->firstOfMonth()->startOfDay();
         $fin = Carbon::now()->endOfMonth()->endOfDay();
      }

      if(isset($request->rol_usuario)){
         $meta = Metas::where('id_consultor', $request->id)->where('mes', $inicio)->first();
         $afiliaciones = UserRegister::where('id_user',$request->id)->where('created_at','>',$inicio)->where('created_at','<',$fin)->pluck('id_registro')->toArray();
      }else{
         
         $meta = Metas::where('id_agencia', $request->id)->where('mes', $inicio)->first();
         $afiliaciones = UserRegister::where('id_agencia',$request->id)->where('created_at','>',$inicio)->where('created_at','<',$fin)->pluck('id_registro')->toArray();
      }
 

      $facturando = 0;
      foreach ($afiliaciones as  $id_empresa) {
                           
            $transacciones = Transacciones::join('empresas', 'empresas.id', 'transacciones.id_empresa')
                              ->where('empresas.id',$id_empresa)
                              ->whereBetween('transacciones.fecha_transaccion', [$inicio,  $inicio->copy()->addMonth(2)->endOfMonth()->endOfDay()])
                              ->where('transacciones.estado',2) 
                              ->where('transacciones.currency','GTQ')
                              ->where('transacciones.estado_produccion',$this->estado_produccion)->get();
 
            if($transacciones->sum('Total')>=$meta->facturacion) {
               $facturando++;
            }
      }
 
      $data = [
         'meta'             => $meta ? $meta->afiliaciones : 0,
         'afiliaciones'     => count($afiliaciones),
         'conFacturacion'   => $facturando, 
         'sinFacturacion'   => count($afiliaciones)-$facturando, 
      ];

      return response()->json(['meta' =>  $data]);
   }
}
