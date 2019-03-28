<?php

use Illuminate\Database\Seeder;

class GymTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Gym::class, 50)->create();
        $this->command->info('50 Gyms were created!, ***  all gyms have a creator_id => 2 *** ');
    }
}
