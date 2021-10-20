<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// user model
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Call user model, run it 10 times and create fake user in db
        User::factory()->times(10)->create();
    }
}
