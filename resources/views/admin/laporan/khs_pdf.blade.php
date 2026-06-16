<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kartu Hasil Studi - {{ $mahasiswa->nim }}</title>
    <style>
        body { 
            font-family: 'Helvetica', 'Arial', sans-serif; 
            color: #1e293b; 
            font-size: 12px; 
            line-height: 1.5; 
        }
        .header { 
            text-align: center; 
            margin-bottom: 25px; 
            border-bottom: 2px solid #0f172a; 
            padding-bottom: 10px; 
        }
        .header h2 { 
            margin: 0; 
            font-size: 18px; 
            color: #0f172a; 
            text-transform: uppercase; 
        }
        .header p { 
            margin: 4px 0 0 0; 
            font-size: 11px; 
            color: #64748b; 
        }
        .meta-table { 
            width: 100%; 
            margin-bottom: 20px; 
            border-collapse: collapse; 
        }
        .meta-table td { 
            padding: 4px 0; 
            vertical-align: top; 
        }
        .data-table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 10px; 
        }
        .data-table th { 
            background: #f1f5f9; 
            border: 1px solid #cbd5e1; 
            padding: 10px; 
            font-size: 11px; 
            font-weight: bold; 
            text-transform: uppercase; 
            text-align: left; 
        }
        .data-table td { 
            border: 1px solid #e2e8f0; 
            padding: 10px; 
            font-size: 11px; 
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        
        /* Layout summary menggunakan standard margin & float yang didukung penuh DomPDF */
        .summary-container {
            width: 100%;
            margin-top: 20px;
        }
        .summary-box { 
            float: right; 
            width: 40%; 
            padding: 12px; 
            background: #f8fafc; 
            border: 1px solid #e2e8f0; 
            border-radius: 8px; 
        }
        .summary-box table { 
            width: 100%; 
        }
        .summary-box td { 
            font-weight: bold; 
            font-size: 12px; 
        }
        .footer-sign { 
            margin-top: 50px; 
            width: 100%; 
            clear: both; 
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>UNIVERSITAS MALIKUSSALEH</h2>
        <h3 style="margin: 3px 0 0 0; font-size: 14px; text-align: center; color: #0f172a; text-transform: uppercase; font-weight: bold;">FAKULTAS TEKNIK - TEKNIK INFORMATIKA</h3>
        <p>Kampus Utama Cot Girek, Lhokseumawe, Aceh - Sistem Informasi SIPAKAD</p>
    </div>

    <h4 style="text-align: center; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 15px; font-weight: bold; color: #0f172a;">KARTU HASIL STUDI (KHS)</h4>

    <table class="meta-table">
        <tr>
            <td style="width: 15%;"><strong>Nama Lengkap</strong></td>
            <td style="width: 2%;">:</td>
            <td style="width: 48%;">{{ $mahasiswa->user->name }}</td>
            <td style="width: 12%;"><strong>Semester</strong></td>
            <td style="width: 2%;">:</td>
            <td style="width: 21%;">Semester {{ $mahasiswa->semester }}</td>
        </tr>
        <tr>
            <td><strong>NIM</strong></td>
            <td>:</td>
            <td style="font-family: monospace;">{{ $mahasiswa->nim }}</td>
            <td><strong>Angkatan</strong></td>
            <td>:</td>
            <td>{{ $mahasiswa->angkatan }}</td>
        </tr>
        <tr>
            <td><strong>Program Studi</strong></td>
            <td>:</td>
            <td colspan="4">{{ $mahasiswa->prodi }}</td>
        </tr>
    </table>

    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 5%;" class="text-center">No</th>
                <th style="width: 20%;">Kode MK</th>
                <th style="width: 45%;">Nama Mata Kuliah</th>
                <th style="width: 10%;" class="text-center">SKS</th>
                <th style="width: 20%;" class="text-center">Nilai Huruf</th>
            </tr>
        </thead>
        <tbody>
            @forelse($nilais as $index => $n)
                <tr>
                    <td class="text-center" style="font-family: monospace;">{{ $index + 1 }}</td>
                    <td style="font-family: monospace;">{{ $n->mataKuliah->kode_mk }}</td>
                    <td><strong>{{ $n->mataKuliah->nama_mk }}</strong></td>
                    <td class="text-center font-mono">{{ $n->mataKuliah->sks }}</td>
                    <td class="text-center" style="font-weight: bold; color: #4f46e5;">{{ $n->nilai_huruf }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center" style="color: #64748b; padding: 20px;">Belum ada komponen nilai akademis yang terekam pada semester ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="summary-container">
        <div class="summary-box">
            <table>
                <tr>
                    <td>Total Kredit SKS</td>
                    <td>:</td>
                    <td class="text-right" style="font-family: monospace;">{{ $totalSks }} SKS</td>
                </tr>
                <tr style="color: #4f46e5;">
                    <td>IPK Sementara</td>
                    <td>:</td>
                    <td class="text-right" style="font-size: 14px; font-family: monospace;">{{ number_format($ipk, 2) }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="footer-sign">
        <table style="width: 100%;">
            <tr>
                <td style="width: 60%;"></td>
                <td class="text-center">
                    <p>Lhokseumawe, {{ date('d M Y') }}</p>
                    <p style="margin-top: 5px; margin-bottom: 50px;">Ketua Jurusan Teknik Informatika</p>
                    <p><strong>___________________________</strong></p>
                    <p style="font-size: 10px; color: #64748b; margin-top: 4px;">NIP. 19820311 200912 1 002</p>
                </td>
            </tr>
        </table>
    </div>

</body>
</html>