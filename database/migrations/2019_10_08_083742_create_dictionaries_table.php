<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDictionariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      if(!Schema::hasTable('dictionaries')){
        Schema::create('dictionaries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tipus')->unsigned();
            $table->string('nev');
            $table->longText('leiras')->nullable();
            $table->integer('user_id')->unsigned();

            $table->foreign('tipus')->references('id')->on('types');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
      }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dictionaries');
    }
}
