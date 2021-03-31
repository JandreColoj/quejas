<?php

namespace App\Models\Config;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model{

    protected $table = 'inventario';
    protected $guarded = ['id'];
    protected $hidden = ['created_at','updated_at'];
 

    public function Agencia(){
        return $this->hasOne('App\Models\Config\Agencias','id','id_agencia');
    }
}
