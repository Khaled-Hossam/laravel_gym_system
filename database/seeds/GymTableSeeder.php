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
        $this->command->info('Gyms Created!');
    }
}
