<?php

use Illuminate\Database\Seeder;

class PlanItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('education_items')->insert([
            'category_id' => 1,
            'cycles_id' => 1,
            'education_plans_id' => 1,
            'subject_id' => 1,
            'credits' => 5,
            'lectures' => 0,
            'laboratories' => 0,
            'choice' => 0,
            'fixed' => 1
        ]);
        DB::table('education_items')->insert([
            'category_id' => 1,
            'cycles_id' => 1,
            'education_plans_id' => 1,
            'subject_id' => 2,
            'credits' => 5,
            'lectures' => 10,
            'laboratories' => 5,
            'choice' => 0,
            'fixed' => 1
        ]);
        DB::table('education_items')->insert([
            'category_id' => 1,
            'cycles_id' => 1,
            'education_plans_id' => 1,
            'subject_id' => 2,
            'credits' => 5,
            'lectures' => 10,
            'laboratories' => 5,
            'choice' => 0,
            'fixed' => 1
        ]);
    }
}
