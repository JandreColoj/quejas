<?php

namespace App\Models\Pagalo;

use Illuminate\Database\Eloquent\Model;

class Modulos extends Model{
   protected $connection = 'conectPagalo';

   protected $guarded = ['id'];
	protected $table   = 'modulos';
   protected $hidden  = ['created_at','updated_at'];

}
