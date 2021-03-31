<?php

namespace App\Http\Controllers\Inventario;
 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;   
use App\Models\Admin\Venta;
use Illuminate\Support\Facades\Validator;
use App\Models\Config\Inventario;
use Carbon\Carbon; 
use App\User;
use Storage; 
use Auth; 

class VentaPosController extends Controller{

   public function index(){
      return view('admin.ventaPOS.ventaView');
   }
     
   public function POS(Request $request){
 
      $validation = Validator::make($request->all(), [
         'fecha'       => 'required', 
         'nombre'      => 'required', 
         'nit'         => 'required', 
         'telefono'    => 'required', 
         'correo'      => 'email',  
         'codigo'      => 'required',    
         'boleta'      => 'required',  
         'valor'      => 'required',
      ]);

      if($validation->fails()){  
         return response()->json(['error_message' => $validation->messages()->first(), 'codigo' => 400]);
      }

      #filtra por rol de usuario
      $user = Auth::User(); 
      $usuario = User::find($user->id); 

      $venta = Venta::create([
         'fecha'       => Carbon::parse($request->fecha),
         'nombre'      => $request->nombre,
         'nit'         => $request->nit,
         'telefono'    => $request->telefono,
         'correo'      => $request->correo,
         'codigo'      => $request->codigo,
         'boleta_pago' => $request->boleta,
         'id_usuario'  => $usuario->id,
         'id_agencia'  => $usuario->id_agencia,
         'boleta_pago' => $request->boleta,
         'direccion'   => $request->direccion,
         'cantidad'    => $request->cantidad,
         'precio'      => $request->valor,
      ]);

      if(!$venta){
         return response()->json(['error_message' => "Ocurrio un error, consulte a soporte.", 'codigo' => 400]);
      }
 
      Inventario::create([
         'fecha'       => Carbon::parse($request->fecha),
         'central'     => 0,
         'id_agencia'  => $usuario->id_agencia,
         'descripcion' => 'Venta de M-POS',
         'correlativo' => $request->codigo,
         'cantidad'    => $request->cantidad,
         'tipo'        => 'salida', 
         'id_venta'    => $venta->id, 
      ]);
       
      return response()->json(['codigo' => 200, 'message' => 'Registrado correctamente', $venta]); 
   }

   public function getVentas(Request $request){

      $user = Auth::User(); 
      $usuario = User::find($user->id); 
 
      if(isset($request->fecha_inicio) && isset($request->fecha_fin)) {
         $date_start = Carbon::parse($request->fecha_inicio);
         $date_end = Carbon::parse($request->fecha_fin)->addHours(23);  
      }else{
         $date_start =  Carbon::now()->startOfMonth()->startOfDay();
         $date_end = Carbon::now();
      } 


      if($usuario->id_agencia!=null){

         $ventas = Venta::with('Agencia')
                        ->where('id_agencia', $usuario->id_agencia)
                        ->whereBetween('fecha', [$date_start,  $date_end])
                        ->orderBy('fecha','DESC')->get();
      }else{
        
         $ventas = Venta::with('Agencia')
                         ->whereBetween('fecha', [$date_start,  $date_end])
                         ->orderBy('fecha','DESC')->get();

         if (isset($request->agencia)){
            
            $ventas = Venta::with('Agencia')
                           ->whereBetween('fecha', [$date_start,  $date_end])
                           ->where('id_agencia', $request->agencia)
                           ->orderBy('fecha','DESC')->get();
         }
      }
 
      return response()->json(['codigo' => 200, 'ventas' =>  $ventas]); 
   }
}
