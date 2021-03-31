<?php

namespace App\Models\Usuario;

use Illuminate\Database\Eloquent\Model;

class RoleUsuario extends Model{
   protected $table = 'role_user';
   protected $guarded = ['id'];
   protected $hidden = ['created_at','updated_at','deleted_at','id'];

   public function Rol(){
      return $this->hasOne('App\Models\Usuario\Roles','id','role_id');
   }
}
