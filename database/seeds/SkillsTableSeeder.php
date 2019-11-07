<?php

use Illuminate\Database\Seeder;

class SkillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $skills = [
            ['description'=>'Gerência de projetos'],
            ['description'=>'Controle financeiro'],
            ['description'=>'Controle de estoque'],
            ['description'=>'Desenvolvimento front end'],
            ['description'=>'Banco de dados'],
            ['description'=>'Desenvolvimento de Back End'],
            ['description'=>'DevOps']
        ];

        foreach($skills as $skill){
            //Skill::create($skill); no exist model

            DB::table('skills')->insert($skill);
        }
    }
}
