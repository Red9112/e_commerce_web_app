<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if ($this->command->confirm("do you want to refresh database ?")) {
           $this->command->call("migrate:refresh");
           $this->command->info("database was refreshed !!");
        }
        $this->call([
            usersTableSeeder::class,
            categoriesTableSeeder::class,
            shopsTableSeeder::class,
            productsTableSeeder::class,
            blogsTableSeeder::class,
            ProductCategoryTableSeeder::class,
            BlogCategoryTableSeeder::class,
        ]);
    }

}
