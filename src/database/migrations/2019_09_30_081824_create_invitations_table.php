<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInvitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitations', function (Blueprint $table) {
            $table->string('id')->primary();
            // $table->unsignedBigInteger('team_id')->index();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->string('role')->nullable();

            $table->string('email');
            $table->string('token', 40)->unique();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('invitations');
    }
}
