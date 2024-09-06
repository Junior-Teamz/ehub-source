<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


use App\Models\User;

use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
class FakeUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
$faker = Faker::create('id_ID');
        DB::transaction(function () use ($faker) {
            for ($i = 1; $i <= 12959; $i++) {
                $gender = $faker->randomElement(['male', 'female']);

                // insert data ke table pegawai menggunakan Faker
                $user = [
                    'fullname' => $faker->name($gender),
                    'email' => $faker->email(),
                    'username' => $faker->userName(),
                    'phone' => '08' . $faker->numerify('##########'),
                    'gender' => $gender,
                    'address' => $faker->address(),
                    'password' => $faker->password(),
                    'is_fake' => 1
                ];

                // $peserta = DB::table('participant_users')->insertGetId([
                //     'user_id' => $user_id,
                //     'fullname' => $user['fullname'],
                //     'gender' => $user['gender'],
                //     'phone_number' => $user['phone'],
                //     'is_fake' => 1,
                //     'status' => 'registered'
                // ]);

                // $busibess = DB::table('participant_businesses')->insertGetId([
                //     'participant_id' => $peserta,
                //     'name' => $faker->company(),
                //     'address' => $faker->address(),
                //     'is_fake' => 1,
                // ]);

                $user = User::create($user);
                $user->assignRole('entrepreneur');
            }
            for ($i = 1; $i <= 66; $i++) {
                $workshop = [
                    'title' => $faker->text(),
                    'description' => $faker->text(),
                    'address' => $faker->address(),
                    'place' => $faker->streetAddress(),
                    'is_fake' => 1
                ];
                DB::table('workshops')->insertGetId($workshop);
            }
        });
    }
}
