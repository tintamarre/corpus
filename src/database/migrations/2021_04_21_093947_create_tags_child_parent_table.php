<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsChildParentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags_child_parent', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('parent_id')->unsigned();
            $table->integer('child_id')->unsigned();

            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('tags');
            $table->foreign('child_id')->references('id')->on('tags');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags_child_parent');
    }
}
