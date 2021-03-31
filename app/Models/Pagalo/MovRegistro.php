<?php

namespace App\Models\Pagalo;

use Illuminate\Database\Eloquent\Model;

class MovRegistro extends Model{

   protected $connection = 'conectPagalo';

   protected $table    = 'mov_registro';
   protected $guarded  = ['id'];
   protected $hidden   = ['created_at','updated_at'];
}
