<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttemptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attempts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('test_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('mcq_id')->nullable();
            $table->integer('fillup_id')->nullable();
            $table->integer('qno');
            $table->string('response')->nullable();
            $table->string('answer')->nullable();
            $table->integer('accuracy')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attempts');
    }
}
