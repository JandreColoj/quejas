<?php

namespace App\Models\Pagalo;

use Illuminate\Database\Eloquent\Model;

class PlanEmpresa extends Model
{
   protected $connection = 'conectPagalo';
     protected $table = 'plan_empresa';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id_empresa','idenEmpresa','id_plan','porcentaje','monto_max','user_admin','tarifaUSD','tarifaGTQ','pago_aldia','cupon_aldia','estado'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['updated_at','created_at'];

   public function Planes(){
      return $this->hasOne('App\Models\Pagalo\ServicioPlan','id','id_plan');
   }

   public function Plan_Configuracion(){
      return $this->hasOne('App\Models\Pagalo\PlanConfiguracion','id_plan','id_plan');
   }
}
