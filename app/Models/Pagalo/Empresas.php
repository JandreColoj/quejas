<?php

namespace App\Models\Pagalo;

use Illuminate\Database\Eloquent\Model;

class Empresas extends Model{

   protected $connection = 'conectPagalo';

   protected $table   = 'empresas';
   protected $guarded = ['id'];
   protected $hidden  = ['updated_at'];

   public function PerfilUsuario(){
      return $this->hasOne('App\Models\Pagalo\ProfileUsuarios','user_id','id_user');
   }

   public function Categoria(){
      return $this->hasOne('App\Models\Pagalo\ParametroCategoria','id','id_categoria');
   }

   public function TipoEmpresa(){
      return $this->hasOne('App\Models\Pagalo\TiposEmpresa','id','id_tipo');
   }

   public function Relevante(){
      return $this->hasOne('App\Models\Pagalo\RelevanteEmpresa','id_empresa','id');
   }

   public function Documentos(){
      return $this->hasOne('App\Models\Pagalo\DocumentoEmpresa','id_empresa','id');
   }

   public function Banco(){
      return $this->hasMany('App\Models\Pagalo\BancoEmpresa','id_empresa','id')->where('estado',1);
   }

   public function Representante(){
      return $this->hasOne('App\Models\Pagalo\RepLegal','id_empresa','id');
   }

   public function Plataforma(){
      return $this->hasOne('App\Models\Pagalo\ParametroPlataforma','id','id_plataforma');
   }

   public function Lenguaje(){
      return $this->hasOne('App\Models\Pagalo\ParametroLenguaje','id','id_lenguaje');
   }

   public function MiUsuario(){
      return $this->hasOne('App\User','id','id_user');
   }

   public function Check(){
      return $this->hasOne('App\Models\Pagalo\CheckEmpresa','id_empresa','id');
   }

   public function Solicitar(){
      return $this->hasOne('App\Models\Pagalo\SoliEmpresa','id_empresa','id');
   }

   public function Apikey(){
      return $this->hasMany('App\Models\Pagalo\ApiKeyEmpresa','id_empresa','id')->where("tipo",2);
   }

   public function Plan(){
      return $this->hasOne('App\Models\Pagalo\PlanEmpresa','id_empresa','id')->with('Planes');
   }

 
}
