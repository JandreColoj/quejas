<?php

namespace App\Models\Pagalo;

use Illuminate\Database\Eloquent\Model;

class TransaccionCalculo extends Model
{
          
    protected $connection = 'conectPagalo';
    protected $table = 'transaccion_calculo';
    protected $guarded = ['id'];
    protected $hidden = ['created_at','updated_at'];

    public function TransaccionDiaria(){
        return $this->hasOne('App\Models\TransaccionDiaria','id','id_transaccion_dia')
                    ->select(['id','fecha_corte','id_liquidacion'])
                    ->with("Liquidacion");
    }
}
