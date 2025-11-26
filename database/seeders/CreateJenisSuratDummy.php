<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class CreateJenisSuratDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Factory::create('id_ID'); // Faker Bahasa Indonesia

        // Data kode surat
        $kodeSurat = ['SKD', 'SKTM', 'SKU', 'SKK', 'SKKM', 'SPN', 'SKBN', 'SKP'];

        // Data nama jenis surat
        $namaJenis = [
            'Surat Keterangan Domisili',
            'Surat Keterangan Tidak Mampu',
            'Surat Keterangan Usaha',
            'Surat Keterangan Kelahiran',
            'Surat Keterangan Kematian',
            'Surat Pengantar Nikah',
            'Surat Keterangan Penghasilan'
        ];

        foreach (range(1, 8) as $index) {
            $kode = $kodeSurat[$index - 1];
            $nama = $namaJenis[$index - 1];

            // Tentukan syarat berdasarkan kode surat
            $syarat = ['Fotokopi KTP', 'Fotokopi Kartu Keluarga', 'Surat Pengantar RT/RW'];

            if ($kode === 'SKTM') {
                $syarat[] = 'Slip Gaji atau Surat Keterangan Penghasilan';
            } elseif ($kode === 'SKU') {
                $syarat[] = 'Foto Tempat Usaha';
            } elseif ($kode === 'SKK') {
                $syarat[] = 'Surat Keterangan Lahir dari Bidan/Rumah Sakit';
            } elseif ($kode === 'SKKM') {
                $syarat[] = 'Surat Keterangan Kematian dari Rumah Sakit';
            } elseif ($kode === 'SPN') {
                $syarat[] = 'Fotokopi Akta Kelahiran';
            } elseif ($kode === 'SKBN') {
                $syarat[] = 'Dokumen Asli yang menunjukkan perbedaan nama';
            } elseif ($kode === 'SKP') {
                $syarat[] = 'Slip Gaji atau Surat Keterangan Kerja';
            }

            DB::table('jenis_surat')->insert([
                'kode' => $kode,
                'nama_jenis' => $nama,
                'syarat_json' => json_encode($syarat),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
