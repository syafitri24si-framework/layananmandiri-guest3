<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class CreateUserDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ganti ini dari FakerFactory::create menjadi Faker::create
        $faker = Faker::create('id_ID'); // PERUBAHAN INI!

        for ($i = 1; $i <= 100; $i++) {
            $userData = [
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password123'),
                'role' => $faker->randomElement(['Admin', 'Warga']),
                'email_verified_at' => $faker->randomElement([now(), null]),
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => now(),
            ];

            DB::table('users')->insert($userData);
        }

        // Tambahkan user khusus untuk testing
        DB::table('users')->insert([
            'name' => 'Admin Suratku',
            'email' => 'admin@suratku.id',
            'password' => Hash::make('password123'),
            'role' => 'Admin',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Warga Contoh',
            'email' => 'warga@suratku.id',
            'password' => Hash::make('password123'),
            'role' => 'Warga',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->command->info('102 data user dummy berhasil dibuat!');
        $this->command->info('Login dengan:');
        $this->command->info('Email Admin: admin@suratku.id');
        $this->command->info('Email Warga: warga@suratku.id');
        $this->command->info('Password: password123');
    }
}
