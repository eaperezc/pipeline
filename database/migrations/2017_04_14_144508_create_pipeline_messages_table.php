<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePipelineMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_steps', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('message_id')->unsigned();
            $table->foreign('message_id')->references('id')->on('messages');

            $table->integer('pipeline_id')->unsigned();
            $table->foreign('pipeline_id')->references('id')->on('pipelines');

            $table->integer('node_id')->unsigned();
            $table->foreign('node_id')->references('id')->on('nodes');

            $table->string('status')->default('QUEUED');
            $table->text('result')->nullable();

            $table->integer('previous_step_id')->unsigned()->nullable();
            $table->foreign('previous_step_id')->references('id')->on('message_steps');

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
        Schema::dropIfExists('message_steps');
    }
}
