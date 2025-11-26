<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class CreateWargaDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Factory::create('id_ID'); // Faker Bahasa Indonesia

        // Data agama dalam Bahasa Indonesia
        $agamaList = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'];

        // Data pekerjaan yang umum di Indonesia
        $pekerjaanList = [
            'Wiraswasta', 'PNS', 'Guru', 'Dosen', 'Dokter', 'Perawat',
            'Karyawan Swasta', 'Petani', 'Nelayan', 'Pedagang', 'Sopir',
            'Buruh', 'Ibu Rumah Tangga', 'Pelajar/Mahasiswa', 'Pensiunan',
        ];

        foreach (range(1, 200) as $index) {
            $jenisKelamin = $faker->randomElement(['Laki-laki', 'Perempuan']);
            $firstName    = $jenisKelamin === 'Laki-laki' ? $faker->firstNameMale : $faker->firstNameFemale;

            DB::table('warga')->insert([
                'no_ktp'        => $faker->unique()->numerify('32##############'),
                'nama'          => $firstName . ' ' . $faker->lastName,
                'jenis_kelamin' => $jenisKelamin,
                'agama'         => $faker->randomElement($agamaList),
                'pekerjaan'     => $faker->randomElement($pekerjaanList),
                'telp'          => '+62' . $faker->numerify('8##########'), // +6281234567890 (15 digit)
                'email'         => $faker->unique()->safeEmail,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }
    }
}
