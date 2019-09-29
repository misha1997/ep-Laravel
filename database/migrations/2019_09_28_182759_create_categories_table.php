<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('category_id');
            $table->integer('cycles_id')->unsigned();
            $table->string('name', 255);
            $table->integer('credits')->nullable();
            $table->timestamps();
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->index('cycles_id');
            $table->foreign('cycles_id')->references('cycles_id')->on('cycles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
