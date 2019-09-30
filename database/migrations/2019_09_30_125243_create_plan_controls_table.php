<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_controls', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('control_id');
            $table->integer('id')->unsigned();
            $table->integer('module_number')->nullable();
            $table->integer('hours_week')->default(0);
            $table->integer('exams')->default(0);
            $table->integer('credit')->default(0);
            $table->integer('course_work')->default(0);
            $table->integer('сontrol_work')->default(0);
            $table->integer('semester');
            $table->timestamps();
        });

        Schema::table('plan_controls', function (Blueprint $table) {
            $table->index('id');
            $table->foreign('id')->references('id')->on('education_plans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plan_controls');
    }
}
