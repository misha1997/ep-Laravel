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
        DB::table('departments')->insert([
            'name' => "Кафедра конституційного права, теорії та історії держави і права",
            'subdivision_id' => 13
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра стоматології",
            'subdivision_id' => 1
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра електронних приладів і автоматики КІ СумДУ",
            'subdivision_id' => 11
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра економіки і управління КІ СумДУ",
            'subdivision_id' => 11
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра електроніки та комп`ютерної техніки",
            'subdivision_id' => 14
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра електроніки, загальної та прикладної фізики",
            'subdivision_id' => 14
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра маркетингу та управління інноваційною діяльністю",
            'subdivision_id' => 5
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра сімейної медицини з курсом дерматовенерології",
            'subdivision_id' => 6
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра педіатрії",
            'subdivision_id' => 6
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра громадського здоров'я",
            'subdivision_id' => 1
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра прикладного матеріалознавства і технології конструкційних матеріалів",
            'subdivision_id' => 15
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра економіки та управління ШІ СумДУ",
            'subdivision_id' => 8
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра фундаментальних та загальнонаукових дисциплін КІ СумДУ",
            'subdivision_id' => 11
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра системотехніки та інформаційних технологій ШІ СумДУ",
            'subdivision_id' => 8
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра хімічної технології високомолекулярних сполук ШІ СумДУ",
            'subdivision_id' => 8
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра акушерства та гінекології",
            'subdivision_id' => 1
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра нейрохірургії та неврології з курсами психіатрії, наркології, медичної психології, професійних хвороб, секцією ортопедії та травматології",
            'subdivision_id' => 1
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра хірургії та онкології",
            'subdivision_id' => 1
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра теоретичної і прикладної економіки",
            'subdivision_id' => 10
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра морфології",
            'subdivision_id' => 1
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра іноземних мов ННІ БТ",
            'subdivision_id' => 10
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра бухгалтерського обліку та оподаткування",
            'subdivision_id' => 10
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра економічної кібернетики",
            'subdivision_id' => 10
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра міжнародних економічних відносин",
            'subdivision_id' => 10
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра фінансів, банківської справи та страхування",
            'subdivision_id' => 10
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра міжнародного, європейського права та цивільно-правових дисциплін",
            'subdivision_id' => 13
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра кримінально-правових дисциплін та судочинства",
            'subdivision_id' => 13
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра маркетингу",
            'subdivision_id' => 5
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра адміністративного, господарського права та фінансово-економічної безпеки",
            'subdivision_id' => 13
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра філософії",
            'subdivision_id' => 3
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра психології, політології та соціокультурних технологій",
            'subdivision_id' => 3
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра германської філології",
            'subdivision_id' => 3
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра іноземних мов",
            'subdivision_id' => 3
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра фінансів і підприємництва",
            'subdivision_id' => 5
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра управління",
            'subdivision_id' => 5
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра економіки, підприємництва та бізнес-адміністрування",
            'subdivision_id' => 5
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра математичного аналізу і методів оптимізації",
            'subdivision_id' => 14
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра електроенергетики",
            'subdivision_id' => 14
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра наноелектроніки",
            'subdivision_id' => 14
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра прикладної математики та моделювання складних систем",
            'subdivision_id' => 14
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра комп`ютерних наук",
            'subdivision_id' => 14
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра загальної механіки та динаміки машин",
            'subdivision_id' => 15
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра теоретичної та прикладної хімії",
            'subdivision_id' => 15
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра технології машинобудування, верстатів та інструментів",
            'subdivision_id' => 15
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра процесів та обладнання хімічних і нафтопереробних виробництв",
            'subdivision_id' => 15
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра прикладної гідроаеромеханіки",
            'subdivision_id' => 15
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра прикладної екології",
            'subdivision_id' => 15
        ]);
        DB::table('departments')->insert([
            'name' => "Кафедра технічної теплофізики",
            'subdivision_id' => 15
        ]);
    }
}
