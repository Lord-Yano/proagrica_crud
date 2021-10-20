<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// role model
use App\Models\Role;

//db facade
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Hard code roles - factory will not be used to generate roles

        // Call DB facade on table of roles
        DB::table('roles')->insert([
            'name' => 'Admin'
        ]);

        DB::table('roles')->insert([
            'name' => 'Author'
        ]);

        DB::table('roles')->insert([
            'name' => 'User'
        ]);
    }
}
