<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocativesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locatives', function (Blueprint $table) {
            $table->id();
            $table->string('location');
            $table->string('active');
            $table->string('description')->nullable();
            $table->string('order');
            $table->string('status')->default('Pendiente');
            $table->string('assigned')->nullable();
            $table->date('date_calendar')->nullable();
            $table->date('date_novelty')->nullable();
            $table->date('date_execute')->nullable();
            $table->string('observation')->nullable();
            $table->string('report')->nullable();
            $table->string('evaluatión')->nullable();
            $table->string('commentary')->nullable();
            $table->integer('username')->nullable();
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
        Schema::dropIfExists('locatives');
    }
}
