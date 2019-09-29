<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => "1.1 Обов'язкові навчальні дисципліни",
            'cycles_id' => 1,
            'credits' => 50
        ]);
        DB::table('categories')->insert([
            'name' => "1.2 Вибіркові навчальні дисципліни",
            'cycles_id' => 1,
            'credits' => 10
        ]);
        DB::table('categories')->insert([
            'name' => "2.1 Обов'язкові навчальні дисципліни",
            'cycles_id' => 2
        ]);
        DB::table('categories')->insert([
            'name' => "2.2 Вибіркові навчальні дисципліни",
            'cycles_id' => 2
        ]);
    }
}
