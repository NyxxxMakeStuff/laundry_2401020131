<?php

namespace Database\Seeders;

use App\Models\JenisLayanan;
use App\Models\PesananLaundry;
use Illuminate\Database\Seeder;

class LaundrySeeder extends Seeder
{
    public function run(): void
    {
        $kering = JenisLayanan::firstOrCreate([
            'nama_layanan' => 'Cuci Kering',
        ]);

        $setrika = JenisLayanan::firstOrCreate([
            'nama_layanan' => 'Cuci Setrika',
        ]);

        $pesanan = [
            [
                'kode_pesanan' => 'LD00000001',
                'nama_pelanggan' => 'Ayu Lestari',
                'nomor_telepon' => '081200000001',
                'berat_kg' => 5,
                'jenis_layanan_id' => $kering->id,
            ],
            [
                'kode_pesanan' => 'LD00000002',
                'nama_pelanggan' => 'Rafi Akbar',
                'nomor_telepon' => '081200000002',
                'berat_kg' => 8,
                'jenis_layanan_id' => $setrika->id,
            ],
            [
                'kode_pesanan' => 'LD00000003',
                'nama_pelanggan' => 'Nina Putri',
                'nomor_telepon' => '081200000003',
                'berat_kg' => 3,
                'jenis_layanan_id' => $kering->id,
            ],
        ];

        foreach ($pesanan as $data) {
            PesananLaundry::firstOrCreate(
                ['kode_pesanan' => $data['kode_pesanan']],
                $data
            );
        }
    }
}