<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('frequency')->nullable();
            $table->date('mant_calendar')->nullable();
            $table->date('next_mant_calendar')->nullable();
            $table->date('mant_execute')->nullable();

            $table->unsignedBigInteger('campus_id');
            $table->foreign('campus_id')->references('id')->on('campuses');


            $table->unsignedBigInteger('items_id');
            $table->foreign('items_id')->references('id')->on('items_1');

            $table->string('state')->nullable();
            $table->string('novelty')->nullable();
            $table->string('evaluation')->nullable();
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
        Schema::table('support', function (Blueprint $table) {
            $table->dropForeign('support_campus_id_foreign');
            $table->dropColumn('campus');
        });

        Schema::table('support', function (Blueprint $table) {
            $table->dropForeign('support_items_id_foreign');
            $table->dropColumn('items');
        });

        Schema::dropIfExists('support');
    }
}
