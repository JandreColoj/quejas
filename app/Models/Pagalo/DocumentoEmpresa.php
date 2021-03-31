<?php

namespace App\Models\Pagalo;

use Illuminate\Database\Eloquent\Model;

class DocumentoEmpresa extends Model{

   protected $connection = 'conectPagalo';

   protected $table   = 'documento_empresa';
   protected $guarded = ['id'];
   protected $hidden  = ['updated_at'];

}
