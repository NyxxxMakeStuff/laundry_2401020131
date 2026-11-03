<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PesananLaundry extends Model
{
    protected $table = 'pesanan_laundry';

    protected $fillable = [
        'kode_pesanan',
        'nama_pelanggan',
        'nomor_telepon',
        'berat_kg',
        'jenis_layanan_id',
    ];

    protected function casts(): array
    {
        return [
            'berat_kg' => 'integer',
        ];
    }

    public function jenisLayanan(): BelongsTo
    {
        return $this->belongsTo(
            JenisLayanan::class,
            'jenis_layanan_id'
        );
    }

    public function statusBerat(): string
    {
        return $this->berat_kg >= 10 ? 'Besar' : 'Reguler';
    }
}