<?php

use Illuminate\Database\Seeder;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subjects')->insert([
            'name' => "Іноземна мова"
        ]);
        DB::table('subjects')->insert([
            'name' => "Українознавство з комунікативним курсом української мови"
        ]);
        DB::table('subjects')->insert([
            'name' => "Філософія"
        ]);
        DB::table('subjects')->insert([
            'name' => "Фізичне виховання"
        ]);
        DB::table('subjects')->insert([
            'name' => "Вибіркові дисципліни гуманітарного спрямування (додаток 1)"
        ]);
        DB::table('subjects')->insert([
            'name' => "Вибіркові дисципліни інших спеціальностей (додаток 2)"
        ]);
        DB::table('subjects')->insert([
            'name' => "Практика"
        ]);
        DB::table('subjects')->insert([
            'name' => "Кваліфікаційна робота бакалавра"
        ]);
        DB::table('subjects')->insert([
            'name' => "Атестаційний кваліфікаційний іспит"
        ]);
        DB::table('subjects')->insert([
            'name' => "Вибіркові дисципліни за спеціальністю"
        ]);
    }
}
