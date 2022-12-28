<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idVessel');
            $table->foreign('idVessel')->references('id')->on('vessels');
            $table->unsignedBigInteger('PortOfLoading');
            $table->unsignedBigInteger('PortOfDischarge');
            $table->dateTime('ETA');
            $table->dateTime('ETD');
            $table->dateTime('CutOff');
            $table->integer('TransitTime');
            $table->foreign('PortOfLoading')->references('id')->on('seaports');
            $table->foreign('PortOfDischarge')->references('id')->on('seaports');
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
        Schema::dropIfExists('schedules');
    }
};
