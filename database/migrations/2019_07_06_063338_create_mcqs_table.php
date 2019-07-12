<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMcqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mcqs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('test_id')->unsigned();
            $table->integer('extract_id')->unsigned();
            $table->longText('question')->nullable();
            $table->longText('a')->nullable();
            $table->longText('b')->nullable();
            $table->longText('c')->nullable();
            $table->longText('d')->nullable();
            $table->string('answer')->nullable();
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
        Schema::dropIfExists('mcqs');
    }
}
