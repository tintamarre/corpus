<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSegmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('segments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('position');
            $table->integer('text_id')->unsigned();
            // $table->integer('seq_id')->unsigned()->nullable(); // Should be deleted
            $table->mediumText('content');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('text_id')->references('id')->on('texts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('segments');
    }
}
