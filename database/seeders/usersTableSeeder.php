<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class usersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersNbr =(int)$this->command->ask('How much users do you want to generate ?',10);
       \App\Models\User::factory($usersNbr)->create();
    }
}
