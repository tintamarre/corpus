<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCollectionUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collection_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('collection_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();

            $table->string('role', 20)->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('collection_id')->references('id')->on('collections');
            $table->foreign('user_id')->references('id')->on('users');

            $table->index(['user_id','collection_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('collection_user');
    }
}
