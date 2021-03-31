<?php

namespace App\Models\Pagalo;

use Illuminate\Database\Eloquent\Model;

class BancoEmpresa extends Model{

   protected $connection = 'conectPagalo';

   protected $table = 'banco_empresa';
   protected $hidden = ['created_at','updated_at'];
   protected $guarded = ['id'];

}
