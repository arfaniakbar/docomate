<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Evidence;
use App\Models\User;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpWord\SimpleType\Jc;

class LaporanController extends Controller
{
    /**
     * Menampilkan halaman laporan admin
     */
    public function index(Request $request)
    {
        $karyawanList = User::where('role', 'karyawan')->orderBy('name')->get();

        $query = Evidence::with('user')->where('status', 'approved');

        $selectedMonthYear = $request->input('month_year');
        $selectedUserId = $request->input('user_id');
        $selectedMonth = null;
        $selectedYear = null;

        if ($selectedMonthYear) {
            list($selectedMonth, $selectedYear) = explode('-', $selectedMonthYear);
            $query->whereMonth('updated_at', $selectedMonth)
                ->whereYear('updated_at', $selectedYear);
        }

        if ($selectedUserId) {
            $query->where('user_id', $selectedUserId);
        }

        $approvedEvidences = $query->latest('updated_at')->get();

        $availableFilters = Evidence::select(
            DB::raw('YEAR(updated_at) as year'),
            DB::raw('MONTH(updated_at) as month')
        )
            ->where('status', 'approved')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        return view('admin.laporan.index', compact(
            'approvedEvidences',
            'availableFilters',
            'selectedMonth',
            'selectedYear',
            'karyawanList',
            'selectedUserId'
        ));
    }

