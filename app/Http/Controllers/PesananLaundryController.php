<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PesananLaundry;
use App\Models\JenisLayanan;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class PesananLaundryController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = PesananLaundry::with('jenisLayanan');

            // Pencarian atau filter berdasarkan kode, nama, atau nomor telepon.
            if ($request->filled('search')) {
                $search = trim($request->input('search'));

                $query->where(function ($q) use ($search) {
                    $q->where('kode_pesanan', 'like', "%{$search}%")
                        ->orWhere('nama_pelanggan', 'like', "%{$search}%")
                        ->orWhere('nomor_telepon', 'like', "%{$search}%");
                });
            }

            // Filter berdasarkan jenis layanan.
            if ($request->filled('jenis_layanan_id')) {
                $query->where(
                    'jenis_layanan_id',
                    $request->input('jenis_layanan_id')
                );
            }

            $pesanan = $query->orderByDesc('id')
                ->paginate(10)
                ->withQueryString();

            $jenisLayanan = JenisLayanan::orderBy('nama_layanan')->get();

            return view('pesanan-laundry.index', compact(
                'pesanan',
                'jenisLayanan'
            ));

        } 


    //CREATE PESANAN LAUNDRY
    public function create()
    {
        try {
            $jenisLayanan = JenisLayanan::orderBy('nama_layanan')->get();

            return view('pesanan-laundry.create', compact('jenisLayanan'));

        } catch (\Throwable $e) {
            report($e);

            return redirect()
                ->route('pesanan-laundry.index')
                ->with('error', 'Gagal membuka formulir pesanan.');
        }
    }


    //STORE PESANAN LAUNDRY
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'kode_pesanan' => [
                    'required',
                    'string',
                    'size:10',
                    'alpha_num',
                    'unique:pesanan_laundry,kode_pesanan',
                ],
                'nama_pelanggan' => [
                    'required',
                    'string',
                    'min:3',
                    'max:100',
                ],
                'nomor_telepon' => [
                    'required',
                    'string',
                    'min:10',
                    'max:20',
                    'unique:pesanan_laundry,nomor_telepon',
                ],
                'berat_kg' => [
                    'required',
                    'integer',
                    'between:1,20',
                ],
                'jenis_layanan_id' => [
                    'required',
                    'integer',
                    'exists:jenis_layanan,id',
                ],
            ], [
                'kode_pesanan.size' => 'Kode pesanan harus tepat 10 karakter.',
                'kode_pesanan.alpha_num' => 'Kode hanya boleh berisi huruf dan angka.',
                'kode_pesanan.unique' => 'Kode pesanan sudah digunakan.',
                'nama_pelanggan.min' => 'Nama minimal 3 karakter.',
                'nomor_telepon.min' => 'Nomor telepon minimal 10 karakter.',
                'nomor_telepon.max' => 'Nomor telepon maksimal 20 karakter.',
                'nomor_telepon.unique' => 'Nomor telepon sudah digunakan.',
                'berat_kg.integer' => 'Berat harus berupa bilangan bulat.',
                'berat_kg.between' => 'Berat harus antara 1 sampai 20 kg.',
                'jenis_layanan_id.exists' => 'Jenis layanan tidak tersedia.',
            ]);

            PesananLaundry::create($data);

            return redirect()
                ->route('pesanan-laundry.index')
                ->with('success', 'Pesanan laundry berhasil ditambahkan.');

        } catch (ValidationException $e) {
            throw $e;

        } catch (\Throwable $e) {
            report($e);

            return back()
                ->withInput()
                ->with('error', 'Pesanan gagal ditambahkan. Silakan coba lagi.');
        }
    }


    //DISPLAY DETAIL PESANAN LAUNDRY
    public function show(PesananLaundry $pesanan_laundry)
    {
        try {
            $pesanan_laundry->load('jenisLayanan');

            return view('pesanan-laundry.show', [
                'pesanan' => $pesanan_laundry,
            ]);

        } catch (\Throwable $e) {
            report($e);

            return redirect()
                ->route('pesanan-laundry.index')
                ->with('error', 'Gagal menampilkan detail pesanan.');
        }
    }


    //EDIT PESANAN LAUNDRY
    public function edit(PesananLaundry $pesanan_laundry)
    {
        try {
            $jenisLayanan = JenisLayanan::orderBy('nama_layanan')->get();

            return view('pesanan-laundry.edit', [
                'pesanan' => $pesanan_laundry,
                'jenisLayanan' => $jenisLayanan,
            ]);

        } catch (\Throwable $e) {
            report($e);

            return redirect()
                ->route('pesanan-laundry.index')
                ->with('error', 'Gagal membuka formulir edit pesanan.');
        }
    }


    //UPDATE PESANAN LAUNDRY
    public function update(
        Request $request,
        PesananLaundry $pesanan_laundry
    ) {
        try {
            $data = $request->validate([
                'kode_pesanan' => [
                    'required',
                    'string',
                    'size:10',
                    'alpha_num',
                    Rule::unique('pesanan_laundry', 'kode_pesanan')
                        ->ignore($pesanan_laundry->id),
                ],
                'nama_pelanggan' => [
                    'required',
                    'string',
                    'min:3',
                    'max:100',
                ],
                'nomor_telepon' => [
                    'required',
                    'string',
                    'min:10',
                    'max:20',
                    Rule::unique('pesanan_laundry', 'nomor_telepon')
                        ->ignore($pesanan_laundry->id),
                ],
                'berat_kg' => [
                    'required',
                    'integer',
                    'between:1,20',
                ],
                'jenis_layanan_id' => [
                    'required',
                    'integer',
                    'exists:jenis_layanan,id',
                ],
            ], [
                'kode_pesanan.size' => 'Kode pesanan harus tepat 10 karakter.',
                'kode_pesanan.alpha_num' => 'Kode hanya boleh berisi huruf dan angka.',
                'kode_pesanan.unique' => 'Kode pesanan sudah digunakan.',
                'nama_pelanggan.min' => 'Nama minimal 3 karakter.',
                'nomor_telepon.min' => 'Nomor telepon minimal 10 karakter.',
                'nomor_telepon.max' => 'Nomor telepon maksimal 20 karakter.',
                'nomor_telepon.unique' => 'Nomor telepon sudah digunakan.',
                'berat_kg.integer' => 'Berat harus berupa bilangan bulat.',
                'berat_kg.between' => 'Berat harus antara 1 sampai 20 kg.',
                'jenis_layanan_id.exists' => 'Jenis layanan tidak tersedia.',
            ]);

            $pesanan_laundry->update($data);

            return redirect()
                ->route('pesanan-laundry.index')
                ->with('success', 'Pesanan laundry berhasil diperbarui.');

        } catch (ValidationException $e) {
            throw $e;

        } catch (\Throwable $e) {
            report($e);

            return back()
                ->withInput()
                ->with('error', 'Pesanan gagal diperbarui. Silakan coba lagi.');
        }
    }


    //DELETE PESANAN LAUNDRY
    public function destroy(PesananLaundry $pesanan_laundry)
    {
        try {
            $pesanan_laundry->delete();

            return redirect()
                ->route('pesanan-laundry.index')
                ->with('success', 'Pesanan laundry berhasil dihapus.');

        } catch (\Throwable $e) {
            report($e);

            return redirect()
                ->route('pesanan-laundry.index')
                ->with('error', 'Pesanan gagal dihapus. Silakan coba lagi.');
        }
    }
}