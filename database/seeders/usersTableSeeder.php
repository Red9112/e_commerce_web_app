<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class usersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin=[
            'name' => "admin",
            'email' => "admin@admin.com",
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
        ];

        \App\Models\User::create($admin);
        $usersNbr =(int)$this->command->ask('How much users do you want to generate ?',10);
       \App\Models\User::factory($usersNbr)->create();
    }
}
