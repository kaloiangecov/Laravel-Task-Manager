<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->increments('id');
            $table->string('author');
            $table->string('subject');
            $table->string('content');
            $table->string('status')->default('sent');
            $table->integer('scheduled')->nullable();
            $table->integer('people_sent')->nullable();
            $table->timestamps();
        });

        Schema::create('email_user', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('email_id')->unsigned();
            $table->boolean('seen')->default(false);

            $table->foreign('user_id')->references('id')->on('user')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('email_id')->references('id')->on('email')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['user_id', 'email_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emails');
        Schema::dropIfExists('email_user');
    }
}
