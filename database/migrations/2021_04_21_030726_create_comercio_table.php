<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComercioTable extends Migration{

   public function up(){
      Schema::create('comercio', function (Blueprint $table) {
         $table->increments('id');
         $table->string('nombre');
         $table->string('nit');
         $table->timestamps();
      });

      Schema::create('sucursal', function (Blueprint $table) {
         $table->increments('id');
         $table->string('telefono');
         $table->string('direccion');
         $table->integer('id_comercio')->unsigned()->index();
         $table->foreign('id_comercio')->references('id')->on('comercio')->onDelete('cascade');
         $table->integer('id_municipio')->unsigned()->index();
         $table->foreign('id_municipio')->references('id')->on('departamento_municipios')->onDelete('cascade');
         $table->timestamps();
      });

   }

   public function down(){
      Schema::dropIfExists('comercio');
      Schema::dropIfExists('sucursal');
   }
}
