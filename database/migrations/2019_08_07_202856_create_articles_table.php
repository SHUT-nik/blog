<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('created_user_id')->nullable(true);
            $table->unsignedBigInteger('publicated_user_id')->nullable(true);
            $table->string('title',250);
            $table->text('text');
            $table->text('announce');
            $table->boolean('is_publicated');
            $table->timestamps();
            $table->foreign('created_user_id')->references('id')->on('users');
            $table->foreign('publicated_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
