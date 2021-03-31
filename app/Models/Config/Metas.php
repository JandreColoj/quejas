<?php

namespace App\Models\Config;

use Illuminate\Database\Eloquent\Model;

class Metas extends Model{

    protected $table = 'metas';
    protected $guarded = ['id'];
    protected $hidden = ['created_at','updated_at'];
 

    public function Agencia(){
        return $this->hasOne('App\Models\Config\Agencias','id','id_agencia');
    }

    public function Usuario(){
        return $this->hasOne('App\User','id','id_consultor');
    }


}
