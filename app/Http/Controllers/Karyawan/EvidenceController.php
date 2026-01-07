<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Evidence;
use App\Models\GlobalModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Pangwas;
use App\Models\Tematik;
use App\Models\PurchaseOrder;

class EvidenceController extends Controller
{
    /**
     * Menampilkan halaman riwayat evidence milik karyawan.
     */
    public function index(Request $request)
    {
        if ($request->has('upload_success')) {
            session()->flash('success', 'Berhasil mengupload ' . $request->upload_success . ' foto evidence baru.');
        }

        $evidences = Evidence::where('user_id', Auth::id())->latest()->paginate(10);
        return view('karyawan.evidence.index', compact('evidences'));
    }

    /**
     * Menampilkan form untuk membuat evidence baru.
     */
    public function create()
    {
        // 1. Dapatkan semua ID PO yang sudah berstatus 'approved' (done).
        //    PENTING: Kita konversi ID PO menjadi INTEGER untuk memastikan filter whereNotIn bekerja.
        $donePoIds = Evidence::where('status', 'approved')
            ->pluck('po_id')
            ->unique()
            ->map(fn($id) => (int) $id) // 🔥 KONVERSI KE INTEGER
            ->toArray();

        // 2. Filter: Ambil PO dari Master Data yang ID-nya TIDAK ADA di daftar PO yang sudah Selesai.
        $po_list = PurchaseOrder::whereNotIn('id', $donePoIds)
            ->orderBy('no_po', 'asc')
            ->get();

        // 3. Ambil master data lain (Pangwas & Tematik)
        $pangwas_list = Pangwas::latest()->get();
        $tematik_list = Tematik::orderBy('nama_tematik', 'asc')->get();

        return view('karyawan.evidence.create', compact('pangwas_list', 'tematik_list', 'po_list'));
    }

