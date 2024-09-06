<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User Entrepreneur
        User::updateOrCreate(
            ['email' => 'jhon.doe@gmail.com'],
            [
                'fullname' => 'Jhon Doe',
                'username' => 'jhondoe',
                'phone' => '081333666999',
                'email_verified_at' => Carbon::parse('2023-04-16 17:22:45'),
                'password' => bcrypt('asdasd'),
            ]
        )->syncRoles('entrepreneur');

        // User Admin
        User::updateOrCreate(
            ['email' => 'admin@ehub.com'],
            [
                'fullname' => 'Admin Ehub',
                'username' => 'admin_ehub',
                'phone' => '081333666777',
                'email_verified_at' => Carbon::parse('2023-04-16 17:22:45'),
                'password' => bcrypt('asdasd'),
            ]
        )->syncRoles('admin');
    }
}
