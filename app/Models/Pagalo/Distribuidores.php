<?php

namespace App\Models\Pagalo;

use Illuminate\Database\Eloquent\Model;

class Distribuidores extends Model{
   protected $connection = 'conectPagalo';

   protected $table   = 'distribuidores';
   protected $guarded = ['id'];
   protected $hidden  = ['created_at','updated_at'];
}
