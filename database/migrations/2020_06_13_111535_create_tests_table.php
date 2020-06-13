<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->string('disease_id');
            $table->unsignedBigInteger('patient_id');
            $table->string('hospital_id');
            $table->string('laboratory_id');

            $table->foreign('disease_id')->references('id')->on('diseases');
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->foreign('hospital_id')->references('id')->on('hospitals');
            $table->foreign('laboratory_id')->references('id')->on('laboratories');

            $table->timestamps();

            $table->boolean('positif')->nullable();
            //$table->primary(['disease_id', 'patient_id','hospital_id','laboratory_id'],'idd');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tests');
    }
}
