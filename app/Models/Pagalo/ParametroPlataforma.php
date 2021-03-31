<?php

namespace App\Models\Pagalo;

use Illuminate\Database\Eloquent\Model;

class ParametroPlataforma extends Model{

   protected $connection = 'conectPagalo';

   protected $table    = 'parametro_plataforma';
   protected $fillable = ['nombre'];
   protected $hidden   = ['created_at','updated_at'];
}
