<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_managements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('message_id')->unsigned()->index();
            $table->foreign('message_id')->references('id')->on('messages')->onDelete('cascade');
            $table->integer('from_user_id')->unsigned()->index();
            $table->foreign('from_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('to_user_id')->unsigned()->index();
            $table->foreign('to_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('read_status')->default(0);
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
        Schema::dropIfExists('message_managements');
    }
}
