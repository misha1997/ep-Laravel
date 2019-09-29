<?php

use Illuminate\Database\Seeder;

class SubdivisionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subdivisions')->insert([
            'name' => "Медичний факультет"
        ]);
        DB::table('subdivisions')->insert([
            'name' => "Науково-дослідний інститут економіки розвитку"
        ]);
        DB::table('subdivisions')->insert([
            'name' => "Факультет іноземної філології та соціальних комунікацій"
        ]);
        DB::table('subdivisions')->insert([
            'name' => "Науково-дослідний інститут мінеральних добрив і пігментів СумДУ"
        ]);
        DB::table('subdivisions')->insert([
            'name' => "Навчально-науковий інститут фінансів, економіки та менеджменту імені Олега Балацького"
        ]);
        DB::table('subdivisions')->insert([
            'name' => "Факультет післядипломної медичної освіти"
        ]);
        DB::table('subdivisions')->insert([
            'name' => "Машинобудівний коледж СумДУ"
        ]);
        DB::table('subdivisions')->insert([
            'name' => "Шосткинський інститут СумДУ"
        ]);
        DB::table('subdivisions')->insert([
            'name' => "Медичний інститут"
        ]);
        DB::table('subdivisions')->insert([
            'name' => 'Навчально-науковий інститут бізнес-технологій "УАБС"'
        ]);
        DB::table('subdivisions')->insert([
            'name' => "Конотопський інститут СумДУ"
        ]);
        DB::table('subdivisions')->insert([
            'name' => "Хіміко-технологічний коледж ім. І. Кожедуба ШІ СумДУ"
        ]);
        DB::table('subdivisions')->insert([
            'name' => "Навчально-науковий інститут права"
        ]);
        DB::table('subdivisions')->insert([
            'name' => "Факультет електроніки та інформаційних технологій"
        ]);
        DB::table('subdivisions')->insert([
            'name' => "Факультет технічних систем та енергоефективних технологій"
        ]);
    }
}
