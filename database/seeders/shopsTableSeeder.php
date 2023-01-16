<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class shopsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users=User::all();
        if ($users->count()==0) {
            $this->command->error("please create some users !");
            return;
        }
        $shopNbr =(int)$this->command->ask('How much shops do you want to generate ?',5);
        \App\Models\Shop::factory($shopNbr)->make()->each(function($shop) use($users){
            $shop->user_id=$users->random()->id;
            $shop->save();
         });
    }
}
