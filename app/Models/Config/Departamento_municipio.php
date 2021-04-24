<?php

namespace App\Models\Config;

use Illuminate\Database\Eloquent\Model;

class Departamento_municipio extends Model{
   protected $table   = 'departamento_municipios';
   protected $guarded = ['id'];
   protected $hidden  = ['updated_at'];


   public function departamento(){
      return $this->hasOne('App\Models\Config\Departamento_municipio','id','codigo_depto');
   }
}
