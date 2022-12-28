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
        Schema::create('vessels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('callSign');
            $table->string('IMO');
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->integer('speed');
            $table->integer('lengthOverall');
            $table->integer('breadthModuled');
            $table->integer('depthModuled');
            $table->integer('airDraft');
            $table->string('portOfRegister');
            $table->string('nationality');
            $table->integer('buildIn');
            $table->integer('deadWeight');
            $table->integer('grossTonnage');
            $table->integer('netTonnage');
            $table->integer('lightShip');
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
        Schema::dropIfExists('vessels');
    }
};
