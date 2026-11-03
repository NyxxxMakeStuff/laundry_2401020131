@extends('layouts.app')

@section('title', 'Detail Pesanan')

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="mb-0">Detail Pesanan Laundry</h4>
    </div>

    <div class="card-body">
        <table class="table">
            <tr>
                <th>Kode Pesanan</th>
                <td>{{ $pesanan->kode_pesanan }}</td>
            </tr>
            <tr>
                <th>Nama Pelanggan</th>
                <td>{{ $pesanan->nama_pelanggan }}</td>
            </tr>
            <tr>
                <th>Nomor Telepon</th>
                <td>{{ $pesanan->nomor_telepon }}</td>
            </tr>
            <tr>
                <th>Berat</th>
                <td>{{ $pesanan->berat_kg }} kg</td>
            </tr>
            <tr>
                <th>Status Berat</th>
                <td>
                    @if ($pesanan->statusBerat() === 'Besar')
                        Besar
                    @else
                        Reguler
                    @endif
                </td>
            </tr>
            <tr>
                <th>Jenis Layanan</th>
                <td>{{ $pesanan->jenisLayanan->nama_layanan }}</td>
            </tr>
            <tr>
                <th>Dibuat</th>
                <td>{{ $pesanan->created_at->format('d-m-Y H:i') }}</td>
            </tr>
            <tr>
                <th>Diperbarui</th>
                <td>{{ $pesanan->updated_at->format('d-m-Y H:i') }}</td>
            </tr>
        </table>

        <a href="{{ route('pesanan-laundry.index') }}"
           class="btn btn-secondary">
            Kembali
        </a>

        <a href="{{ route('pesanan-laundry.edit', $pesanan) }}"
           class="btn btn-warning">
            Edit
        </a>
    </div>
</div>
@endsection