<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocativefailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locativefails', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::table('locatives', function(Blueprint $table){
            $table->unsignedBigInteger('fails_id')->nullable()->after('active');

            $table->foreign('fails_id')->references('id')->on('locativefails')
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
        chema::table('locatives', function(Blueprint $table){
            $table->dropForeign('locatives_fails_id_foreign');
            $table->dropColumn('fails_id');
        });

        Schema::dropIfExists('locativefails');
    }
}