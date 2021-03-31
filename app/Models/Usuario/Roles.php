<?php

namespace App\Models\Usuario;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model{
   protected $table = 'roles';
   protected $guarded = ['id'];
   protected $hidden = ['created_at','updated_at','deleted_at','description','level','estado'];
}
