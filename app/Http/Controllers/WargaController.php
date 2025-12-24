<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WargaController extends Controller
{
    /**
     * Tampilkan semua data warga.
     */
    public function index(Request $request)
{
    $user = Auth::user();

    // Inisialisasi query
    $query = Warga::query();

    // Filter berdasarkan role
    if ($user->isWarga()) {
        // Warga hanya bisa lihat data sendiri
        $wargaData = $user->dataWarga();

        if ($wargaData) {
            $query->where('warga_id', $wargaData->warga_id);
        } else {
            // Kembalikan PAGINATOR kosong
            $warga = Warga::where('warga_id', 0)->paginate(12);
            return view('pages.warga.index', compact('warga'));
        }
    }
        // Admin tetap bisa lihat semua (tidak perlu filter)

        // Apply existing filters
        if ($request->filled('jenis_kelamin')) {
            $query->where('jenis_kelamin', $request->input('jenis_kelamin'));
        }

        if ($request->filled('agama')) {
            $query->where('agama', $request->input('agama'));
        }

        // Apply search
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama', 'like', '%' . $searchTerm . '%')
                  ->orWhere('no_ktp', 'like', '%' . $searchTerm . '%')
                  ->orWhere('email', 'like', '%' . $searchTerm . '%')
                  ->orWhere('telp', 'like', '%' . $searchTerm . '%')
                  ->orWhere('pekerjaan', 'like', '%' . $searchTerm . '%');
            });
        }

        $warga = $query->paginate(12);

        return view('pages.warga.index', compact('warga'));
    }

    /**
     * Form tambah data warga.
     */
    public function create()
    {
        $user = Auth::user();

        // Warga hanya boleh buat data untuk diri sendiri
        if ($user->isWarga() && $user->hasWargaData()) {
            return redirect()->route('warga.index')
                ->with('error', 'Anda sudah memiliki data warga. Silakan edit data yang sudah ada.');
        }

        return view('pages.warga.create');
    }

    /**
     * Simpan data warga baru.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // Validasi khusus untuk warga
        if ($user->isWarga()) {
            // Warga hanya bisa buat data untuk diri sendiri
            if ($user->hasWargaData()) {
                return redirect()->route('warga.index')
                    ->with('error', 'Anda sudah memiliki data warga.');
            }

            // Pastikan email sama dengan email user
            $request->merge(['email' => $user->email]);
        }

        $validated = $request->validate([
            'no_ktp' => 'required|unique:warga,no_ktp|max:16',
            'nama' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|string|max:50',
            'pekerjaan' => 'nullable|string|max:100',
            'telp' => 'nullable|string|max:15',
            'email' => 'nullable|email|unique:warga,email',
        ]);

        // Untuk warga, email wajib diisi
        if ($user->isWarga()) {
            $validated['email'] = $user->email;
        }

        Warga::create($validated);

        $message = 'Data warga berhasil ditambahkan!';
        if ($user->isWarga()) {
            $message = 'Data pribadi Anda berhasil disimpan!';
        }

        return redirect()->route('warga.index')->with('success', $message);
    }

    /**
     * Tampilkan detail warga.
     */
    public function show($id)
    {
        $warga = Warga::findOrFail($id);
        $user = Auth::user();

        // Authorization check
        if ($user->isWarga() && !$user->canAccessWarga($id)) {
            return abort(403, 'Anda tidak memiliki izin untuk mengakses data ini.');
        }

        return view('pages.warga.show', compact('warga'));
    }

    /**
     * Form edit data warga.
     */
    public function edit($id)
    {
        $warga = Warga::findOrFail($id);
        $user = Auth::user();

        // Authorization check
        if ($user->isWarga() && !$user->canAccessWarga($id)) {
            return abort(403, 'Anda tidak memiliki izin untuk mengedit data ini.');
        }

        return view('pages.warga.edit', compact('warga'));
    }

    /**
     * Update data warga.
     */
    public function update(Request $request, $id)
    {
        $warga = Warga::findOrFail($id);
        $user = Auth::user();

        // Authorization check
        if ($user->isWarga() && !$user->canAccessWarga($id)) {
            return abort(403, 'Anda tidak memiliki izin untuk mengupdate data ini.');
        }

        // Validasi untuk warga (email tidak boleh diubah)
        $validationRules = [
            'no_ktp' => 'required|max:16|unique:warga,no_ktp,' . $id . ',warga_id',
            'nama' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|string|max:50',
            'pekerjaan' => 'nullable|string|max:100',
            'telp' => 'nullable|string|max:15',
        ];

        // Tambahkan validasi email untuk admin
        if ($user->isAdmin()) {
            $validationRules['email'] = 'nullable|email|unique:warga,email,' . $id . ',warga_id';
        }

        $validated = $request->validate($validationRules);

        // Update data
        $warga->no_ktp = $validated['no_ktp'];
        $warga->nama = $validated['nama'];
        $warga->jenis_kelamin = $validated['jenis_kelamin'];
        $warga->agama = $validated['agama'];
        $warga->pekerjaan = $validated['pekerjaan'];
        $warga->telp = $validated['telp'];

        if ($user->isAdmin() && isset($validated['email'])) {
            $warga->email = $validated['email'];
        }

        $warga->save();

        $message = 'Perubahan Data Warga Berhasil!';
        if ($user->isWarga()) {
            $message = 'Data pribadi Anda berhasil diperbarui!';
        }

        return redirect()->route('warga.index')->with('success', $message);
    }

    /**
     * Hapus data warga.
     */
    public function destroy($id)
    {
        $warga = Warga::findOrFail($id);
        $user = Auth::user();

        // Authorization check
        if ($user->isWarga() && !$user->canAccessWarga($id)) {
            return abort(403, 'Anda tidak memiliki izin untuk menghapus data ini.');
        }

        // Cek jika warga masih memiliki permohonan
        if ($warga->permohonanSurat()->count() > 0) {
            return redirect()->route('warga.index')
                ->with('error', 'Data warga tidak dapat dihapus karena masih memiliki permohonan surat.');
        }

        $warga->delete();

        $message = 'Data warga berhasil dihapus!';
        if ($user->isWarga()) {
            $message = 'Data pribadi Anda berhasil dihapus!';
            Auth::logout();
            return redirect()->route('auth.index')->with('success', $message);
        }

        return redirect()->route('warga.index')->with('success', $message);
    }
}
