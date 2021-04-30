<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocativegroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locativegroups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::table('locatives', function(Blueprint $table){
            $table->unsignedBigInteger('groups_id')->nullable()->after('location');

            $table->foreign('groups_id')->references('id')->on('locativegroups')
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
        Schema::table('locatives', function(Blueprint $table){
            $table->dropForeign('locatives_groups_id_foreign');
            $table->dropColumn('groups_id');
        });
        Schema::dropIfExists('locativegroups');
    }
}
