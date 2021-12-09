<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Missions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('missions', function(Blueprint $table){
            $table->increments('id');
            $table->integer('capsule_id')->unsigned();
            $table->string('name')->nullable();
            $table->integer('flight')->nullable();
            $table->timestamps();

            $table->foreign('capsule_id')->references('id')->on('capsules')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
