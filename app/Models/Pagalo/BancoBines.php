<?php

namespace App\Models\Pagalo;

use Illuminate\Database\Eloquent\Model;

class BancoBines extends Model{
     //
    protected $table = 'bancos_bines';
    protected $guarded = ['id'];
    protected $hidden = ['created_at','updated_at'];
}
