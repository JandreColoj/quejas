<?php

namespace App\Models\Pagalo;

use Illuminate\Database\Eloquent\Model;

class ParametroCategoria extends Model{

   protected $connection = 'conectPagalo';

   protected $table    = 'parametro_categoria';
   protected $fillable = ['nombre','perfil'];
   protected $hidden   = ['created_at','updated_at'];
}
