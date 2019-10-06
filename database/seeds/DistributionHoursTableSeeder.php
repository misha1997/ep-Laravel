<?php

use Illuminate\Database\Seeder;

class DistributionHours extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('distribution_of_hours')->insert([
            'education_item_id' => 1,
            'module_number' => 1,
            'value' => 5,
            'form_control' => "credit",
            'individual_tasks' => "сontrolwork",
            'semester' => 1
        ]);
    }
}
