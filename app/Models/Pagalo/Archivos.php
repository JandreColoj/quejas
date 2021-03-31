<?php

namespace App\Models\Pagalo;

use Illuminate\Database\Eloquent\Model;

class Archivos extends Model{

   protected $connection = 'conectPagalo';

   protected $table    = 'archivos';
   protected $fillable = ['de', 'nombre', 'url','extension' ];
   protected $hidden   = ['created_at','updated_at'];

}
