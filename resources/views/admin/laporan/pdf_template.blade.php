<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Evidence</title>
    <style>
        @page {
            margin: 40px;
        }
        body { 
            font-family: 'Helvetica', 'Arial', sans-serif; 
            font-size: 11pt; 
            margin: 0;
            padding: 0;
            color: #000;
        }
        .header { 
            width: 100%; 
            margin-bottom: 30px;
            border-collapse: collapse;
        }
        .header td { 
            vertical-align: middle; 
        }
        .title { 
            text-align: center; 
            font-weight: bold; 
            font-size: 14pt; 
            margin-bottom: 25px; 
            text-decoration: underline; 
        }
        .info { 
            width: 100%; 
            margin-bottom: 25px; 
            border-collapse: collapse; 
        }
        .info td { 
            padding: 3px 0; 
            vertical-align: top; 
            line-height: 1.4;
        }
        .info .label { 
            width: 110px; 
            font-weight: bold; 
        }
        .info .separator { 
            width: 20px; 
            text-align: center; 
        }
        .info .value { 
            width: auto; 
        }
        .evidence-table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-bottom: 30px; 
        }
        .evidence-table td { 
            border: 1px solid #000; 
            text-align: center; 
            padding: 8px; 
            vertical-align: top; 
        }
        .caption { 
            font-size: 9pt; 
            margin-top: 5px; 
        }
        .page-break { 
            page-break-after: always; 
        }
    </style>
</head>
<body>
@foreach($evidences as $index => $evidenceData)
    {{-- Header muncul di setiap halaman --}}
    <table class="header">
        <tr>
            <td style="width: 50%; text-align: left;">
                @if($logoAksesBase64)
                    <img src="{{ $logoAksesBase64 }}" alt="Logo Akses" style="height: 50px;">
                @endif
            </td>
            <td style="width: 50%; text-align: right;">
                @if($logoIndonesiaBase64)
                    <img src="{{ $logoIndonesiaBase64 }}" alt="Logo Indonesia" style="height: 60px;">
                @endif
            </td>
        </tr>
    </table>

    <div class="title">EVIDENCE PEKERJAAN</div>

    {{-- Info project - tampil di semua halaman untuk testing --}}
    <table class="info">
        <tr>
            <td class="label">PROYEK</td>
            <td class="separator">:</td>
            <td class="value">
                PENGADAAN PEKERJAAN OUTSIDE PLANT FIBER TO THE HOME (OSP - FTTH) TAHUN 2026 TELKOM REGIONAL IV KALIMANTAN
            </td>
        </tr>
        <tr><td class="label">KONTRAK</td><td class="separator">:</td><td class="value"></td></tr>
        <tr><td class="label">AREA</td><td class="separator">:</td><td class="value">BANJARMASIN</td></tr>
        <tr><td class="label">LOKASI</td><td class="separator">:</td><td class="value">{{ $evidenceData['lokasi'] ?? '-' }}</td></tr>
        <tr><td class="label">PELAKSANA</td><td class="separator">:</td><td class="value">PT. TELKOM AKSES</td></tr>
    </table>

    {{-- Tabel gambar (maksimal 6 foto, 3 kolom x 2 baris) --}}
    <table class="evidence-table">
        @foreach(array_chunk($evidenceData['file_path'], 3) as $chunk)
            <tr>
                @foreach($chunk as $fileData)
                    <td>
                        @if(!empty($fileData['base64']))
                            <img src="{{ $fileData['base64'] }}" style="width: 180px; height: auto;">
                        @endif
                    </td>
                @endforeach
                @for($i = count($chunk); $i < 3; $i++)
                    <td></td>
                @endfor
            </tr>
            <tr>
                @foreach($chunk as $fileData)
                    <td class="caption">{{ $fileData['caption'] ?? '' }}</td>
                @endforeach
                @for($i = count($chunk); $i < 3; $i++)
                    <td></td>
                @endfor
            </tr>
        @endforeach
    </table>

    {{-- Page break kecuali halaman terakhir --}}
    @if($index < count($evidences) - 1)
        <div class="page-break"></div>
    @endif
@endforeach
</body>
</html>