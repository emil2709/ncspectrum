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
        DB::table('admins')->insert([
            'firstname' => 'Erik',
            'lastname' => 'Li',
            'email' => 'erik@gmail.com',
            'password' => bcrypt('pagh3377'),
        ]);
        DB::table('admins')->insert([
            'firstname' => 'Emil',
            'lastname' => 'Nedregård',
            'email' => 'emil@gmail.com',
            'password' => bcrypt('pagh3377'),
        ]);
    }
}
