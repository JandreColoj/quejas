<?php

namespace App\Http\Controllers\Pedidos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleClient;
use App\Exports\pedidosExport;
use Excel;

class PedidosController extends Controller{

   private $url_SW = '';

   public function __construct(){
      $this->url_SW = session('enviroment')=='test' ? env('pagalob2b_test') : env('pagalob2b_live');
   }

   public function index(){
      return view('admin.pedidos.pedidos');
   }

   public function getPedidos(Request $request){

      $guzzle = new GuzzleClient([
         'http_errors' => false,
         'headers' => [
            'Content-Type' => 'application/json',
            'Authorization' => session('access_token'),
         ]
      ]);

      $response = $guzzle->post($this->url_SW.'api/admin/pedidos/getPedidos', ['body'=> json_encode($request->all())]);

      if($response->getStatusCode()==200){
         return $response->getBody();
      }else{
         return response()->json(['codigo'=> 400, 'error_message' => 'Ocurrio un error en la conexion']);
      }

   }

   public function getPedido($id_pedido){

      $guzzle = new GuzzleClient([
         'http_errors' => false,
         'headers' => [
            'Content-Type' => 'application/json',
            'Authorization' => session('access_token'),
         ]
      ]);

      $response = $guzzle->get($this->url_SW.'api/admin/pedidos/getPedido/'.$id_pedido);

      if($response->getStatusCode()==200){
         return $response->getBody();
      }else{
         return response()->json(['codigo'=> 400, 'error_message' => 'Ocurrio un error en la conexion']);
      }

   }

   public function exportExcel(Request $request){

      $guzzle = new GuzzleClient([
         'http_errors' => false,
         'headers' => [
            'Content-Type' => 'application/json',
            'Authorization' => session('access_token'),
         ]
      ]);

      $response = $guzzle->post($this->url_SW.'api/admin/pedidos/getPedidos', ['body'=> json_encode($request->all())]);

      if($response->getStatusCode()==200){

         $datos = json_decode($response->getBody(), true);
         $pedidos = $datos['pedidos'];

         $collection_pedidos = collect($pedidos);

         $array_pedidos = [
            [
               'fecha',
               'codigo',
               'proveedor',
               'pedido',
               'cliente',
               'negocio',
               'direccion',
               'total',
               'entrega_estimada',
               'fecha_entrega',
               'metodo_pago',
               'pago_pendiente',
               'estado',
            ]
         ];

         foreach ($collection_pedidos as $pedido) {

            $item_pedido = [
               $pedido['created_at'],
               $pedido['empresa']['identidad_empresa'],
               $pedido['empresa']['nombre'],
               $pedido['no_orden'],
               $pedido['cliente']['nombre'],
               $pedido['cliente']['empresa'],
               $pedido['direccion']['ubicacion'],
               $pedido['total'],
               $pedido['fecha_entrega'],
               $pedido['fecha_recibido'],
               $pedido['metodo_pago']['metodo']['nombre'],
               $pedido['total']+$pedido['metodo_pago']['total'],
               $pedido['estado']['nombre'],
            ];

            array_push($array_pedidos, $item_pedido);
         }

         $export = new pedidosExport($array_pedidos);

        return Excel::download($export, 'pedidos.xls');

      }else{
         return response()->json(['codigo'=> 400, 'result' => 'Ocurrio un error en la conexion']);
      }

   }

}
