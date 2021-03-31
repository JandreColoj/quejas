<?php

namespace App\Models\Pagalo;

use Illuminate\Database\Eloquent\Model;

class ConfiguracionDocumentos extends Model{

   protected $connection = 'conectPagalo';
   
   protected $table = 'config_documentacion';
   protected $hidden = ['created_at','updated_at'];
   protected $guarded = ['id'];
}
