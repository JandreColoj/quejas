<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsumidorTable extends Migration{

   public function up(){
   Schema::create('consumidor', function (Blueprint $table) {
      $table->increments('id');
      $table->string('nombre')->nullable();
      $table->string('telefono')->nullable();
      $table->string('correo')->nullable();
      $table->timestamps();
   });
   }

   public function down(){
      Schema::dropIfExists('consumidor');
   }
}
