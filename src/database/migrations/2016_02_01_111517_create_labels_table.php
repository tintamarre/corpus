<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabelsTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('labels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');

            $table->string('format')->nullable();

            // $table->json('type')->nullable();

            $table->integer('collection_id')->unsigned();

            $table->string('description')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('collection_id')->references('id')->on('collections');
        });
    }

    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        Schema::drop('labels');
    }
}
