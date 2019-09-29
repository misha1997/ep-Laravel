<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('sub_category_id');
            $table->integer('category_id')->unsigned();
            $table->string('name', 255);
            $table->integer('credits')->nullable()->default(0);
            $table->timestamps();
        });

        Schema::table('sub_categories', function (Blueprint $table) {
            $table->index('category_id');
            $table->foreign('category_id')->references('category_id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_categories');
    }
}
