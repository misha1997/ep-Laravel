<?php

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
            'name' => "Кафедра фізіології і патофізіології з курсом медичної біології",
            'subdivision_id' => 1
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра мовної підготовки іноземних громадян",
            'subdivision_id' => 3
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра журналістики та філології",
            'subdivision_id' => 3
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра інфекційних хвороб з епідеміологією",
            'subdivision_id' => 1
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра загальної хірургії, радіаційної медицини та фтизіатрії",
            'subdivision_id' => 1
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра біофізики, біохімії, фармакології та біомолекулярної інженерії",
            'subdivision_id' => 1
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра внутрішньої медицини післядипломної освіти",
            'subdivision_id' => 6
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра патологічної анатомії",
            'subdivision_id' => 1
        ]);
    }
}
