<?php

namespace App\Http\Controllers\Providers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\Facades\Validator;
use App\Exports\collectionExport;
use PDF;
use Excel;


class providerController extends Controller{

   private $url_SW = '';

   public function __construct(){
      $this->url_SW = session('enviroment')=='test' ? env('pagalob2b_test') : env('pagalob2b_live');
   }

   public function index(){
      return view('admin.provider.index');
   }

   public function getProviders(Request $request){

      $guzzle = new GuzzleClient([
         'http_errors' => false,
         'headers' => [
            'Content-Type' => 'application/json',
            'Authorization' => session('access_token'),
         ]
      ]);

      $response = $guzzle->post($this->url_SW.'api/admin/provider/getProviders', ['body'=> json_encode($request->all())]);

      if($response->getStatusCode()==200){
         return $response->getBody();
      }else{
         return response()->json(['codigo'=> 400, 'error_message' => 'Ocurrio un error en la conexion']);
      }

   }

   public function getProvider($id_provider){

      $guzzle = new GuzzleClient([
         'http_errors' => false,
         'headers' => [
            'Content-Type' => 'application/json',
            'Authorization' => session('access_token'),
         ]
      ]);

      $response = $guzzle->get($this->url_SW.'api/admin/provider/getProvider/'.$id_provider);

      if($response->getStatusCode()==200){
         return $response->getBody();
      }else{
         return response()->json(['codigo'=> 400, 'error_message' => 'Ocurrio un error en la conexion']);
      }

   }

   public function getComision($mes){

      $guzzle = new GuzzleClient([
         'http_errors' => false,
         'headers' => [
            'Content-Type' => 'application/json',
            'Authorization' => session('access_token'),
         ]
      ]);

      $response = $guzzle->get($this->url_SW.'api/admin/provider/getComision/'.$mes);

      if($response->getStatusCode()==200){
         return $response->getBody();
      }else{
         return response()->json(['codigo'=> 400, 'error_message' => 'Ocurrio un error en la conexion']);
      }

      return $mes;

   }

   public function getTipoComision(Request $request){

      $guzzle = new GuzzleClient([
         'http_errors' => false,
         'headers' => [
            'Content-Type' => 'application/json',
            'Authorization' => session('access_token'),
         ]
      ]);

      $response = $guzzle->post($this->url_SW.'api/admin/provider/getTipoComision',['body'=> json_encode($request->all())]);

      if($response->getStatusCode()==200){
         return $response->getBody();
      }else{
         return response()->json(['codigo'=> 400, 'error_message' => 'Ocurrio un error en la conexion']);
      }

   }

   //Cambia el tipo de calculo de comision
   public function setTipoComision(Request $request){

      $guzzle = new GuzzleClient([
         'http_errors' => false,
         'headers' => [
            'Content-Type' => 'application/json',
            'Authorization' => session('access_token'),
         ]
      ]);

      $response = $guzzle->post($this->url_SW.'api/admin/provider/setTipoComision', ['body'=> json_encode($request->all())]);

      if($response->getStatusCode()==200){
         return $response->getBody();
      }else{
         return response()->json(['codigo'=> 400, 'error_message' => 'Ocurrio un error en la conexion']);
      }

   }

   public function detailComision(Request $request){

      $guzzle = new GuzzleClient([
         'http_errors' => false,
         'headers' => [
            'Content-Type' => 'application/json',
            'Authorization' => session('access_token'),
         ]
      ]);

      $response = $guzzle->post($this->url_SW.'api/admin/provider/detailComision', ['body'=> json_encode($request->all())]);

      if($response->getStatusCode()==200){
         return $response->getBody();
      }else{
         return response()->json(['codigo'=> 400, 'error_message' => 'Ocurrio un error en la conexion']);
      }

   }

   public function deshabilitar($id){

      $guzzle = new GuzzleClient([
         'http_errors' => false,
         'headers' => [
            'Content-Type' => 'application/json',
            'Authorization' => session('access_token'),
         ]
      ]);

      $response = $guzzle->get($this->url_SW.'api/admin/provider/deshabilitar/'.$id);

      if($response->getStatusCode()==200){
         return $response->getBody();
      }else{
         return response()->json(['codigo'=> 400, 'error_message' => 'Ocurrio un error en la conexion']);
      }

   }

   public function habilitar($id){

      $guzzle = new GuzzleClient([
         'http_errors' => false,
         'headers' => [
            'Content-Type' => 'application/json',
            'Authorization' => session('access_token'),
         ]
      ]);

      $response = $guzzle->get($this->url_SW.'api/admin/provider/habilitar/'.$id);

      if($response->getStatusCode()==200){
         return $response->getBody();
      }else{
         return response()->json(['codigo'=> 400, 'error_message' => 'Ocurrio un error en la conexion']);
      }

   }

