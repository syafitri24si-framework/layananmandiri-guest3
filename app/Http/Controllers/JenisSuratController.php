<?php

namespace App\Http\Controllers;

use App\Models\JenisSurat;
use App\Models\Media;
use App\Models\PermohonanSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class JenisSuratController extends Controller
{
    /**
     * Tampilkan semua jenis surat.
     */
    public function index(Request $request)
    {
        // Semua role bisa lihat jenis surat
        $query = JenisSurat::with('mediaFiles');

        // Apply existing filter
        if ($request->filled('kode')) {
            $query->where('kode', $request->input('kode'));
        }

        // Apply search
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama_jenis', 'like', '%' . $searchTerm . '%')
                  ->orWhere('kode', 'like', '%' . $searchTerm . '%');
            });
        }

        $jenisSurat = $query->paginate(5)->withQueryString();

        // Ambil semua kode surat yang ada di database untuk dropdown
        $kodeSurat = JenisSurat::select('kode')->distinct()->orderBy('kode')->get();

        return view('pages.jenis_surat.index', compact('jenisSurat', 'kodeSurat'));
    }

    /**
     * Tampilkan detail jenis surat.
     */
    public function show($id)
    {
        $user = Auth::user();

        // Semua role bisa lihat detail jenis surat
        $jenisSurat = JenisSurat::with('mediaFiles')->findOrFail($id);

        // Karena sudah ada accessor di Model, syarat_json otomatis jadi array
        $syaratArray = $jenisSurat->syarat_json;

        // Hitung statistik permohonan
        $totalPermohonan = $jenisSurat->permohonanSurat->count() ?? 0;
        $permohonanSelesai = $jenisSurat->permohonanSurat->where('status', 'selesai')->count() ?? 0;

        // ✅ TAMBAHKAN INI: Ambil media files dan beri alias sebagai templateFiles
        $templateFiles = $jenisSurat->mediaFiles ?? collect();

        return view('pages.jenis_surat.show', compact(
            'jenisSurat',
            'syaratArray',
            'totalPermohonan',
            'permohonanSelesai',
            'templateFiles'
        ));
    }

    /**
     * Form tambah jenis surat.
     */
    public function create()
    {
        $user = Auth::user();

        // Hanya admin yang bisa buat jenis surat
        if (!$user->isAdmin()) {
            return abort(403, 'Hanya admin yang dapat menambah jenis surat.');
        }

        return view('pages.jenis_surat.create');
    }

    /**
     * Simpan data jenis surat baru DENGAN UPLOAD FILE.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // Hanya admin yang bisa buat jenis surat
        if (!$user->isAdmin()) {
            return abort(403, 'Hanya admin yang dapat menambah jenis surat.');
        }

        $validated = $request->validate([
            'kode' => 'required|unique:jenis_surat,kode|max:20',
            'nama_jenis' => 'required|string|max:100',
            'syarat_json' => 'nullable|array', // Terima sebagai array
            'template_files.*' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
            'captions.*' => 'nullable|string|max:255',
        ]);

        // Simpan jenis surat - syarat_json otomatis diencode oleh mutator di Model
        $jenisSurat = JenisSurat::create([
            'kode' => $validated['kode'],
            'nama_jenis' => $validated['nama_jenis'],
            'syarat_json' => $validated['syarat_json'] ?? [],
        ]);

        // Upload file template jika ada
        if ($request->hasFile('template_files')) {
            foreach ($request->file('template_files') as $index => $file) {
                $caption = $request->captions[$index] ?? 'Template ' . $jenisSurat->nama_jenis;

                // Generate unique filename
                $filename = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();

                // Store file (public/uploads/jenis_surat/)
                $path = $file->storeAs('public/uploads/jenis_surat', $filename);

                // Save to media table
                Media::create([
                    'file_name' => $filename,
                    'original_name' => $file->getClientOriginalName(),
                    'mime_type' => $file->getMimeType(),
                    'size' => $file->getSize(),
                    'path' => str_replace('public/', '', $path),
                    'caption' => $caption,
                    'ref_table' => 'jenis_surat',
                    'ref_id' => $jenisSurat->jenis_id,
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()->route('jenis_surat.index')->with('success', 'Jenis surat berhasil ditambahkan!');
    }

    /**
     * Form edit jenis surat.
     */
    public function edit($id)
    {
        $user = Auth::user();

        // Hanya admin yang bisa edit jenis surat
        if (!$user->isAdmin()) {
            return abort(403, 'Hanya admin yang dapat mengedit jenis surat.');
        }

        $jenisSurat = JenisSurat::with('mediaFiles')->findOrFail($id);
        return view('pages.jenis_surat.edit', compact('jenisSurat'));
    }

    /**
     * Update jenis surat DENGAN UPLOAD/HAPUS FILE.
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();

        // Hanya admin yang bisa update jenis surat
        if (!$user->isAdmin()) {
            return abort(403, 'Hanya admin yang dapat mengupdate jenis surat.');
        }

        $jenisSurat = JenisSurat::findOrFail($id);

        $validated = $request->validate([
            'kode' => 'required|max:20|unique:jenis_surat,kode,' . $jenisSurat->jenis_id . ',jenis_id',
            'nama_jenis' => 'required|string|max:100',
            'syarat_json' => 'nullable|array', // Tetap sebagai array
            'template_files.*' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
            'captions.*' => 'nullable|string|max:255',
            'delete_files' => 'nullable|array',
        ]);

        // Update data utama - syarat_json otomatis diencode oleh mutator
        $jenisSurat->update([
            'kode' => $validated['kode'],
            'nama_jenis' => $validated['nama_jenis'],
            'syarat_json' => $validated['syarat_json'] ?? [],
        ]);

        // Hapus file yang dipilih
        if ($request->has('delete_files')) {
            foreach ($request->delete_files as $mediaId) {
                $media = Media::find($mediaId);
                if ($media) {
                    // Hapus file dari storage
                    Storage::delete('public/' . $media->path);
                    $media->delete();
                }
            }
        }

        // Upload file template baru
        if ($request->hasFile('template_files')) {
            foreach ($request->file('template_files') as $index => $file) {
                $caption = $request->captions[$index] ?? 'Template ' . $jenisSurat->nama_jenis;

                $filename = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('public/uploads/jenis_surat', $filename);

                Media::create([
                    'file_name' => $filename,
                    'original_name' => $file->getClientOriginalName(),
                    'mime_type' => $file->getMimeType(),
                    'size' => $file->getSize(),
                    'path' => str_replace('public/', '', $path),
                    'caption' => $caption,
                    'ref_table' => 'jenis_surat',
                    'ref_id' => $jenisSurat->jenis_id,
                    'sort_order' => $jenisSurat->mediaFiles()->count() + $index,
                ]);
            }
        }

        return redirect()->route('jenis_surat.index')->with('success', 'Jenis surat berhasil diperbarui!');
    }

    /**
     * Hapus jenis surat BESERTA FILE TEMPLATE.
     */
    public function destroy($id)
    {
        $user = Auth::user();

        // Hanya admin yang bisa hapus jenis surat
        if (!$user->isAdmin()) {
            return abort(403, 'Hanya admin yang dapat menghapus jenis surat.');
        }

        $jenisSurat = JenisSurat::with('mediaFiles')->findOrFail($id);

        // Cek apakah ada permohonan yang menggunakan jenis surat ini
        if ($jenisSurat->permohonanSurat()->count() > 0) {
            return redirect()->route('jenis_surat.index')
                ->with('error', 'Jenis surat tidak dapat dihapus karena masih digunakan dalam permohonan.');
        }

        // Hapus file template terlebih dahulu
        foreach ($jenisSurat->mediaFiles as $media) {
            Storage::delete('public/' . $media->path);
            $media->delete();
        }

        // Hapus jenis surat
        $jenisSurat->delete();

        return redirect()->route('jenis_surat.index')->with('success', 'Jenis surat berhasil dihapus!');
    }

    /**
     * Download file template
     */
    public function downloadTemplate($id)
    {
        // Semua role bisa download template
        $media = Media::findOrFail($id);
        $filePath = storage_path('app/public/' . $media->path);

        if (!file_exists($filePath)) {
            abort(404);
        }

        return response()->download($filePath, $media->original_name);
    }
}
