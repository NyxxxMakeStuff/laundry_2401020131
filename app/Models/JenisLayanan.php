<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JenisLayanan extends Model
{
    protected $table = 'jenis_layanan';

    public $timestamps = false;

    protected $fillable = [
        'nama_layanan',
    ];

    public function pesanan(): HasMany
    {
        return $this->hasMany(
            PesananLaundry::class,
            'jenis_layanan_id'
        );
    }
}