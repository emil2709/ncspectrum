<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * Base Seeder that is called on database seeding.
     * This Seeder calls the other Seeders defined in the run() method.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UsersTableSeeder::class);
        $this->call(AdminsTableSeeder::class);
        //$this->call(StatusesTableSeeder::class);
        //$this->call(VisitsTableSeeder::class);
    }
}
