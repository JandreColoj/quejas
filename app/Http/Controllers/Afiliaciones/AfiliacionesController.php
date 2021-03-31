<?php

namespace App\Http\Controllers\Afiliaciones;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pagalo\DocumentoEmpresa;
use App\Models\Pagalo\Empresas;
use App\Models\Pagalo\RelevanteEmpresa;
use App\Models\Pagalo\BancoEmpresa;
use App\Models\Pagalo\TiposEmpresa;
use App\Models\Pagalo\ParametroCategoria;
use App\Models\Pagalo\ConfiguracionDocumentos;
use App\Models\Pagalo\CheckEmpresa;
use App\Models\Pagalo\MovRegistro;
use App\Models\Usuario\UserRegister;
use App\Helpers\Help;
use Carbon\Carbon;
use App\User;
use Storage;
use Auth;

class AfiliacionesController extends Controller{

   public function index(){
      return view('admin.afiliaciones.registros');
   }


   public function getCategorias(){
      $categoria = ParametroCategoria::all();
      return response()->json(['datos' => $categoria]);
   }

   public function listadotipos(){
      $tipos = TiposEmpresa::where('estado',1)->get();
      return response()->json(['datos' => $tipos]);
   }



   public function updateRegister(Request $request){

      $user = Auth::User();

      $nombre_empresa     = $request['nombre_empresa'];
      $nombre_fiscal      = $request['nombre_fiscal'] == null ? '' : $request['nombre_fiscal'];;
      $nit                = $request['nit'];
      $tipo_empresa       = $request['tipo_empresa'];
      $categoria_empresa  = $request['categoria_empresa'];
      $plataforma_empresa = $request['plataforma_empresa'];
      $direccion          = $request['direccion'] == null ? '' : $request['direccion'];
      $direccion_fiscal   = $request['direccion_fiscal'] == null ? '' : $request['direccion_fiscal'];
      $email_emisor       = $request['email_emisor'] == null ? '' : $request['email_emisor'];

      $empresa = Empresas::where('id',$request->id)->first();

      $empresa->fill([
         'nombre'          => $nombre_empresa,
         'nit'             => $nit,
         'id_categoria'    => $categoria_empresa,
         'ubicacion'       => $direccion,
         'id_plataforma'   => $plataforma_empresa,
         'id_tipo'         => $tipo_empresa,
         'direccionValida' => $direccion_fiscal,
         'nombreValido'    => $nombre_fiscal,
         'email_emisor'    => $email_emisor,
      ]);
      $empresa->save();

      DocumentoEmpresa::where('id_empresa',$request->id)->update(['direccion_fiscal' => $direccion_fiscal]);

      MovRegistro::create([
         'id_usuario'  => $user->id,
         'id_registro' => $empresa->id,
         'descripcion' => 'Actualizo datos de la empresa',
         'codigo'      => 'BAM',
      ]);

      return response()->json(['datos' => $empresa]);
   }

