<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('location');
            $table->string('active');
            $table->string('serie');
            $table->string('description')->nullable();
            $table->string('order');
            $table->string('status')->default('Pendiente');
            $table->string('assigned')->nullable();
            $table->date('date_calendar')->nullable();
            $table->date('date_execute')->nullable();
            $table->string('observation')->nullable();
            $table->string('evaluatión')->nullable();

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
        Schema::dropIfExists('work_orders');
    }
}
