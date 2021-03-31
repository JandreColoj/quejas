<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class UsuarioEmpresa extends Model{
   protected $table = 'user_empresa';
   protected $guarded = ['id'];
   protected $hidden = ['created_at','updated_at'];

   
}
