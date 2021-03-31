<?php

namespace App\Models\Pagalo;

use Illuminate\Database\Eloquent\Model;

class CodigoPromocion extends Model
{
   protected $connection = 'conectPagalo';

   protected $table    = 'codigo_promocion';
   protected $guarded = ['id' ];
   protected $hidden   = ['created_at','updated_at'];


   public function Distribuidor(){
      return $this->hasOne('App\Models\Pagalo\Distribuidores','id','id_distribuidor');
   }
}
