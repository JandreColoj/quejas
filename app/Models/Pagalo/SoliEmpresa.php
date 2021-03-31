<?php

namespace App\Models\Pagalo;

use Illuminate\Database\Eloquent\Model;

class SoliEmpresa extends Model{

   protected $connection = 'conectPagalo';

   protected $table = 'soli_empresa';
   protected $hidden = ['created_at','updated_at'];
   protected $guarded = ['id'];

}
