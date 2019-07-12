<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extracts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('test_id')->unsigned();
            $table->integer('section_id')->unsigned();
            $table->string('name')->nullable();
            $table->string('file')->nullable();
            $table->longText('text')->nullable();
            $table->integer('glance_time')->default(0);
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
        Schema::dropIfExists('extracts');
    }
}