    /**
     * Menyimpan evidence baru.
     */
    public function store(Request $request)
    {
        // 1. Validasi Metadata untuk Inisialisasi (Step 1)
        // Jika ada flag 'is_init', berarti kita buat data evidence dulu tanpa file
        if ($request->boolean('is_init')) {
            $request->validate([
                'lokasi' => ['required', 'string', 'max:255'],
                'deskripsi' => ['nullable', 'string'],
                'pangwas_id' => ['required', 'integer', 'exists:pangwas,id'],
                'tematik_id' => ['required', 'integer', 'exists:tematik,id'],
                'po_id' => ['required', 'integer', 'exists:purchase_order,id'],
            ]);

            try {
                // Masukkan data project (sesuai logic asli file ini)
                $id_project = GlobalModel::insertRecord('project', [
                    'lokasi' => $request->lokasi,
                    'deskripsi' => $request->deskripsi
                ]);

                $evidence = Evidence::create([
                    'user_id' => auth()->id(),
                    'project_id' => $id_project,
                    'lokasi' => $request->lokasi,
                    'deskripsi' => $request->deskripsi,
                    'file_path' => [], // Mulai dengan array kosong
                    'status' => 'pending',
                    'pangwas_id' => $request->pangwas_id,
                    'tematik_id' => $request->tematik_id,
                    'po_id' => $request->po_id,
                ]);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Evidence initialized',
                    'evidence_id' => $evidence->id
                ]);
            } catch (\Exception $e) {
                return response()->json(['message' => 'Gagal membuat data: ' . $e->getMessage()], 500);
            }
        }

        // 2. Validasi Upload File (Step 2 - Append)
        $request->validate([
            'evidence_id' => ['required', 'exists:evidences,id'],
            'file' => ['required', 'array', 'min:1'],
            'file.*' => ['image', 'mimes:jpeg,jpg,png'],
            'caption' => ['nullable', 'array'],
        ]);

        try {
            $evidence = Evidence::find($request->evidence_id);

            if ($evidence->user_id !== auth()->id()) {
                return response()->json(['message' => 'Unauthorized'], 403);
            }

            $fileData = [];

            // Logic simpan file (sama seperti asli)
            if ($request->hasFile('file')) {
                foreach ($request->file('file') as $index => $file) {
                    $originalName = $file->getClientOriginalName();
                    // Gunakan project_id dari evidence yang sudah ada
                    $path = $file->storeAs(
                        'evidences/' . $evidence->project_id,
                        $originalName,
                        'public'
                    );

                    // Caption logic
                    $captionStr = isset($request->caption[$index]) ? $request->caption[$index] : $originalName;

                    $fileData[] = [
                        'path' => $path,
                        'caption' => $captionStr
                    ];
                }
            }

            // Gabungkan (Append)
            $currentFiles = $evidence->file_path ?? [];
            if (!is_array($currentFiles))
                $currentFiles = [];

            $updatedFiles = array_merge($currentFiles, $fileData);

            $evidence->update([
                'file_path' => $updatedFiles
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Files uploaded',
                'evidence_id' => $evidence->id
            ]);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal menyimpan data: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Menampilkan form untuk mengedit evidence.
     */
    public function edit(Evidence $evidence)
    {
        // Debugging Step 2: Test Data Fetching
        try {
            $pangwas_list = Pangwas::latest()->get();
            $tematik_list = Tematik::orderBy('nama_tematik', 'asc')->get();
            $po_list = PurchaseOrder::orderBy('no_po', 'asc')->get();

            return "Data Fetching OK. Pangwas: " . $pangwas_list->count() . ", Tematik: " . $tematik_list->count() . ", PO: " . $po_list->count();
        } catch (\Exception $e) {
             return "Data Fetching FAILED: " . $e->getMessage();
        }

        /*
        return view('karyawan.evidence.edit', compact('evidence', 'pangwas_list', 'tematik_list', 'po_list'));
        */
    }

    /**
     * Memperbarui data evidence di database.
     * 🔥 UPDATED: Support delete individual files + upload new files
     */
    public function update(Request $request, Evidence $evidence)
    {
        if ($evidence->user_id !== Auth::id()) {
            abort(403, 'AKSES DITOLAK.');
        }

        // Validasi
        $request->validate([
            'lokasi' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'file' => ['nullable', 'array'],  // File baru dari Dropzone (opsional)
            'file.*' => ['image', 'mimes:jpeg,jpg,png', 'max:2048'],
            'deleted_files' => ['nullable', 'string'], // JSON string dari frontend

            // Master data (wajib)
            'pangwas_id' => ['required', 'integer', 'exists:pangwas,id'],
            'tematik_id' => ['required', 'integer', 'exists:tematik,id'],
            'po_id' => ['required', 'integer', 'exists:purchase_order,id'],
        ]);

        try {
            $fileData = $evidence->file_path ?? []; // Ambil file lama

            // 1. PROSES PENGHAPUSAN FILE LAMA
            if ($request->filled('deleted_files')) {
                $deletedIndexes = json_decode($request->deleted_files, true);

                if (is_array($deletedIndexes) && count($deletedIndexes) > 0) {
                    foreach ($deletedIndexes as $index) {
                        // Hapus file dari storage
                        if (isset($fileData[$index]['path'])) {
                            Storage::disk('public')->delete($fileData[$index]['path']);
                        }

                        // Tandai untuk dihapus dari array
                        unset($fileData[$index]);
                    }

                    // Re-index array (hilangkan gap index)
                    $fileData = array_values($fileData);
                }
            }

            // 2. PROSES UPLOAD FILE BARU
            if ($request->hasFile('file')) {
                $filePaths = $request->input('file_paths', []); // Ambil custom path dari frontend

                foreach ($request->file('file') as $index => $file) {
                    // Gunakan path dari frontend (termasuk folder) atau fallback ke nama file asli
                    $customPath = $filePaths[$index] ?? $file->getClientOriginalName();

                    // Pisahkan folder dan filename
                    $pathInfo = pathinfo($customPath);
                    $directory = isset($pathInfo['dirname']) && $pathInfo['dirname'] !== '.'
                        ? $pathInfo['dirname']
                        : '';
                    $filename = $pathInfo['basename'];

                    // Tentukan path penyimpanan
                    $storagePath = 'evidences/' . $evidence->project_id;
                    if (!empty($directory)) {
                        $storagePath .= '/' . $directory;
                    }

                    // Simpan file dengan struktur folder yang dipertahankan
                    $path = $file->storeAs($storagePath, $filename, 'public');

                    $fileData[] = [
                        'path' => $path,
                        'caption' => $customPath // Simpan path lengkap sebagai caption
                    ];
                }
            }

            // 3. UPDATE EVIDENCE
            $evidence->update([
                'lokasi' => $request->lokasi,
                'deskripsi' => $request->deskripsi,
                'file_path' => $fileData,
                'status' => 'pending', // Reset status jadi pending lagi

                // Update master data
                'pangwas_id' => $request->pangwas_id,
                'tematik_id' => $request->tematik_id,
                'po_id' => $request->po_id,
            ]);

            // Cek apakah request dari AJAX/Dropzone
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Evidence berhasil diperbarui! Total ' . count($fileData) . ' foto.',
                    'redirect' => route('karyawan.evidence.index')
                ], 200);
            }

            // Redirect dengan flash message
            return redirect()
                ->route('karyawan.evidence.index')
                ->with('success', 'Evidence berhasil diperbarui! Total ' . count($fileData) . ' foto.');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui evidence: ' . $e->getMessage());
        }
    }

    /**
     * Menghapus evidence.
     */
    public function destroy(Evidence $evidence)
    {
        if ($evidence->user_id !== Auth::id()) {
            abort(403, 'AKSES DITOLAK.');
        }

        // Hapus semua file yang terkait
        if (is_array($evidence->file_path)) {
            foreach ($evidence->file_path as $file) {
                if (is_array($file) && isset($file['path'])) {
                    Storage::disk('public')->delete($file['path']);
                }
            }
        }

        $evidence->delete();

        return redirect()->route('karyawan.evidence.index')->with('success', 'Evidence berhasil dihapus.');
    }
}