<?php

use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('education_plans')->insert([
            'user_id' => 1,
            'department_id' => 1,
            'name' => 'Навчальний план',
            'year' => 2019,
            'qualification' => 'Кваліфікація',
            'discipline' => 'Галузь знань',
            'specialty' => 'Спеціальність',
            'specialization' => 'Спеціалізація',
            'educational_program' => 'Освітня програма',
            'educational_level' => 'Освітній (освітньо-науковий) рівень',
            'form_study' => 'Форма навчання',
            'training_period' => 'Рік прийому'
        ]);
    }
}
