<?php

namespace App\Models\Pagalo;

use Illuminate\Database\Eloquent\Model;

class ProfileUsuarios extends Model{

   protected $connection = 'conectPagalo';

   protected $table = 'user_profile';
   protected $hidden = ['created_at','updated_at'];
   protected $guarded = ['id'];

}