    /**
     * Generate laporan
     */
    public function generate(Request $request)
    {
        $request->validate([
            'evidence_ids' => 'required|array|min:1',
            'evidence_ids.*' => 'exists:evidences,id',
            'format' => 'required|in:word,pdf'
        ], [
            'evidence_ids.required' => 'Mohon pilih minimal satu evidence untuk digenerate.'
        ]);

        $evidenceIds = $request->input('evidence_ids');
        $evidences = Evidence::with('user')->whereIn('id', $evidenceIds)->get();
        $format = $request->input('format');

        try {
            if ($format === 'word') {
                return $this->generateWord($evidences);
            }

            if ($format === 'pdf') {
                return $this->generatePdf($evidences);
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal membuat laporan: ' . $e->getMessage());
        }
    }

    /**
     * Generate Word (docx)
     */
    private function generateWord($evidences)
    {
        // Tingkatkan memory limit dan waktu eksekusi
        ini_set('memory_limit', '1024M');
        set_time_limit(300);
        
        $phpWord = new PhpWord();
        $phpWord->setDefaultFontName('Arial');
        $phpWord->setDefaultFontSize(11);

        foreach ($evidences as $evidence) {
            $filesData = $this->normalizeFilesData($evidence->file_path);
            
            // Batasi 6 foto per halaman
            $imageChunks = array_chunk($filesData, 6);

            foreach ($imageChunks as $chunkIndex => $pageImages) {
                $section = $phpWord->addSection([
                    'marginTop' => 600,
                    'marginBottom' => 600,
                    'marginLeft' => 600,
                    'marginRight' => 600
                ]);

                // Header Logo - di setiap halaman
                $header = $section->addHeader();
                $headerTable = $header->addTable(['alignment' => Jc::CENTER]);
                $headerTable->addRow();
                
                // Logo kiri (Telkom Akses)
                $cellLeft = $headerTable->addCell(4500);
                if (file_exists(public_path('images/logo-kiri.png'))) {
                    $cellLeft->addImage(public_path('images/logo-kiri.png'), [
                        'height' => 40, 
                        'alignment' => Jc::START
                    ]);
                }
                
                // Logo kanan (Telkom Indonesia)
                $cellRight = $headerTable->addCell(4500);
                if (file_exists(public_path('images/logo-kanan.png'))) {
                    $cellRight->addImage(public_path('images/logo-kanan.png'), [
                        'height' => 50,
                        'alignment' => Jc::END
                    ]);
                }

                // Title
                $section->addTextBreak(1.0);
                $section->addText(
                    'EVIDENCE PEKERJAAN',
                    ['bold' => true, 'size' => 14, 'underline' => 'single'],
                    ['alignment' => Jc::CENTER, 'spaceAfter' => 0]
                );
                $section->addTextBreak(1.5);

                // Info Project - pakai TABEL tanpa border
                $infoTableStyle = [
                    'borderSize' => 0,
                    'borderColor' => 'FFFFFF',
                    'cellMargin' => 0,
                    'alignment' => Jc::START
                ];
                
                $cellStyle = [
                    'borderSize' => 0,
                    'borderColor' => 'FFFFFF',
                    'valign' => 'top'
                ];
                
                $infoTable = $section->addTable($infoTableStyle);
                
                // PROYEK
                $infoTable->addRow();
                $infoTable->addCell(1800, $cellStyle)->addText('PROYEK', ['bold' => true, 'size' => 10]);
                $infoTable->addCell(200, $cellStyle)->addText(':', ['size' => 10]);
                $cell = $infoTable->addCell(7000, $cellStyle);
                $cell->addText('PENGADAAN PEKERJAAN OUTSIDE PLANT FIBER TO THE HOME', ['size' => 10]);
                $cell->addText('(OSP - FTTH) TAHUN 2026 TELKOM REGIONAL IV KALIMANTAN', ['size' => 10]);
                
                // KONTRAK
                $infoTable->addRow();
                $infoTable->addCell(1800, $cellStyle)->addText('KONTRAK', ['bold' => true, 'size' => 10]);
                $infoTable->addCell(200, $cellStyle)->addText(':', ['size' => 10]);
                $infoTable->addCell(7000, $cellStyle)->addText('', ['size' => 10]);
                
                // AREA
                $infoTable->addRow();
                $infoTable->addCell(1800, $cellStyle)->addText('AREA', ['bold' => true, 'size' => 10]);
                $infoTable->addCell(200, $cellStyle)->addText(':', ['size' => 10]);
                $infoTable->addCell(7000, $cellStyle)->addText('BANJARMASIN', ['size' => 10]);
                
                // LOKASI
                $infoTable->addRow();
                $infoTable->addCell(1800, $cellStyle)->addText('LOKASI', ['bold' => true, 'size' => 10]);
                $infoTable->addCell(200, $cellStyle)->addText(':', ['size' => 10]);
                $infoTable->addCell(7000, $cellStyle)->addText($evidence->lokasi ?? '-', ['size' => 10]);
                
                // PELAKSANA
                $infoTable->addRow();
                $infoTable->addCell(1800, $cellStyle)->addText('PELAKSANA', ['bold' => true, 'size' => 10]);
                $infoTable->addCell(200, $cellStyle)->addText(':', ['size' => 10]);
                $infoTable->addCell(7000, $cellStyle)->addText('PT. TELKOM AKSES', ['size' => 10]);

                $section->addTextBreak(0.5);

                // Tabel Gambar - 6 foto (3 kolom x 2 baris) dalam SATU tabel
                $imageTable = $section->addTable([
                    'borderSize' => 6,
                    'borderColor' => '000000',
                    'cellMargin' => 40,
                    'alignment' => Jc::START,
                    'width' => 10650,
                    'unit' => 'dxa'
                ]);

                $imageRows = array_chunk($pageImages, 3);
                
                foreach ($imageRows as $row) {
                    // Row gambar
                    $imageTable->addRow();
                    foreach ($row as $fileData) {
                        $cell = $imageTable->addCell(3550, ['valign' => 'center']);
                        $safePath = ltrim($fileData['path'], '/');
                        $fullPath = storage_path('app/public/' . $safePath);

                        if (file_exists($fullPath)) {
                            $fileSize = filesize($fullPath);
                            if ($fileSize <= 5 * 1024 * 1024) {
                                list($width, $height) = getimagesize($fullPath);
                                $ratio = $width / $height;
                                
                                // Ukuran lebih kecil agar muat 1 halaman
                                $maxWidth = 120;
                                $maxHeight = 160;

                                if ($ratio < 1) { // Portrait
                                    $newHeight = $maxHeight;
                                    $newWidth = $newHeight * $ratio;
                                    if ($newWidth > $maxWidth) {
                                        $newWidth = $maxWidth;
                                        $newHeight = $newWidth / $ratio;
                                    }
                                } else { // Landscape
                                    $newWidth = $maxWidth;
                                    $newHeight = $newWidth / $ratio;
                                }

                                $cell->addImage($fullPath, [
                                    'width' => $newWidth,
                                    'height' => $newHeight,
                                    'alignment' => Jc::CENTER
                                ]);
                            }
                        }
                    }
                    
                    // Isi cell kosong jika baris tidak penuh
                    for ($i = count($row); $i < 3; $i++) {
                        $imageTable->addCell(3550);
                    }

                    // Row caption
                    $imageTable->addRow();
                    foreach ($row as $fileData) {
                        $imageTable->addCell(3550, ['valign' => 'center'])->addText(
                            $fileData['caption'] ?? '',
                            ['size' => 8],
                            ['alignment' => Jc::CENTER]
                        );
                    }
                    
                    // Isi cell caption kosong jika baris tidak penuh
                    for ($i = count($row); $i < 3; $i++) {
                        $imageTable->addCell(3550);
                    }
                }
            }
            
            // Bersihkan memori setelah setiap evidence
            unset($filesData, $imageChunks);
            gc_collect_cycles();
        }

        $fileName = 'Laporan-Evidence-' . now()->format('d-m-Y') . '.docx';
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save(storage_path($fileName));

        return response()->download(storage_path($fileName))->deleteFileAfterSend(true);
    }

    /**
     * Generate PDF
     */
    private function generatePdf($evidences)
    {
        // Tingkatkan memory limit dan waktu eksekusi
        ini_set('memory_limit', '1024M');
        set_time_limit(300);

        $logoAksesBase64 = file_exists(public_path('images/logo-kiri.png'))
            ? 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('images/logo-kiri.png')))
            : null;

