<?php

use Illuminate\Database\Seeder;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->ask('*** 7atetdrab fi weshak *** 7asseb *** Make sure you have a country with id of 1 in your database and hit enter***');
        factory(App\City::class, 10)->create();
        $this->command->info('10 cities were created!');
    }
}
