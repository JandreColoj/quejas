<?php

namespace App\Http\Controllers\Inventario;
 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;   
use App\Models\Config\Inventario; 
use App\Models\Config\Agencias; 
use Carbon\Carbon; 
use App\User; 
use Auth; 

class InventarioController extends Controller{

   public function index(){
      return view('admin.inventario.inventarioView');
   }
    
   public function setInventario(Request $request){ 

      $fecha = Carbon::parse($request->fecha)->startOfDay();

      $inventario = Inventario::create([
         'fecha'       => $fecha,
         'central'     => 1 ,
         'descripcion' => $request->descripcion,
         'correlativo' => $request->codigo,
         'cantidad'    => $request->cantidad,
         'recibido'    => 1,
         'tipo'        => 'ingreso', 
      ]);

      return response()->json(['inventario' => $inventario ]); 
   }

   #inventario de total o por agencia
   public function getInventario(){
      
      $user = Auth::User(); 
      $usuario = User::find($user->id); 
 

      if($usuario->RolUsuario->Rol->slug=='gerenteAgencia'){
         $inventario = Inventario::with('Agencia')->where('estado',1)->where('central',0)->where('id_agencia', $usuario->id_agencia)->orderBy('id','DESC')->get();
      }else{
         $inventario = Inventario::with('Agencia')->where('estado',1)->where('central',1)->orderBy('id','DESC')->get();
      }
 

      $ingreso = $inventario->where('tipo','ingreso')->sum('cantidad');
      $salida = $inventario->where('tipo','salida')->sum('cantidad');
         
      $data = [
         'ingreso'    =>  $ingreso,
         'salida'     =>  $salida,
         'disponible' =>  $ingreso-$salida,
         'inventario' =>  $inventario,
      ];
      return response()->json(['data' => $data]); 
   }

   public function getInventarioAgencia($id_agencia){

      $inventario = Inventario::with('Agencia')->where('estado',1)->where('central',0)->where('id_agencia', $id_agencia)->orderBy('fecha','DESC')->get();

      $ingreso = $inventario->where('tipo','ingreso')->where('estado',1)->sum('cantidad');
      $salida = $inventario->where('tipo','salida')->where('estado',1)->sum('cantidad');
         
      $data = [
         'ingreso'    =>  $ingreso,
         'salida'     =>  $salida,
         'disponible' =>  $ingreso-$salida,
         'inventario' =>  $inventario,
      ];
      return response()->json(['data' => $data]); 
   }
   public function getInventarioAll(){

      $agencias = Agencias::where('estado',1)->get();


      $array_inventario = [];
      foreach ($agencias as  $agencia) {
         $inventario = Inventario::with('Agencia')->where('estado',1)->where('central',0)->where('id_agencia', $agencia->id)->orderBy('fecha','DESC')->get();

         $ingreso = $inventario->where('tipo','ingreso')->where('estado',1)->sum('cantidad');
         $salida = $inventario->where('tipo','salida')->where('estado',1)->sum('cantidad');

         $item = [
            'id'         => $agencia->id, 
            'nombre'     => $agencia->nombre, 
            'ingreso'    => $ingreso, 
            'salida'     => $salida, 
            'disponible' => $ingreso-$salida,
         ];

         array_push($array_inventario, $item);
        
      }

      return response()->json(['data' => $array_inventario]); 
   }

   #salida de inventario, entrada a una agencial
   public function subInventario(Request $request){
 
      $fecha = Carbon::parse($request->fecha)->startOfDay();

      $inventario = Inventario::create([
         'fecha'       => $fecha,
         'central'     => 1,
         'id_agencia'  => $request->agencia,
         'descripcion' => 'Envio de M-POS',
         'correlativo' => $request->codigo,
         'cantidad'    => $request->cantidad,
         'tipo'        => 'salida', 
      ]);

      $inventario = Inventario::create([
         'fecha'       => $fecha,
         'central'     => 0 ,
         'id_agencia'  => $request->agencia,
         'descripcion' => 'Envio de E-POS',
         'correlativo' => $request->codigo,
         'cantidad'    => $request->cantidad,
         'tipo'        => 'ingreso', 
         'recibido'    => 0, 
      ]);


      return response()->json(['inventario' => $inventario ]);
   }
   
}
