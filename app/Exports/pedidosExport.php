<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Illuminate\Support\Collection;

class pedidosExport implements FromArray{

   protected $pedidos;

   public function __construct(array $pedidos){
      $this->pedidos = $pedidos;
   }


   /**
   * @return \Illuminate\Support\Collection
   */
  public function array(): array{
      return $this->pedidos;
   }

}
