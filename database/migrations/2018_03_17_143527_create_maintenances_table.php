<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaintenancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenances', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->string('status');
            $table->integer('repeat_each');
            $table->date('programmed_to');
            $table->integer('maintenance_type_id')->unsigned();
            $table->foreign('maintenance_type_id')->references('id')->on('maintenance_types');
            $table->integer('machine_id')->unsigned();
            $table->foreign('machine_id')->references('id')->on('machines');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
