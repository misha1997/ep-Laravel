<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CyclesTableSeeder::class,
            CategoriesTableSeeder::class,
            SubCategoriesTableSeeder::class,
            SubdivisionsTableSeeder::class,
            DepartmentsTableSeeder::class,
            SubjectsTableSeeder::class
        ]);
    }
}
