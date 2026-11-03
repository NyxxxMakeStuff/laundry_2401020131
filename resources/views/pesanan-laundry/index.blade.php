
@extends('layouts.app')

@section('title', 'Daftar Pesanan Laundry')

@section('content')

    <h2>Daftar Pesanan</h2>

    <a href="{{ route('pesanan-laundry.create') }}">Tambah Pesanan</a>

    <form action="{{ route('pesanan-laundry.index') }}" method="GET">
        <input
            type="text"
            name="search"
            placeholder="Cari kode, nama, atau nomor telepon"
            value="{{ request('search') }}"
        >

        <select name="jenis_layanan_id">
            <option value="">Semua Layanan</option>

            @foreach ($jenisLayanan as $jenis)
                <option value="{{ $jenis->id }}"
                    {{ request('jenis_layanan_id') == $jenis->id ? 'selected' : '' }}>
                    {{ $jenis->nama_layanan }}
                </option>
            @endforeach
        </select>

        <button type="submit">Cari</button>
        <a href="{{ route('pesanan-laundry.index') }}">Reset</a>
    </form>

    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th>Kode Pesanan</th>
                <th>Nama Pelanggan</th>
                <th>Nomor Telepon</th>
                <th>Berat (kg)</th>
                <th>Status Berat</th>
                <th>Jenis Layanan</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($pesanan as $item)
                <tr>
                    <td>{{ $item->kode_pesanan }}</td>
                    <td>{{ $item->nama_pelanggan }}</td>
                    <td>{{ $item->nomor_telepon }}</td>
                    <td>{{ $item->berat_kg }}</td>
                    <td>
                        @if ($item->berat_kg >= 10)
                            Besar
                        @else
                            Reguler
                        @endif
                    </td>
                    <td>{{ $item->jenisLayanan->nama_layanan }}</td>
                    <td>
                        <a href="{{ route('pesanan-laundry.show', $item->id) }}">Detail</a> |
                        <a href="{{ route('pesanan-laundry.edit', $item->id) }}">Edit</a> |

                        <form action="{{ route('pesanan-laundry.destroy', $item->id) }}"
                              method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                onclick="return confirm('Hapus pesanan ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Belum ada pesanan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $pesanan->links() }}

@endsection
