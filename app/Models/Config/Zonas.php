<?php

namespace App\Models\Config;

use Illuminate\Database\Eloquent\Model;

class Zonas extends Model{

    protected $table = 'zonas';
    protected $guarded = ['id'];
    protected $hidden = ['created_at','updated_at'];
 
}
