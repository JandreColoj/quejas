<?php

namespace App\Models\Pagalo;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model{

   protected $connection = 'conectPagalo';

   protected $table   = 'users';
   protected $hidden  = ['created_at','updated_at'];
   protected $guarded = ['id'];
}
