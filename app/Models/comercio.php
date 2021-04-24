<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class comercio extends Model{

    protected $table = 'comercio';
    protected $guarded = ['id'];
    protected $hidden = ['created_at','updated_at'];



}
