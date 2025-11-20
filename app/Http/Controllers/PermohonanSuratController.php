<?php

namespace App\Http\Controllers;

use App\Models\PermohonanSurat;
use App\Models\Warga;
use App\Models\JenisSurat;
use Illuminate\Http\Request;

class PermohonanSuratController extends Controller
{
    // INDEX – tampilkan semua permohonan surat
    public function index()
    {
        $data = PermohonanSurat::with(['warga', 'jenisSurat'])->get();
        return view('pages.permohonan_surat.index', compact('data'));
    }

    // CREATE – tampilkan form tambah
    public function create()
    {
        $warga = Warga::all();
        $jenisSurat = JenisSurat::all();
        return view('pages.permohonan_surat.create', compact('warga', 'jenisSurat'));
    }

    // STORE – simpan data permohonan
    public function store(Request $request)
    {
        $request->validate([
            'nomor_permohonan' => 'required|unique:permohonan_surat',
            'warga_id' => 'required|exists:warga,warga_id',
            'jenis_id' => 'required|exists:jenis_surat,jenis_id',
            'tanggal_pengajuan' => 'required|date',
            'status' => 'required|in:pending,diproses,selesai,ditolak',
        ]);

        PermohonanSurat::create($request->all());

        return redirect()->route('permohonan_surat.index')->with('success', 'Data berhasil ditambahkan.');
    }

    // EDIT – form edit - ✅ ROUTE MODEL BINDING
    public function edit(PermohonanSurat $permohonan_surat)
    {
        $warga = Warga::all();
        $jenisSurat = JenisSurat::all();
        return view('pages.permohonan_surat.edit', compact('permohonan_surat', 'warga', 'jenisSurat'));
    }

    // UPDATE – update data - ✅ ROUTE MODEL BINDING
    public function update(Request $request, PermohonanSurat $permohonan_surat)
    {
        $request->validate([
            'nomor_permohonan' => 'required|unique:permohonan_surat,nomor_permohonan,' . $permohonan_surat->permohonan_id . ',permohonan_id',
            'warga_id' => 'required|exists:warga,warga_id',
            'jenis_id' => 'required|exists:jenis_surat,jenis_id',
            'tanggal_pengajuan' => 'required|date',
            'status' => 'required|in:pending,diproses,selesai,ditolak',
        ]);

        $permohonan_surat->update($request->all());

        return redirect()->route('permohonan_surat.index')->with('success', 'Data berhasil diperbarui.');
    }

    // DELETE – hapus data - ✅ ROUTE MODEL BINDING
    public function destroy(PermohonanSurat $permohonan_surat)
    {
        $permohonan_surat->delete();
        return redirect()->route('permohonan_surat.index')->with('success', 'Data berhasil dihapus.');
    }
}
