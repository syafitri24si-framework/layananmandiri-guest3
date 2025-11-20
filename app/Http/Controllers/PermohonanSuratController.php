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
        $data = PermohonanSurat::with(['warga', 'jenis_surat'])->get();

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
            'status' => 'required',
        ]);

        PermohonanSurat::create([
            'nomor_permohonan' => $request->nomor_permohonan,
            'warga_id' => $request->warga_id,
            'jenis_id' => $request->jenis_id,
            'tanggal_pengajuan' => $request->tanggal_pengajuan,
            'status' => $request->status,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('permohonan_surat.index')->with('success', 'Data berhasil ditambahkan.');
    }

    // EDIT – form edit
    public function edit($id)
    {
        $data = PermohonanSurat::findOrFail($id);
        $warga = Warga::all();
        $jenisSurat = JenisSurat::all();

        return view('pages.permohonan_surat.edit', compact('data', 'warga', 'jenisSurat'));
    }

    // UPDATE – update data
    public function update(Request $request, $id)
    {
        $data = PermohonanSurat::findOrFail($id);

        $request->validate([
            'nomor_permohonan' => 'required|unique:permohonan_surat,nomor_permohonan,' . $id . ',permohonan_id',
            'warga_id' => 'required|exists:warga,warga_id',
            'jenis_id' => 'required|exists:jenis_surat,jenis_id',
            'tanggal_pengajuan' => 'required|date',
            'status' => 'required',
        ]);

        $data->update([
            'nomor_permohonan' => $request->nomor_permohonan,
            'warga_id' => $request->warga_id,
            'jenis_id' => $request->jenis_id,
            'tanggal_pengajuan' => $request->tanggal_pengajuan,
            'status' => $request->status,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('permohonan_surat.index')->with('success', 'Data berhasil diperbarui.');
    }

    // DELETE – hapus data
    public function destroy($id)
    {
        PermohonanSurat::findOrFail($id)->delete();

        return redirect()->route('permohonan_surat.index')->with('success', 'Data berhasil dihapus.');
    }
}
