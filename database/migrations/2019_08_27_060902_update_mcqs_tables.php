<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateMcqsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mcqs', function (Blueprint $table) {
             $table->longText('e')->nullable();
             $table->longText('f')->nullable();
             $table->longText('g')->nullable();
             $table->longText('h')->nullable();
             $table->longText('i')->nullable();
             $table->string('layout')->nullable();
             $table->integer('section_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
