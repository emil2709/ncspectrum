<?php

use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Creates 20 random statuses (true/false) for the Status Table.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Status::class, 20)->create();
    }
}
