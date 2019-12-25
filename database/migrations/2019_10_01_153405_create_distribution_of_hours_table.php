<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistributionOfHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distribution_of_hours', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('distribution_of_hours_id');
            $table->integer('education_item_id')->unsigned();
            $table->integer('module_number');
            $table->integer('value');
            $table->string('form_control');
            $table->string('individual_tasks');
            $table->integer('semester');
            $table->timestamps();
        });

        Schema::table('distribution_of_hours', function (Blueprint $table) {
            $table->index('education_item_id');
            $table->foreign('education_item_id')->references('education_item_id')->on('education_items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('distribution_of_hours');
    }
}
