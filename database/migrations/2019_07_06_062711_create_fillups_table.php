<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFillupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fillups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('test_id')->unsigned();
            $table->integer('extract_id')->unsigned();
            $table->longText('label')->nullable();
            $table->longText('prefix')->nullable();
            $table->longText('answer')->nullable();
            $table->longText('suffix')->nullable();
            $table->integer('qno')->nullable();
            $table->integer('sno')->nullable();
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
        Schema::dropIfExists('fillups');
    }
}
