<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEducationItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education_items', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('education_item_id');
            $table->integer('sub_category_id')->unsigned()->nullable();
            $table->integer('category_id')->unsigned()->nullable();
            $table->integer('cycles_id')->unsigned()->nullable();
            $table->integer('education_plans_id')->unsigned();
            $table->integer('subject_id')->unsigned();
            $table->integer('credits');
            $table->integer('lectures')->nullable()->default(0);
            $table->integer('laboratories')->nullable()->default(0);
            $table->integer('choice')->nullable()->default(0);
            $table->integer('fixed')->nullable()->default(1);
            $table->timestamps();
        });

        Schema::table('education_items', function (Blueprint $table) {
            $table->index('sub_category_id');
            $table->index('category_id');
            $table->index('cycles_id');
            $table->index('education_plans_id');
            $table->index('subject_id');
            $table->foreign('sub_category_id')->references('sub_category_id')->on('sub_categories')->onDelete('cascade');
            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('cascade');
            $table->foreign('cycles_id')->references('cycles_id')->on('cycles')->onDelete('cascade');
            $table->foreign('education_plans_id')->references('id')->on('education_plans')->onDelete('cascade');
            $table->foreign('subject_id')->references('subject_id')->on('subjects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('education_items');
    }
}
