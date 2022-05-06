<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'type' => User::TYPE_ADMIN,
            'first_name' => 'Administrator',
            'last_name' => '',
            'password' => bcrypt('password'),
            'email' => 'super@admin.com',
            'email_verified_at' => now(),
            'approved_at' => now(),
        ]);
    }
}
