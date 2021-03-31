<?php

namespace App\Models\Pagalo;

use Illuminate\Database\Eloquent\Model;

class ModuloEmpresa extends Model{

   protected $connection = 'conectPagalo';

   protected $table = 'modulo_empresa';
   protected $hidden = ['created_at','updated_at'];
   protected $guarded = ['id'];

}
