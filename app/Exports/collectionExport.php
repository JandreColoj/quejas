<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Illuminate\Support\Collection;

class collectionExport implements FromArray{

   protected $providers;

   public function __construct(array $providers){
      $this->providers = $providers;
   }


  public function array(): array{
      return $this->providers;
   }

}
