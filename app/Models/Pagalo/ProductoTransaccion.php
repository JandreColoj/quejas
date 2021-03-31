<?php

namespace App\Models\Pagalo;

use Illuminate\Database\Eloquent\Model;

class ProductoTransaccion extends Model
{   
    protected $connection = 'conectPagalo';
   	protected $table = 'producto_transaccion';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_empresa', 'id_user', 'id_transaccion','nombre','cantidad','precio','subtotal','estado','idenEmpresa','id_producto','id_variacion','id_solicitud','id_producto_sucursal'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at','updated_at'
    ];
}
