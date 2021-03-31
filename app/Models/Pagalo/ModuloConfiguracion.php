<?php

namespace App\Models\Pagalo;

use Illuminate\Database\Eloquent\Model;

class ModuloConfiguracion extends Model
{
   protected $connection = 'conectPagalo';

    	protected $table = 'modulo_configuracion';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

     /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
     protected $hidden = ['created_at','updated_at'];


    public function plan(){
      return $this->hasOne('App\Models\ServicioPlan','id','id_plan');
    }

    public function modulo(){
      return $this->hasOne('App\Models\Modulos','id','id_modulo');
    }
}
