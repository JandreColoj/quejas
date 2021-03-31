<?php

namespace App\Http\Controllers\Transacciones;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pagalo\Transacciones;
use App\Models\Pagalo\Empresas;
use App\Models\Config\Agencias;
use App\Models\Config\Zonas;
use App\Models\Usuario\UserRegister;
use Carbon\Carbon;
use App\User;
use Auth;

class TransaccionesController extends Controller{
     
    private $estado_produccion;
    private $distribuidor; 

   public function __construct(){
      $this->estado_produccion = env('APP_ENV')=='local' ? 'T' :'L';
      $this->distribuidor = 'BAM';
   }

   public function index(){
      return view('admin.transacciones.transacciones');
   }

   public function getTransactions(Request $request){

      $id_empresa = $request->empresa;
      $filter_empresa = isset($request->empresa) ? true : false;

      $filter_empresas = true; 
      $array_empresas = UserRegister::all()->pluck('id_registro')->toArray();
      
      if(isset($request->zona)){ 
         $array_empresas = UserRegister::where('id_zona', $request->zona)->pluck('id_registro')->toArray();
      }else if(isset($request->agencia)){ 
         $array_empresas = UserRegister::where('id_agencia', $request->agencia)->pluck('id_registro')->toArray();
      }if(isset($request->tipo)){

         if($request->tipo==1){
            $array_empresas = UserRegister::where('id_agencia', '!=',0)->pluck('id_registro')->toArray();
         }else{

            $consultores = User::with('RolUsuario')
                           ->whereHas('RolUsuario', function($query){
                              $query->whereHas('Rol', function($q){
                                 $q->where('slug','consultor');
                              });
                           })->where('estado',1)->pluck('id')->toArray();

            $array_empresas = UserRegister::whereIn('id_user', $consultores)->where('id_agencia', 0)->pluck('id_registro')->toArray();

         }
      }

      if(isset($request->fecha_inicio) && isset($request->fecha_fin)){
         $date_start = Carbon::parse($request->fecha_inicio)->startOfDay();
         $date_end   = Carbon::parse($request->fecha_fin)->endOfDay();  
      }else{
         $date_start = Carbon::now()->subDays(10);
         $date_end   = Carbon::now();
      }

      $transacciones = Transacciones::join('empresas', 'empresas.id', 'transacciones.id_empresa') 
                                       ->leftjoin('bancos_bines', 'bancos_bines.id', 'transacciones.id_bin_banco')
                                       ->whereBetween('transacciones.fecha_transaccion', [$date_start, $date_end]) 
                                       ->where('transacciones.estado_produccion',$this->estado_produccion)
                                       ->where('transacciones.estado',2) 
                                       ->when($filter_empresa, function($query) use ($id_empresa){
                                          return $query->where('empresas.id', $id_empresa);
                                       })->when($filter_empresas, function($query) use ($array_empresas){
                                          return $query->whereIn('empresas.id', $array_empresas);
                                       })
                                       ->select(
                                          'transacciones.id', 
                                          'transacciones.fecha_transaccion', 
                                          'transacciones.tipo_transaccion', 
                                          'transacciones.epayserver', 
                                          'transacciones.requestID', 
                                          'transacciones.requestToken', 
                                          'transacciones.firstName', 
                                          'transacciones.lastName', 
                                          'transacciones.accountNumber', 
                                          'transacciones.currency', 
                                          'transacciones.Total', 
                                          'empresas.nombre as empresa',
                                          'bancos_bines.banco'
                                       )->orderBy('transacciones.id','DESC')->get();    
      
      return response()->json(['transacciones' => $transacciones]);
   }

   public function getCommerce(){

      $empresas = Empresas::join('distribuidores', 'distribuidores.id', '=', 'empresas.id_distribuidor')
                           ->where('distribuidores.distribuidor',$this->distribuidor)
                           ->select(
                              'empresas.nombre',
                              'empresas.id'
                           )->get();

      return response()->json(['empresas' => $empresas ]);      
   }

   public function getZona(){
      $zonas = Zonas::where('estado',1)->get();
      return response()->json(['zonas' => $zonas ]);      
   }

   public function getAgencia(){

      $user = Auth::User(); 
      $usuario = User::find($user->id); 

      $agencias = Agencias::where('estado',1)->get();

      if($usuario->RolUsuario->Rol->slug=='gerenteZona'){
         $zona = Zonas::find($usuario->id_zona);
         $agencias = Agencias::where('estado',1)->where('zona',$zona->codigo)->get();
      }

      return response()->json(['agencias' => $agencias ]);      
   }
   
   public function getConsultor(){

      $consultores = User::with('RolUsuario')->where('estado',1)
                     ->whereHas('RolUsuario', function($query){
                        $query->whereHas('Rol', function($q){
                           $q->where('slug','consultor');
                        });
                  })->get();

      $user = Auth::User(); 
      $usuario = User::find($user->id); 

      if($usuario->RolUsuario->Rol->slug=='gerenteZona'){ 

         $consultores = User::with('RolUsuario')->where('estado',1)
                              ->whereHas('RolUsuario', function($query){
                                 $query->whereHas('Rol', function($q){
                                    $q->where('slug','consultor');
                                 });
                              })->where('id_zona', $usuario->id_zona)->get();
      }

      return response()->json(['consultores' => $consultores ]);    
   }

   public function getColaborador(){
      
      $user = Auth::User(); 
      $usuario = User::find($user->id);  
      $colaboradores = User::where('id_agencia', $usuario->id_agencia)->get();

      return response()->json(['colaboradores' => $colaboradores ]);    
   }

   public function getTransaction($id_transaccion){

      $transaccion = Transacciones::with('Productos')    
                                 ->where('transacciones.estado_produccion',$this->estado_produccion)
                                 ->where('transacciones.id',$id_transaccion) ->first();    
      
      return response()->json(['transaccion' => $transaccion]);
   }

}
