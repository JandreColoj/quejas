<?php

namespace App\Models\Pagalo;

use Illuminate\Database\Eloquent\Model;

class RelevanteEmpresa extends Model{

   protected $connection = 'conectPagalo';

   protected $table = 'relevante_empresa';
   protected $hidden = ['created_at','updated_at'];
   protected $guarded = ['id'];

}