   public function getProducts($id){

      $guzzle = new GuzzleClient([
         'http_errors' => false,
         'headers' => [
            'Content-Type' => 'application/json',
            'Authorization' => session('access_token'),
         ]
      ]);

      $response = $guzzle->get($this->url_SW.'api/admin/provider/getProducts/'.$id);

      if($response->getStatusCode()==200){
         return $response->getBody();
      }else{
         return response()->json(['codigo'=> 400, 'error_message' => 'Ocurrio un error en la conexion']);
      }

   }

   public function getPromotions(Request $request, $id){

      $guzzle = new GuzzleClient([
         'http_errors' => false,
         'headers' => [
            'Content-Type' => 'application/json',
            'Authorization' => session('access_token'),
         ]
      ]);

      $response = $guzzle->post($this->url_SW.'api/admin/provider/getPromotions/'.$id, ['body'=> json_encode($request->all())]);

      if($response->getStatusCode()==200){
         return $response->getBody();
      }else{
         return response()->json(['codigo'=> 400, 'error_message' => 'Ocurrio un error en la conexion']);
      }

   }

   public function setCommissionProduct(Request $request){

      $guzzle = new GuzzleClient([
         'http_errors' => false,
         'headers' => [
            'Content-Type' => 'application/json',
            'Authorization' => session('access_token'),
         ]
      ]);

      $response = $guzzle->post($this->url_SW.'api/admin/provider/setCommissionProduct', ['body'=> json_encode($request->all())]);

      if($response->getStatusCode()==200){
         return $response->getBody();
      }else{
         return response()->json(['codigo'=> 400, 'error_message' => 'Ocurrio un error en la conexion']);
      }

   }

   public function generatePDF_detail(Request $request){

      $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
      $month = $meses[$request['datos']['mes']-1];

      $pdf = PDF::loadView('pdf.detalleComision', ['data' => $request->all(), 'month' => $month]);

      return $pdf->download('detalleComision.pdf');
   }


   public function interfaceDetail(){
      $data =  [

         'total_pedidos' => 5,
         'total_ventas' => 17995,
         'comision' => 350,
         'detalle' =>
           [
           'D146' =>
            [
             'sku' => 'D146',
             'nombre' => 'A- Televisor',
             'cantidad' => 5,
             'precio' => 17500,
             'total' => 17500,
             'comision' => 350,
            ],
         ],
         'provider' =>
         [
           'nombre_proveedor' => 'Distribuidora GANGAS TRES',
           'id' => 6,
           'nit' => '12345678',
           'fecha_creacion' => '2020-04-29 11:17:15',
           'telefono' => '42105838',
           'estado_produccion' => 'test',
           'moneda' => 'GTQ',
           'estado' => 1,
           'estado_registro' => '10',
           'facturacion' => 734397,
           'pedidos' => 144,
           'tipoComision' =>
             [
             'id' => 4,
             'codigo' => 'TIPO_4',
             'nombre' => 'Cálculo por porentaje de productos vendidos',
             'descripcion' => 'Se establece un porcentaje de comision a cada producto y se calcula en base al porcentaje de porductos vendidos',
             'created_at' => '2021-01-05 14:27:05',
            ],
         ],
         'datos' =>
           [
           'mes' => 1,
           'year' => 2021,
           'id_provider' => 6,
         ],
      ];

      // return view('pdf.detalleComision',  [ 'data' => $data]);
   }


   public function exportExcelProducts(Request $request){

      $values = collect($request->all())->transform(function ($item, $key){
         return [
            'sku'      => " {$item['sku']}",
            'nombre'   => $item['nombre'],
            'comision' => $item['comision'] == 0 ? '0' : $item['comision'],
         ];
      });

      $array_data = [
         ['sku','nombre','comision'],
         $values
      ];

      $export = new collectionExport($array_data);

      return Excel::download($export, 'reports.xls');
   }

   public function updateComision(Request $request, $id_provider){

      $validation = Validator::make($request->all(), [
         'sku.*'      => 'required',
         'nombre.*'   => 'required',
         'comision.*' => 'required|digits_between:0,100',
      ]);

      if($validation->fails()){
         return response()->json(['message_error' => $validation->messages()->first(), 'codigo' => 400]);
      }

      $guzzle = new GuzzleClient([
         'http_errors' => false,
         'headers' => [
            'Content-Type' => 'application/json',
            'Authorization' => session('access_token'),
         ]
      ]);

      $response = $guzzle->post($this->url_SW.'api/admin/provider/updateComissionProduct/'. $id_provider, ['body'=> json_encode($request->all())]);

      if($response->getStatusCode()==200){
         return $response->getBody();
      }else{
         return response()->json(['codigo'=> 400, 'message_error' => 'Ocurrio un error en la conexion']);
      }

   }

}
