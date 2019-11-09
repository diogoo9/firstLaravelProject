<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = [
            'email'=>'admin',
            'password'=>'nimda'
        ];

        DB::table('admins')->insert($admin);
    }
}
