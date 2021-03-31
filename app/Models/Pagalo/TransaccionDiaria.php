<?php

namespace App\Models\Pagalo;

use Illuminate\Database\Eloquent\Model;

class TransaccionDiaria extends Model{

   protected $connection = 'conectPagalo';
   protected $table = 'transaccion_diaria';
   protected $guarded = ['id'];    
   protected $hidden = ['created_at','updated_at'];


   public function Empresa(){
      return $this->hasOne('App\Models\Empresas','id','id_empresa');
   } 

   public function Liquidacion(){
      return $this->hasOne('App\Models\LiquidacionTransaccion','id','id_liquidacion')
                  ->select(['id','fecha_liquidacion','fecha_inicio','fecha_fin','deposito_empresa']);
   }

}
