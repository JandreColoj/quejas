<?php

namespace App\Models\Pagalo;

use Illuminate\Database\Eloquent\Model;

class PersonalizarEmpresa extends Model
{
   protected $connection = 'conectPagalo';

   protected $table   = 'personalizar_empresa';
   protected $guarded = ['id'];
   protected $hidden  = ['updated_at'];
}
