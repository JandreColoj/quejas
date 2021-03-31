<?php

namespace App\Http\Controllers\Reportes;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\Exports\collectionExport;
use GuzzleHttp\Client as GuzzleClient;
use Excel;

class ReportesController extends Controller{

   private $url_SW = '';

   public function __construct(){
      $this->url_SW = session('enviroment')=='test' ? env('pagalob2b_test') : env('pagalob2b_live');
   }

   public function index(){
      return view('admin.reportes.index');
   }

   public function generateReportGeneral(Request $request){

      $guzzle = new GuzzleClient([
         'http_errors' => true,
         'headers' => [
            'Content-Type' => 'application/json',
            'Authorization' => session('access_token'),
         ]
      ]);

      $response = $guzzle->post($this->url_SW.'api/admin/reports/generateReportGeneral', ['body'=> json_encode($request->all())]);

      if($response->getStatusCode()==200){
         return $response->getBody();
      }else{
         return response()->json(['codigo'=> 400, 'error_message' => 'Ocurrio un error en la conexion']);
      }

   }

   public function exportExcel(Request $request){

      $guzzle = new GuzzleClient([
         'http_errors' => true,
         'headers' => [
            'Content-Type' => 'application/json',
            'Authorization' => session('access_token'),
         ]
      ]);

      $response = $guzzle->post($this->url_SW.'api/admin/reports/generateDataGeneral', ['body'=> json_encode($request->all())]);

      if($response->getStatusCode()==200){

         $datos = json_decode($response->getBody(), true);

         if ($datos['codigo']==400){
            return response()->json(['codigo'=> 400, 'message_error' =>  $datos['message_error']],400);
         }

         $export = new collectionExport($datos['array_data']);

         return Excel::download($export, 'reports.xls');

      }else{
         return response()->json(['codigo'=> 400, 'error_message' => 'Ocurrio un error en la conexion']);
      }

   }

   public function getProviders(Request $request){

      $guzzle = new GuzzleClient([
         'http_errors' => false,
         'headers' => [
            'Content-Type' => 'application/json',
            'Authorization' => session('access_token'),
         ]
      ]);

      $response = $guzzle->get($this->url_SW.'api/admin/reports/getProviders');

      if($response->getStatusCode()==200){
         return $response->getBody();
      }else{
         return response()->json(['codigo'=> 400, 'error_message' => 'Ocurrio un error en la conexion']);
      }

   }

   public function getResumen(Request $request){

      $guzzle = new GuzzleClient([
         'http_errors' => false,
         'headers' => [
            'Content-Type' => 'application/json',
            'Authorization' => session('access_token'),
         ]
      ]);

      $response = $guzzle->get($this->url_SW.'api/admin/reports/getResumen');

      if($response->getStatusCode()==200){
         return $response->getBody();
      }else{
         return response()->json(['codigo'=> 400, 'error_message' => 'Ocurrio un error en la conexion']);
      }

   }

}
