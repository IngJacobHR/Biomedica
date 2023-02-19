<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSensorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('senses', function (Blueprint $table) {
            $table->id();
            $table->char('name');
            $table->float('val');
            $table->float('max')->nullable();
            $table->float('min')->nullable();
            $table->string('type')->nullable();
            $table->char('campus')->nullable();
            $table->char('location')->nullable();
            $table->string('description')->nullable();
            $table->string('email1')->nullable();
            $table->string('email2')->nullable();
            $table->timestamps();
        });

        Schema::create('sensors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('senses_id'); // Relación con categorias
            $table->foreign('senses_id')->references('id')->on('senses');
            $table->float('val');
            $table->integer('event');
            $table->longText('comment')->nullable();
            $table->timestamp('date')->nullable();
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
        Schema::dropIfExists('senses');
        Schema::dropIfExists('sensors');
    }
}
