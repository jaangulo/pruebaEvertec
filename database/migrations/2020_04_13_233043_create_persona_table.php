<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idvehiculo')->unsigned(); //unsigned porque es una llave foranea
            $table->integer('identifiacion')->unique();
            $table->string('nombre', 100);
            $table->string('apellidos', 100);
            $table->string('casado', 20)->nullable();
            $table->decimal('ingresos', 11, 2);
            $table->string('vehhiculoactual');
            $table->boolean('condicion')->default(1);
            $table->timestamps();
            /// se crea la realacion de la table articulos y categoria
            $table->foreign('idvehiculo')->references('id')->on('vehiculo');
       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persona');
    }
}
