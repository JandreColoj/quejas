<?php

namespace App\Models\Pagalo;

use Illuminate\Database\Eloquent\Model;

class RoleUsuarios extends Model{

   protected $connection = 'conectPagalo';

   protected $table = 'role_user';
   protected $hidden = ['created_at','updated_at'];
   protected $fillable = ['role_id','user_id'];

}
