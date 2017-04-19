<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Creates the pre-made Administrators for the system.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'firstname' => 'System',
            'lastname' => 'Administrator',
            'email' => 'sysadmin@gmail.com',
            'password' => bcrypt('sysadmin'),
        ]);

        DB::table('admins')->insert([
            'firstname' => 'Salieri',
            'lastname' => 'Antonio',
            'email' => 'salieri@gmail.com',
            'password' => bcrypt('pagh3377'),
        ]);
        
        DB::table('admins')->insert([
            'firstname' => 'Amadeus',
            'lastname' => 'Mozart',
            'email' => 'amadeus@gmail.com',
            'password' => bcrypt('pagh3377'),
        ]);
    }
}
