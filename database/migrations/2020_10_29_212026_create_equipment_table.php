<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('class');
            $table->string('category');
            $table->string('powersupply');
            $table->text('description');
            $table->text('desinfectant');

            $table->timestamps();
        });

        Schema::table('technologies', function(Blueprint $table){
            $table->unsignedBigInteger('equipment_id')->nullable()->after('serie');

            $table->foreign('equipment_id')->references('id')->on('equipment')
            ->onUpdate('cascade')
            ->onDelete('set null');
        });

        Schema::table('work_orders', function(Blueprint $table){
            $table->unsignedBigInteger('equipment_id')->nullable()->after('location');

            $table->foreign('equipment_id')->references('id')->on('equipment')
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
            $table->dropForeign('technologies_equipment_id_foreign');
            $table->dropColumn('equipment_id');
        });

        Schema::dropIfExists('equipment');
    }
}
