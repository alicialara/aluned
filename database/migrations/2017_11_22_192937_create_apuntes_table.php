<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApuntesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apuntes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_usuario');
            $table->integer('id_tarea')->default(null);
            $table->integer('id_poll_user')->default(null);
            $table->integer('id_tema')->default(null);
            $table->string('titulo');
            $table->text('texto');
            $table->tinyInteger('publicar')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('apuntes', function (Blueprint $table) {
            //
        });
    }
}
