<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeseasesHospitalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deseases_hospitals', function (Blueprint $table) {
            //$table->id();
            $table->string('disease_id');
            $table->unsignedBigInteger('patient_id');
            $table->string('hospital_id');

            $table->foreign('disease_id')->references('id')->on('diseases');
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->foreign('hospital_id')->references('id')->on('hospitals');

            $table->timestamps();

            $table->boolean('cured')->default(false);
            $table->primary(['disease_id', 'patient_id','hospital_id'],'id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deseases_hospitals');
    }
}
