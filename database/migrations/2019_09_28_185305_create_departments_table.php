<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('department_id');
            $table->integer('subdivision_id')->unsigned();
            $table->string('name');
            $table->timestamps();
        });

        Schema::table('departments', function (Blueprint $table) {
            $table->index('subdivision_id');
            $table->foreign('subdivision_id')->references('subdivision_id')->on('subdivisions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('departments');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
