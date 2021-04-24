<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class sucursal extends Model{

    protected $table = 'sucursal';
    protected $guarded = ['id'];
    protected $hidden = ['created_at','updated_at'];

    public function ubicacion(){
      return $this->hasOne('App\Models\Config\Departamento_municipio','id','id_municipio')->with('departamento');
   }

}

