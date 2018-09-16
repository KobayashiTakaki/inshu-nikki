<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInshusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inshus', function (Blueprint $table) {
          $table->integer('id')->unsigned()->autoIncrement();
          $table->integer('user_id')->unsigned();
          $table->string('date');
          $table->string('kind');
          $table->string('how');
          $table->integer('amount');
          $table->integer('count');
          $table->timestamps();
          //外部キー設定
          $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inshus');
    }
}
