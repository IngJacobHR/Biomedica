<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::table('work_orders', function(Blueprint $table){
            $table->unsignedBigInteger('campus_id')->nullable()->after('id');

            $table->foreign('campus_id')->references('id')->on('campuses')
            ->onUpdate('cascade')
            ->onDelete('set null');
        });

        Schema::table('technologies', function(Blueprint $table){
            $table->unsignedBigInteger('campus_id')->nullable()->after('model');

            $table->foreign('campus_id')->references('id')->on('campuses')
            ->onUpdate('cascade')
            ->onDelete('set null');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('technologies', function(Blueprint $table){
            $table->dropForeign('technologies_campus_foreign');
            $table->dropColumn('campus');
        });

        Schema::dropIfExists('campuses');
    }
}
