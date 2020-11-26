<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSegmentTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('segment_tag', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('tag_id')->unsigned();
            $table->integer('segment_id')->unsigned();
            $table->integer('text_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();

            $table->integer('snippet_start');
            $table->integer('snippet_end');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('text_id')->references('id')->on('texts');
            $table->foreign('tag_id')->references('id')->on('tags');
            $table->foreign('segment_id')->references('id')->on('segments');
            $table->foreign('user_id')->references('id')->on('users');

            $table->index(['segment_id','tag_id', 'text_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('segment_tag');
    }
}
