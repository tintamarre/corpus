<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('color', 7)->nullable();

            $table->mediumText('description')->nullable();

            $table->integer('tag_id')->nullable()->unsigned();
            $table->integer('collection_id')->unsigned();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('collection_id')->references('id')->on('collections');
            $table->foreign('tag_id')->references('id')->on('tags');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tags');
    }
}
