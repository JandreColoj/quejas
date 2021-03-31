<?php

namespace App\Models\Pagalo;

use Illuminate\Database\Eloquent\Model;

class CodigoEmpresa extends Model
{
   protected $connection = 'conectPagalo';

   protected $table    = 'codigo_empresa';
   protected $guarded = ['id' ];
   protected $hidden   = ['created_at','updated_at'];
}
