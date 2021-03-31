<?php

namespace App\Models\Pagalo;

use Illuminate\Database\Eloquent\Model;

class LiquidacionTransaccion extends Model{

   protected $connection = 'conectPagalo';

   protected $table = 'liquidacion_transaccion';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   protected $guarded = ['id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['created_at','updated_at'];


   public function Empresa(){
      return $this->hasOne('App\Models\Empresas','id','id_empresa')->with("Plan","Banco","MiUsuario");
   }

   public function TransaccionDiaria(){
      return $this->hasMany('App\Models\TransaccionDiaria','id','id_empresa');
   }

   public function Factura(){
      return $this->hasOne('App\Models\LiquidacionFactura','id','id_factura');
   }


}
