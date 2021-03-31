<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model{
   protected $table = 'venta_pos';
   protected $guarded = ['id'];
   protected $hidden = ['created_at','updated_at'];

   public function Agencia(){
      return $this->hasOne('App\Models\Config\Agencias','id','id_agencia');
   }
}
