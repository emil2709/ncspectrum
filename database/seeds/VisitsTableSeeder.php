<?php

use Illuminate\Database\Seeder;

class VisitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Visit::class, 10)->create()->each(function ($u) {
        	$u->users()->save(factory(App\User::class)->make());
        });
    }
}
