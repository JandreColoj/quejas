<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class quejas extends Model{

   protected $table = 'quejas';
   protected $guarded = ['id'];
   protected $hidden = ['created_at','updated_at'];

   public function comercio(){
      return $this->hasOne('App\Models\comercio','id','id_comercio');
   }

   public function sucursal(){
      return $this->hasOne('App\Models\sucursal','id','id_sucursal')->with('ubicacion');
   }

   public function consumidor(){
      return $this->hasOne('App\Models\consumidor','id','id_consumidor');
   }

}

