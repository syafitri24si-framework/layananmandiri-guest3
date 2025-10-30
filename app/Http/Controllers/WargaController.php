<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    /**
     * Tampilkan semua data warga.
     */
    public function index()
    {
        $warga = Warga::all();
        return view('guest.warga.index', compact('warga'));
    }


    
    /**
     * Form tambah data warga.
     */
    public function create()
    {
        return view('guest.warga.create');
    }

    /**
     * Simpan data warga baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_ktp' => 'required|unique:warga,no_ktp|max:16',
            'nama' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|string|max:50',
            'pekerjaan' => 'nullable|string|max:100',
            'telp' => 'nullable|string|max:15',
            'email' => 'nullable|email|unique:warga,email',
        ]);

        Warga::create($validated);

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil ditambahkan!');
    }

    /**
     * Form edit data warga.
     */
    public function edit($id)
    {
        $warga = Warga::findOrFail($id);
        return view('guest.warga.edit', compact('warga'));
    }

    /**
     * Update data warga.
     */
    public function update(Request $request, $id)
    {
        $warga = Warga::findOrFail($id);

        $validated = $request->validate([
            'no_ktp' => 'required|max:16|unique:warga,no_ktp,' . $warga->warga_id . ',warga_id',
            'nama' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|string|max:50',
            'pekerjaan' => 'nullable|string|max:100',
            'telp' => 'nullable|string|max:15',
            'email' => 'nullable|email|unique:warga,email,' . $warga->warga_id . ',warga_id',
        ]);

        $warga->update($validated);

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil diperbarui!');
    }

    /**
     * Hapus data warga.
     */
    public function destroy($id)
    {
        $warga = Warga::findOrFail($id);
        $warga->delete();

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil dihapus!');
    }
}
