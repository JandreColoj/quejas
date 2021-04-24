<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuejasTable extends Migration{

   public function up(){
      Schema::create('quejas', function (Blueprint $table) {
         $table->increments('id');
         $table->string('codigo');
         $table->dateTime('fecha');
         $table->integer('id_consumidor');
         $table->integer('id_comercio')->unsigned()->index();
         $table->foreign('id_comercio')->references('id')->on('comercio')->onDelete('cascade');
         $table->integer('id_sucursal')->unsigned()->index();
         $table->foreign('id_sucursal')->references('id')->on('sucursal')->onDelete('cascade');
         $table->text('motivo');
         $table->integer('estado');
         $table->timestamps();
      });
   }

   public function down(){
      Schema::dropIfExists('quejas');
   }
}
