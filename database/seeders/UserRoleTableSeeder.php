<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;

class UserRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users=User::all();
        $roles=Role::whereIn('name', ['customer','vendor'])->get();
        $rolesIds=collect($roles)->pluck('id');
        $users->each(function($user) use($rolesIds){
            if ($user->name=="admin") {
         $user->roles()->sync(1);
            } else {
        $user->roles()->sync($rolesIds->random());
            }

        });
    }
}
