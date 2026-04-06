<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Kategori;
use App\Services\LogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class AlatController extends Controller
{
    /**
     * Get view path berdasarkan role user
     */
    private function getViewPath()
    {
        if (auth()->user()->role === 'petugas') {
            return 'petugas.pages.alat.';
        }
        return 'admin.pages.alat.';
    }

    /**
     * Get redirect route berdasarkan role user
     */
    private function getRedirectRoute()
    {
        if (auth()->user()->role === 'petugas') {
            return 'petugas.alat.index';
        }
        return 'admin.alat.index';
    }

    public function index()
    {
        $alats = Alat::with('kategori')->paginate(15);
        return view($this->getViewPath() . 'index', compact('alats'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view($this->getViewPath() . 'create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategori,id',
            'kode_alat' => 'required|unique:alat,kode_alat|max:50',
            'nama_alat' => 'required|max:255',
            'deskripsi' => 'nullable',
            'harga_sewa_per_hari' => 'required|integer|min:0',
            'stok_total' => 'required|integer|min:0',
            'kondisi' => 'required|in:baik,rusak_ringan,rusak_berat',
            'foto' => 'nullable|image|max:2048',
        ]);

        $validated['stok_tersedia'] = $validated['stok_total'];
        
        // Tambahkan tracking siapa yang membuat
        $validated['created_by'] = auth()->id();
        $validated['created_by_role'] = auth()->user()->role;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = Str::random(32) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/alat'), $filename);
            $validated['foto'] = $filename;
        }

        $alat = Alat::create($validated);
        
        LogService::log('create_alat', "Menambahkan alat: {$alat->nama_alat} ({$alat->kode_alat}) oleh " . auth()->user()->role);

        return redirect()->route($this->getRedirectRoute())
            ->with('success', 'Alat berhasil ditambahkan');
    }

    /**
     * Display the specified alat.
     */
    public function show(Alat $alat)
    {
        return view($this->getViewPath() . 'show', compact('alat'));
    }

    public function edit(Alat $alat)
    {
        $kategoris = Kategori::all();
        return view($this->getViewPath() . 'edit', compact('alat', 'kategoris'));
    }

    public function update(Request $request, Alat $alat)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategori,id',
            'kode_alat' => 'required|max:50|unique:alat,kode_alat,' . $alat->id,
            'nama_alat' => 'required|max:255',
            'deskripsi' => 'nullable',
            'harga_sewa_per_hari' => 'required|integer|min:0',
            'stok_total' => 'required|integer|min:0',
            'stok_tersedia' => 'required|integer|min:0|lte:stok_total',
            'kondisi' => 'required|in:baik,rusak_ringan,rusak_berat',
            'foto' => 'nullable|image|max:2048',
        ]);

        // Jika ada file foto baru yang diupload
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($alat->foto && File::exists(public_path('images/alat/' . $alat->foto))) {
                File::delete(public_path('images/alat/' . $alat->foto));
            }
            // Simpan foto baru
            $file = $request->file('foto');
            $filename = Str::random(32) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/alat'), $filename);
            $validated['foto'] = $filename;
        } else {
            // Jika tidak ada foto baru, pertahankan foto lama
            unset($validated['foto']);
        }

        $alat->update($validated);
        
        LogService::log('update_alat', "Mengupdate alat: {$alat->nama_alat} ({$alat->kode_alat}) oleh " . auth()->user()->role);

        return redirect()->route($this->getRedirectRoute())
            ->with('success', 'Alat berhasil diupdate');
    }

    public function destroy(Alat $alat)
    {
        try {
            if ($alat->foto && File::exists(public_path('images/alat/' . $alat->foto))) {
                File::delete(public_path('images/alat/' . $alat->foto));
            }
    
            $nama = $alat->nama_alat;
            $alat->delete();
            
            LogService::log('delete_alat', "Menghapus alat: {$nama} oleh " . auth()->user()->role);
    
            return redirect()->route($this->getRedirectRoute())
                ->with('success', 'Alat berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            // Check for integrity constraint violation (SQLSTATE 23000)
            if ($e->getCode() == 23000) {
                return back()->with('error', 'Gagal menghapus! Alat ini sedang digunakan dalam transaksi peminjaman.');
            }
            return back()->with('error', 'Terjadi kesalahan saat menghapus data.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan tak terduga.');
        }
    }
}