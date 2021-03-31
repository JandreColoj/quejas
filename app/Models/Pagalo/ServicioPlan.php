<?php

namespace App\Models\Pagalo;

use Illuminate\Database\Eloquent\Model;

class ServicioPlan extends Model{

   protected $connection = 'conectPagalo';

   protected $table = 'servicio_plan';
   protected $hidden = ['created_at','updated_at'];
   protected $fillable = ['nombre','monto_max','porcentaje','estado','fee_monto','porcentaje_cybs','codigo','tarifaUSD'];


}
