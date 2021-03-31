<?php

namespace App\Models\Usuario;

use Illuminate\Database\Eloquent\Model;

class UserRegister extends Model{
   protected $table = 'user_register';
   protected $guarded = ['id'];
   protected $hidden = ['created_at','updated_at','deleted_at','id'];
 
}
