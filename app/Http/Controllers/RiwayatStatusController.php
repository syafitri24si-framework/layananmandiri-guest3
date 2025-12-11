<?php
// app/Http/Controllers/RiwayatStatusController.php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\PermohonanSurat;
use App\Models\RiwayatStatusSurat;
use Illuminate\Http\Request;

class RiwayatStatusController extends Controller
{
    public function index(Request $request)
    {
        $query = RiwayatStatusSurat::with(['permohonan.warga', 'permohonan.jenisSurat', 'petugas']);

        // Filter
        if ($request->filled('permohonan_id')) {
            $query->where('permohonan_id', $request->permohonan_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('start_date')) {
            $query->whereDate('waktu', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('waktu', '<=', $request->end_date);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('keterangan', 'like', '%' . $request->search . '%')
                    ->orWhereHas('petugas', function ($q2) use ($request) {
                        $q2->where('nama', 'like', '%' . $request->search . '%');
                    });
            });
        }

        $riwayatData    = $query->orderBy('waktu', 'desc')->paginate(15);
        $permohonanList = PermohonanSurat::with('warga')->get();

        return view('pages.riwayat_status.index', compact('riwayatData', 'permohonanList'));
    }

    public function upload(Request $request, $id)
    {
        $request->validate([
            'files'   => 'required|array',
            'files.*' => 'file|max:5120',
            'caption' => 'nullable|string|max:255',
        ]);

        foreach ($request->file('files') as $file) {
            $fileName = time() . '_' . $file->getClientOriginalName();

            $uploadPath = public_path('uploads/riwayat_status');
            if (! file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $file->move($uploadPath, $fileName);

            Media::create([
                'ref_table'  => 'riwayat_status_surat',
                'ref_id'     => $id,
                'file_name'  => $fileName,
                'caption'    => $request->caption,
                'mime_type'  => $file->getMimeType(),
                'sort_order' => 0,
            ]);
        }

        return back()->with('success', 'File berhasil diupload');
    }

    public function show($id)
    {
        $data = RiwayatStatusSurat::with([
            'permohonan.warga',
            'permohonan.jenisSurat',
            'petugas',
            'mediaFiles',
        ])->findOrFail($id);

        return view('pages.riwayat_status.show', compact('data'));
    }

}