   public function saveImage(Request $request){

      $user = Auth::User();
      $empresa = Empresas::with('Documentos','TipoEmpresa')->find($request->id_empresa);

      $file = $request->base64;

      switch ($file) {
         case str_contains($file, 'data:image/png'):
            $file = str_replace('data:image/png;base64,','',$file);
            $extension = "png";
         break;
         case str_contains($file, 'data:image/jpg'):
            $file = str_replace('data:image/jpg;base64,','',$file);
            $extension = "jpg";
         break;
         case str_contains($file, 'data:image/jpeg'):
            $file = str_replace('data:image/jpeg;base64,','',$file);
            $extension = "jpeg";
         break;
         case str_contains($file, 'data:application/pdf'):
            $file = str_replace('data:application/pdf;base64,','',$file);
            $extension = "pdf";
         break;
         default:
            return response()->json(['mensaje' => 'Extension no permitida','codigo' =>400]);
         break;
      }

      $imgdata  = base64_decode($file);
      $filename = 'registros/documentos/u'.$user->id.'/e'.$empresa->identidad_empresa.'/'. $request->type.'.'.$extension;
      $r1       = Storage::disk('s3')->put($filename, ($imgdata), 'public');
      $ruta     = Storage::disk('s3')->url($filename);

      if($r1){

         $documento = DocumentoEmpresa::where('id_empresa',$empresa->id)->first();

         if ($request->type=='documento_identificacion') {
            $documento->fill(['documento_identificacion'=> $ruta]);
            $documento->save();
         }else if($request->type=='dpi_atras') {
            $documento->fill(['dpi_atras'=> $ruta]);
            $documento->save();
         }else if($request->type=='rtu') {
            $documento->fill(['rtu'=> $ruta]);
            $documento->save();
         }else if($request->type=='factura_comercio') {
            $documento->fill(['factura_comercio'=> $ruta]);
            $documento->save();
         }else if($request->type=='patente_comercio') {
            $documento->fill(['patente_comercio'=> $ruta]);
            $documento->save();
         }else if($request->type=='firmas_representacion') {
            $documento->fill(['firmas_representacion'=> $ruta]);
            $documento->save();
         }else if($request->type=='patente_sociedad') {
            $documento->fill(['patente_sociedad'=> $ruta]);
            $documento->save();
         }else if($request->type=='acuerdo_gubernativo') {
            $documento->fill(['acuerdo_gubernativo'=> $ruta]);
            $documento->save();
         }else if($request->type=='resolucion_excecion_iva') {
            $documento->fill(['resolucion_excecion_iva'=> $ruta]);
            $documento->save();
         }else if($request->type=='cheque_cuenta') {
            $documento->fill(['cheque_cuenta'=> $ruta]);
            $documento->save();
         };

         $update = Help::actualizacionDocumentacion($empresa);

         return response()->json(['mensaje' => 'Archivo guardado correctamente','documento' => $documento, 'update' => $update, 'codigo' =>200]);

      }else{
         return response()->json(['mensaje' => 'Error al subir el archivo, intenta de nuevo','codigo' =>400]);
      }

   }

   #cambia de estado aceptado o rechazado
   public function checkDocument(Request $request){

      $user      = Auth::User();
      $userId    = $user->id;
      $idempresa = $request->id_empresa;
      $documento = $request->documento;

      $checkempresa = CheckEmpresa::where('id_empresa',$idempresa)->where('documento',$documento)->first();
      $check = $request->estado=='aceptada' ? 1 : 0 ;

      if(!$checkempresa){
         $checkempresa = CheckEmpresa::create([
            'id_empresa' => $idempresa,
            'user_val'   => $userId,
            'documento'  => $documento,
            'estado'     => 1
         ]);
      }

      $checkempresa->check = $check;
      $checkempresa->save();

      $documentos = CheckEmpresa::where('id_empresa',$idempresa)->get();

      #quita la notificacion  y solicitud de revision
      RelevanteEmpresa::where('id_empresa', $idempresa)->update(['recibio_solicitud_revision'=> 0]);
      RelevanteEmpresa::where('id_empresa', $idempresa)->update(['envio_notifiacion_doc'=> 0]);

      return response()->json(['check' => $documentos]);
   }

   public function newbank(Request $request){

      BancoEmpresa::create([
         'id_empresa'  => $request['id_empresa'],
         'banco'       => $request['banco'],
         'pais'        => $request['pais'],
         'cuenta'      => $request['cuenta'],
         'numero'      => $request['numero'],
         'tipo_cuenta' => $request['tipo_cuenta'],
         'moneda'      => $request['moneda'],
         'estado'      => 1,
      ]);

      $bancos = BancoEmpresa::where('id_empresa', $request['id_empresa'])->where('estado',1)->get();

      return response()->json(['banco' => $bancos]);
   }

   public function updateBank(Request $request,$id){

      $busbanco=BancoEmpresa::where('id',$id)->first();

      $busbanco->fill([
         'banco'       => $request['banco'],
         'pais'        => $request['pais'],
         'cuenta'      => $request['cuenta'],
         'numero'      => $request['numero'],
         'tipo_cuenta' => $request['tipo_cuenta'],
         'moneda'      => $request['moneda'],
         'estado'      => 1
      ]);
      $busbanco->save();

      $bancos = BancoEmpresa::where('id_empresa', $request['id_empresa'])->where('estado',1)->get();

      return response()->json(['banco' => $bancos]);
   }

}
