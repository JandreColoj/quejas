<?php

namespace App\Models\Pagalo;

use Illuminate\Database\Eloquent\Model;

class PlanConfiguracion extends Model{

   protected $connection = 'conectPagalo';

   protected $table = 'plan_configuracion';
   protected $guarded = ['id'];
   protected $hidden = ['created_at','updated_at'];

   public function plan(){
      return $this->hasOne('App\Models\Pagalo\ServicioPlan','id','id_plan');
    }


}
