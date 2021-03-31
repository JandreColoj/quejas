<?php

namespace App\Models\Pagalo;

use Illuminate\Database\Eloquent\Model;

class ApikeyEmpresa extends Model
{



   protected $connection = 'conectPagalo';

   protected $table = 'apikey_empresa';
   protected $guarded = ['id'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_empresa', 'idenEmpresa', 'token','key_public','key_secret','tipo','estado','no_transaccion'
    ];



    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
 protected $hidden = ['created_at','updated_at'];

}
