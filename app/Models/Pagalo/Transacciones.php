<?php

namespace App\Models\Pagalo;

use Illuminate\Database\Eloquent\Model;

class Transacciones extends Model{

   protected $connection = 'conectPagalo';
   protected $table = 'transacciones';

   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = ['id_empresa','id_user','id_cliente','firstName','lastName','street1','city','state','postalCode','email','country','ipAddress','accountNumber','expirationMonth','expirationYear','currency','decision','reasonCode','requestID','requestToken','AuthReplycode','Total','fecha_transaccion','estado','tipo_transaccion','idenEmpresa','nameCard','estado_cdia','estado_produccion','llave','tipo_llave','correlativo','reversa','reversa_aut','firma','epayserver','comentario','afiliacion', 'tarifa_envio','id_pago_recurrente','metodo_pago','id_codigo_banco'];

   /**
    * The attributes excluded from the model's JSON form.
    *
    * @var array
    */
   protected $hidden = ['created_at','updated_at'];

 
   public function Empresa(){
      return $this->hasOne('App\Models\Empresas','id','id_empresa')->with("Relevante");
   }

   public function bin(){
      return $this->hasOne('App\Models\BancoBines','id','id_bin_banco');
   }

   
   public function Productos(){
      return $this->hasMany('App\Models\Pagalo\ProductoTransaccion','id_transaccion','id');
   }

}
