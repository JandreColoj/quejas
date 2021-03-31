<?php

namespace App\Models\Config;

use Illuminate\Database\Eloquent\Model;

class Agencias extends Model{

    protected $table = 'agencias';
    protected $guarded = ['id'];
    protected $hidden = ['created_at','updated_at'];
 
    public function Zona(){
        return $this->hasOne('App\Models\Config\Zonas','codigo','zona');
    }

}
