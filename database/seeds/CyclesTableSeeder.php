<?php

use Illuminate\Database\Seeder;

class CyclesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cycles')->insert([
            'name' => '1 ЦИКЛ ДИСЦИПЛІН ЗАГАЛЬНОЇ ПІДГОТОВКИ',
            'credits' => 65,
        ]);
        DB::table('cycles')->insert([
            'name' => '2 ЦИКЛ ДИСЦИПЛІН ПРОФЕСІЙНОЇ ПІДГОТОВКИ',
            'credits' => 160,
        ]);
        DB::table('cycles')->insert([
            'name' => '3 Цикл практичної підготовки',
            'credits' => 10,
        ]);
        DB::table('cycles')->insert([
            'name' => '4 Атестація',
            'credits' => 5,
        ]);
    }
}
