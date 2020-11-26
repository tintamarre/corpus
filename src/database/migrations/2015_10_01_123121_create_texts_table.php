<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTextsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('texts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');

            $table->text('abstract')->nullable();

            $table->integer('collection_id')->unsigned();
            $table->bigInteger('uploader_id')->unsigned()->nullable();

            $table->timestamp('cached_at')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('uploader_id')->references('id')->on('users');

            $table->foreign('collection_id')->references('id')->on('collections');

            $table->index(['collection_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('texts');
    }
}
