<?php
namespace App\Helpers;
use Storage;
use App\Models\Pagalo\ConfiguracionDocumentos;
use App\Models\Pagalo\DocumentoEmpresa;


class Help {

   #recibe el valor de la variable y el valor que devuelve si no existe
   public static function existeVariable($var, $return) {
      $result = isset($var) ? $var : $return;
      return $result;
   }

   public static function actualizacionDocumentacion($em) {
      
      $documentos = (json_decode($em->Documentos));
      $tipo_empresa = isset($em->TipoEmpresa->codigo) ? $em->TipoEmpresa->codigo : 'PC';
      $documentos_configuracion = ConfiguracionDocumentos::where('codigo_tipo_empresa',$tipo_empresa)->get();
      $tipo_empresa = isset($em->TipoEmpresa->codigo) ? $em->TipoEmpresa->codigo : 'error';

      #No tiene tipo de empresa
      if($tipo_empresa=='error'){

         DocumentoEmpresa::where('id_empresa', $em->id)->update([
            'doc_requeridos' => 5,
            'doc_pendientes' => 5,
            'doc_subidos'    => 0,
         ]); 

         return 'Sin tipo de empresa '.$em->id;
      }

      $documentos_configuracion = ConfiguracionDocumentos::where('codigo_tipo_empresa',$tipo_empresa)->get();

      #No tiene configuracion de documentos
      if(count($documentos_configuracion)==0){

         DocumentoEmpresa::where('id_empresa', $em->id)->update([
            'doc_requeridos' => 5,
            'doc_pendientes' => 5,
            'doc_subidos'    => 0,
         ]);

         return 'Tipo de empresa desactualizada '.$em->id;
      }
     
      #Sin registro de documentacion
      if(!isset($documentos)){

         DocumentoEmpresa::where('id_empresa', $em->id)->update([
            'doc_requeridos' => 5,
            'doc_pendientes' => 5,
            'doc_subidos'    => 0,
         ]);

         return 'Sin documentacion '.$em->id;
      }

      $total_documentos = 0;
      foreach ($documentos_configuracion as $requerido){
 
         foreach ($documentos as $key => $doc){
            if($requerido->documento == $key){
               if ($doc!='')
                  $total_documentos++;
            }
         }
      }

      DocumentoEmpresa::where('id_empresa', $em->id)->update([
         'doc_requeridos' => count($documentos_configuracion),
         'doc_pendientes' => (count($documentos_configuracion)-$total_documentos),
         'doc_subidos'    => $total_documentos,
      ]); 

      return 'Actualizado '.$em->id;
   }


   public static function subirImagen($request, $tipo){

      try{

         $file = $request->imagen;

         switch ($file){
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

            default:
               return response("Extension no permitida",403);
            break;
         }

         if($tipo=='categorias'){
            $carpeta = 'compralo/';
         }else if($tipo=='marcas'){
            $carpeta = 'compralo/';
         }else if($tipo=='productos'){
            $carpeta = 'compralo/';
         }else if($tipo=='promociones'){
            $carpeta = 'compralo/';
         }else if($tipo=='documentos'){
            $carpeta = 'compralo/documentos';
         }

         $imgdata  = base64_decode($file);
         $filename = $carpeta.$request->nombre.'.'.$extension;
         $r1       = Storage::disk('s3')->put($filename, ($imgdata), 'public');
         $ruta     = Storage::disk('s3')->url($filename);

         return ['ruta' => $ruta, 'estado' => true];

      }catch(\Exception $e){
         return ['estado' => false, 'erros' => $e->getMessage()];
      }

   }


}
