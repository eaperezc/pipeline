<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');

            $table->string('status')->default('QUEUED');

            $table->integer('node_id')->unsigned();
            $table->foreign('node_id')->references('id')->on('nodes');

            $table->integer('pipeline_id')->unsigned();
            $table->foreign('pipeline_id')->references('id')->on('pipelines');

            $table->integer('lifespan')->unsigned();
            
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
        Schema::dropIfExists('messages');
    }
}
