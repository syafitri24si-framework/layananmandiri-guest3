<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class CreatePermohonanSuratDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Factory::create('id_ID'); // Faker Bahasa Indonesia

        // Data status permohonan
        $statusList = ['Pending', 'Diproses', 'Selesai', 'Ditolak'];

        foreach (range(1, 20) as $index) {
            // Ambil random warga_id dari tabel warga
            $warga = DB::table('warga')->inRandomOrder()->first();

            // Ambil random jenis_id dari tabel jenis_surat
            $jenisSurat = DB::table('jenis_surat')->inRandomOrder()->first();

            DB::table('permohonan_surat')->insert([
                'nomor_permohonan' => $faker->unique()->numerify('PS/####/') . date('Y'),
                'warga_id' => $warga->warga_id,
                'jenis_id' => $jenisSurat->jenis_id,
                'tanggal_pengajuan' => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d'),
                'status' => $faker->randomElement($statusList),
                'catatan' => $faker->optional(0.3)->text(100), // 30% chance ada catatan
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
