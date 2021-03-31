<?php
namespace App\Models\Pagalo;

use Illuminate\Database\Eloquent\Model;

class CheckEmpresa extends Model{

   protected $connection = 'conectPagalo';

   protected $table = 'check_empresa';
   protected $hidden = ['created_at','updated_at'];
   protected $guarded = ['id'];

}
