<?php

use Illuminate\Database\Seeder;

class SubCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sub_categories')->insert([
            'name' => "2.1.1 Обов’язкові навчальні дисципліни за спеціальністю",
            'category_id' => 3,
            'credits' => 55
        ]);
        DB::table('sub_categories')->insert([
            'name' => "2.1.2 Обов'язкові навчальні дисципліни за освітньою програмою",
            'category_id' => 3,
            'credits' => 60
        ]);
        DB::table('sub_categories')->insert([
            'name' => "2.2.1 Вибіркові навчальні дисципліни за спецальністю",
            'category_id' => 4,
            'credits' => 10
        ]);
        DB::table('sub_categories')->insert([
            'name' => "2.2.2 Вибіркові навчальні дисципліни за освітньою програмою",
            'category_id' => 4,
            'credits' => 35
        ]);
    }
}
