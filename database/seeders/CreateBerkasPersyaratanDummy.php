<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class CreateBerkasPersyaratanDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Factory::create('id_ID'); // Faker Bahasa Indonesia

        // Data jenis berkas
        $jenisBerkas = ['KTP', 'KK', 'Surat Pengantar RT/RW', 'Pas Foto', 'Surat Keterangan', 'Ijazah', 'Akte Kelahiran', 'Akte Nikah', 'NPWP', 'Lainnya'];

        // Data status validasi
        $statusValid = ['menunggu', 'valid', 'tidak_valid'];

        // Cek apakah ada data permohonan
        $jumlahPermohonan = DB::table('permohonan_surat')->count();

        if ($jumlahPermohonan == 0) {
            $this->command->error('Tidak ada data permohonan surat di database!');
            $this->command->info('Jalankan seeder permohonan surat terlebih dahulu.');
            return;
        }

        $this->command->info('Memulai seeding dummy berkas persyaratan...');

        foreach (range(1, 100) as $index) {
            // Ambil random permohonan dari tabel permohonan_surat
            $permohonan = DB::table('permohonan_surat')->inRandomOrder()->first();

            // Insert data ke tabel berkas_persyaratan
            DB::table('berkas_persyaratan')->insert([
                'permohonan_id' => $permohonan->permohonan_id,
                'nama_berkas' => $faker->randomElement($jenisBerkas),
                'valid' => $faker->randomElement($statusValid),
                'created_at' => $faker->dateTimeBetween('-2 months', 'now'),
                'updated_at' => now(),
            ]);

            // Tampilkan progress setiap 10 data
            if ($index % 10 == 0) {
                $this->command->info("Progress: {$index}/100 data berhasil dibuat");
            }
        }

        $this->command->info('✅ Seeding dummy berkas persyaratan selesai!');
        $this->command->info('Total data: 100');
    }
}
