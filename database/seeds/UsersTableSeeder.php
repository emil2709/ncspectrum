<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Creates 20 Users (Guests & Employees) and a related visit to each of the users.
     *
     * @return void
     */
    public function run()
    {
    	factory(App\User::class, 20)->create()->each(function ($u) {
    		$u->visits()->save(factory(App\Visit::class)->make());
    	});
    }
}
