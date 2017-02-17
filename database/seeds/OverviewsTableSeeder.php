<?php

use Illuminate\Database\Seeder;

class OverviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Overview::class, 20)->create();
    }
}
