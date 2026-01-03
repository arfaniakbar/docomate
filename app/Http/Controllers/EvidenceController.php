<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Evidence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EvidenceController extends Controller
{
    public function index()
    {
        $evidences = Evidence::where('user_id', Auth::id())->latest()->paginate(10);
        return view('karyawan.evidence.index', compact('evidences'));
    }

    public function create()
    {
        return view('karyawan.evidence.create');
    }

    public function store(Request $request)
    {
        // 1. Inisialisasi Data (Langkah Pertama)
        if ($request->boolean('is_init')) {
            $request->validate([
                'lokasi' => ['required', 'string', 'max:255'],
                'pangwas_id' => ['required', 'exists:pangwas,id'],
                'tematik_id' => ['required', 'exists:tematiks,id'],
                'po_id' => ['required', 'exists:purchase_orders,id'],
                'deskripsi' => ['nullable', 'string'],
            ]);

            try {
                $evidence = Evidence::create([
                    'user_id' => Auth::id(),
                    'lokasi' => $request->lokasi,
                    'deskripsi' => $request->deskripsi,
                    'pangwas_id' => $request->pangwas_id,
                    'tematik_id' => $request->tematik_id,
                    'po_id' => $request->po_id,
                    'file_path' => [], 
                    'status' => 'pending',
                ]);

                return response()->json([
                    'status' => 'success',
                    'evidence_id' => $evidence->id
                ]);
            } catch (\Exception $e) {
                return response()->json(['message' => $e->getMessage()], 500);
            }
        }

        // 2. Proses Upload File
        $request->validate([
            'evidence_id' => ['required', 'exists:evidences,id'],
            'file' => ['required', 'array'],
            'file.*' => ['image', 'mimes:jpeg,jpg,png', 'max:6000'],
        ]);

        try {
            $evidence = Evidence::findOrFail($request->evidence_id);

            if ($evidence->user_id !== Auth::id()) {
                return response()->json(['message' => 'Unauthorized'], 403);
            }

            $fileData = [];
            if ($request->hasFile('file')) {
                foreach ($request->file('file') as $index => $file) {
                    $path = $file->store('evidences', 'public');
                    $fileData[] = [
                        'path' => $path,
                        'caption' => $request->caption[$index] ?? $evidence->lokasi
                    ];
                }
            }

            $currentFiles = $evidence->file_path ?? [];
            $evidence->update([
                'file_path' => array_merge($currentFiles, $fileData)
            ]);

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function edit(Evidence $evidence)
    {
        if ($evidence->user_id !== Auth::id()) {
            abort(403);
        }
        return view('karyawan.evidence.edit', compact('evidence'));
    }

    public function update(Request $request, Evidence $evidence)
    {
        if ($evidence->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'lokasi' => ['required', 'string', 'max:255'],
            'files.*' => ['image', 'mimes:jpeg,jpg,png', 'max:2048'],
        ]);

        $files = $evidence->file_path ?? [];

        // Hapus file lama jika ada request
        if ($request->has('deleted_files')) {
            foreach ($request->deleted_files as $pathToDelete) {
                Storage::disk('public')->delete($pathToDelete);
                $files = array_filter($files, fn($file) => $file['path'] !== $pathToDelete);
            }
        }

        // Tambah file baru
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('evidences', 'public');
                $files[] = ['path' => $path, 'caption' => $request->lokasi];
            }
        }

        $evidence->update([
            'lokasi' => $request->lokasi,
            'deskripsi' => $request->deskripsi,
            'file_path' => array_values($files),
            'status' => 'pending',
        ]);

        return redirect()->route('karyawan.evidence.index')->with('success', 'Berhasil diperbarui.');
    }

    public function destroy(Evidence $evidence)
    {
        if ($evidence->user_id !== Auth::id()) {
            abort(403);
        }

        if (is_array($evidence->file_path)) {
            foreach ($evidence->file_path as $file) {
                Storage::disk('public')->delete($file['path']);
            }
        }

        $evidence->delete();
        return redirect()->route('karyawan.evidence.index')->with('success', 'Berhasil dihapus.');
    }
}