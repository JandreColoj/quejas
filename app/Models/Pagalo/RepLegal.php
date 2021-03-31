<?php

namespace App\Models\Pagalo;

use Illuminate\Database\Eloquent\Model;

class RepLegal extends Model{

   protected $connection = 'conectPagalo';

   protected $table = 'rep_legal';
   protected $hidden = ['created_at','updated_at'];
   protected $guarded = ['id'];

}
