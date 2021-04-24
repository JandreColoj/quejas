<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartamentosTable extends Migration{

   public function up(){
      Schema::create('departamento_municipios', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('codigo');
          $table->string('nombre');
          $table->string('region');
          $table->integer('codigo_depto');
          $table->integer('estado')->default(1);
          $table->timestamps();
      });
  }


   public function down(){
      Schema::dropIfExists('departamento_municipios');
   }
}
