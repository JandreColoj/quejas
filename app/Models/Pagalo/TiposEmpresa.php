<?php

namespace App\Models\Pagalo;

use Illuminate\Database\Eloquent\Model;

class TiposEmpresa extends Model{

   protected $connection = 'conectPagalo';

   protected $table = 'tipos_empresa';
   protected $hidden = ['created_at','updated_at'];
   protected $fillable = ['nombre','estado'];
}
