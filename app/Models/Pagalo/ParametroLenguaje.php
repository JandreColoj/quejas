<?php

namespace App\Models\Pagalo;

use Illuminate\Database\Eloquent\Model;

class ParametroLenguaje extends Model{

   protected $connection = 'conectPagalo';

   protected $table    = 'parametro_lenguaje';
   protected $fillable = ['nombre'];
   protected $hidden   = ['created_at','updated_at'];
}
