<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// use models
use App\Models\Role;
use App\Models\User;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all roles out of the db
        $roles = Role::all(); //returns collection of all roles

        // Get users and populate pivot table with one of the roles
        // For each user returned, run function
        User::all()->each(function ($user) use ($roles) {
            // attach role to current user inside of of each loop
            $user->roles()->attach(
                // attach the below into roles relationship on the user model

                // pick one item from roles collection and return its ID (1,2 or 3)
                $roles->random(1)->pluck('id') // we can attach 2 roles by changing 1 to 2
            );
        });
    }
}
