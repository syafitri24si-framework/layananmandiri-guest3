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
        return view('pages.warga.index', compact('warga'));
    }



    /**
     * Form tambah data warga.
     */
    public function create()
    {
        return view('pages.warga.create');
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
        $data['warga'] = Warga::findOrFail($id);
    return view('pages.warga.edit', $data);
    }

    /**
     * Update data warga.
     */
    public function update(Request $request, $id)
    {
    $warga_id = $id;
    $warga = Warga::findOrFail($warga_id);

    $warga->no_ktp = $request->no_ktp;
    $warga->nama = $request->nama;
    $warga->jenis_kelamin = $request->jenis_kelamin;
    $warga->agama = $request->agama;
    $warga->pekerjaan = $request->pekerjaan;
    $warga->telp = $request->telp;
    $warga->email = $request->email;

    $warga->save();

    return redirect()->route('warga.index')->with('success', 'Perubahan Data Warga Berhasil!');

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
