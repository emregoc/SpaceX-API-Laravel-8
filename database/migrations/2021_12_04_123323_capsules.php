<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Capsules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('capsules', function(Blueprint $table){
            $table->increments('id');
            $table->string('capsule_serial');
            $table->string('capsule_id');
            $table->string('status');
            $table->string('original_launch')->nullable();
            $table->integer('original_launch_unix')->nullable();
            $table->integer('landings')->nullable();
            $table->string('type');
            $table->string('details')->nullable();
            $table->integer('reuse_count')->nullable();
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
        //
    }
}
