<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEducationPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education_plans', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('department_id')->unsigned();
            $table->string('name', 255);
            $table->string('status', 50)->default('created');
            $table->integer('year');
            $table->string('qualification', 20)->nullable();
            $table->string('discipline', 50)->nullable();
            $table->string('specialty', 50)->nullable();
            $table->string('specialization', 50)->nullable();
            $table->string('educational_program', 50)->nullable();
            $table->string('educational_level', 50)->nullable();
            $table->string('form_study', 50)->nullable();
            $table->string('training_period', 50)->nullable();
            $table->timestamps();
        });

        Schema::table('education_plans', function (Blueprint $table) {
            $table->index('department_id');
            $table->index('user_id');
            $table->foreign('department_id')->references('department_id')->on('departments');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('education_plans');
    }
}
