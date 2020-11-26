<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLabelTextTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('label_text', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('text_id')->unsigned();
            $table->integer('label_id')->unsigned();

            $table->string('attribute')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('text_id')->references('id')->on('texts');
            $table->foreign('label_id')->references('id')->on('labels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('label_text');
    }
}