        $logoIndonesiaBase64 = file_exists(public_path('images/logo-kanan.png'))
            ? 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('images/logo-kanan.png')))
            : null;

        // Normalisasi file evidence menjadi Base64 DAN pecah per 6 foto
        $processedEvidences = [];
        foreach ($evidences as $evidence) {
            $normalizedFiles = [];
            if (is_array($evidence->file_path)) {
                foreach ($evidence->file_path as $file) {
                    $path = is_array($file) ? $file['path'] : $file;
                    $caption = is_array($file) && isset($file['caption']) ? $file['caption'] : '';

                    $safePath = ltrim($path, '/');
                    $fullPath = storage_path('app/public/' . $safePath);

                    if (file_exists($fullPath)) {
                        // Cek ukuran file untuk menghindari file terlalu besar
                        $fileSize = filesize($fullPath);
                        if ($fileSize > 5 * 1024 * 1024) { // Skip file > 5MB
                            continue;
                        }

                        $ext = strtolower(pathinfo($fullPath, PATHINFO_EXTENSION));
                        
                        // Baca file dan encode
                        $imageData = file_get_contents($fullPath);
                        $base64 = base64_encode($imageData);
                        
                        $normalizedFiles[] = [
                            'base64' => 'data:image/' . $ext . ';base64,' . $base64,
                            'caption' => $caption
                        ];
                        
                        // Bersihkan variabel untuk menghemat memori
                        unset($imageData, $base64);
                    }
                }
            }

            // Pecah menjadi page (maksimal 6 foto per page)
            if (count($normalizedFiles) > 0) {
                $pages = array_chunk($normalizedFiles, 6);
                foreach ($pages as $pageIndex => $pageFiles) {
                    $processedEvidences[] = [
                        'lokasi' => $evidence->lokasi,
                        'file_path' => $pageFiles,
                        'is_first_page' => ($pageIndex === 0) ? true : false // Untuk info project
                    ];
                }
            } else {
                // Jika tidak ada gambar, tetap tampilkan info
                $processedEvidences[] = [
                    'lokasi' => $evidence->lokasi,
                    'file_path' => [],
                    'is_first_page' => true
                ];
            }
            
            // Bersihkan memori setelah setiap evidence
            unset($normalizedFiles);
            gc_collect_cycles();
        }

        $data = [
            'evidences' => $processedEvidences,
            'logoAksesBase64' => $logoAksesBase64,
            'logoIndonesiaBase64' => $logoIndonesiaBase64
        ];

        $pdf = Pdf::loadView('admin.laporan.pdf_template', $data)
            ->setPaper('A4', 'portrait')
            ->setOption([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
                'dpi' => 96, // Kurangi DPI untuk menghemat memori
                'defaultFont' => 'sans-serif',
            ]);

        $fileName = 'Laporan-Evidence-' . now()->format('d-m-Y') . '.pdf';
        
        // Bersihkan memori sebelum generate PDF
        unset($processedEvidences, $data);
        gc_collect_cycles();
        
        return $pdf->download($fileName);
    }

    /**
     * Normalisasi file evidence
     */
    private function normalizeFilesData($files)
    {
        if (!is_array($files)) {
            return [];
        }

        $normalized = [];
        foreach ($files as $file) {
            if (is_array($file) && isset($file['path'])) {
                $normalized[] = ['path' => $file['path'], 'caption' => $file['caption'] ?? ''];
            } elseif (is_string($file)) {
                $normalized[] = ['path' => $file, 'caption' => ''];
            }
        }
        return $normalized;
    }
}