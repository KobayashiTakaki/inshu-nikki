<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInshuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inshu', function (Blueprint $table) {
          $table->integer('id')->unsigned()->autoIncrement();
          $table->integer('user_id')->unsigned();
          $table->string('date');
          $table->string('kind');
          $table->string('how');
          $table->integer('alc_amount');
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
        Schema::dropIfExists('inshu');
    }
}
