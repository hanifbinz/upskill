<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kebutuhan Pelatihan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* CSS Khusus untuk fitur Print */
        @media print {
            .no-print { display: none !important; }
            body { background-color: #fff; }
            .card { border: none !important; box-shadow: none !important; }
        }
    </style>
</head>
<body class="bg-light">

    <div class="container mt-4 mb-5">
        <!-- Tombol Aksi (Tidak akan ikut ter-print) -->
        <div class="d-flex justify-content-between align-items-center mb-4 no-print">
            <a href="{{ url('/spv/dashboard') }}" class="btn btn-secondary">⬅ Kembali ke Dashboard</a>
            <button onclick="window.print()" class="btn btn-primary fw-bold">🖨 Cetak Laporan (PDF)</button>
        </div>

        <div class="card shadow">
            <div class="card-body p-5">
                <div class="text-center mb-5">
                    <h2 class="fw-bold">LAPORAN ANALISIS KEBUTUHAN PELATIHAN (TNA)</h2>
                    <p class="text-muted">Dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }}</p>
                    <hr>
                </div>

                <!-- Bagian 1: Statistik Angka -->
                <h5 class="fw-bold mb-3">A. Ringkasan Pengajuan</h5>
                <div class="row mb-4 text-center">
                    <div class="col-md-3">
                        <div class="p-3 bg-primary text-white rounded">
                            <h3>{{ $stats['total'] }}</h3>
                            <span>Total Pengajuan</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3 bg-success text-white rounded">
                            <h3>{{ $stats['approved'] }}</h3>
                            <span>Disetujui</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3 bg-warning text-dark rounded">
                            <h3>{{ $stats['pending'] }}</h3>
                            <span>Menunggu Review</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3 bg-danger text-white rounded">
                            <h3>{{ $stats['rejected'] }}</h3>
                            <span>Ditolak / Revisi</span>
                        </div>
                    </div>
                </div>

                <!-- Bagian 2: Ranking Pelatihan -->
                <h5 class="fw-bold mb-3">B. Rekapitulasi Jenis Pelatihan Dibutuhkan</h5>
                <table class="table table-bordered mb-5">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Jenis Pelatihan (Rekomendasi Sistem)</th>
                            <th>Jumlah Karyawan Membutuhkan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($training_ranks as $index => $rank)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="fw-bold">{{ $rank->recommended_training }}</td>
                            <td>{{ $rank->total }} Orang</td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="text-center">Belum ada data pelatihan.</td></tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Bagian 3: Tabel Rinci -->
                <h5 class="fw-bold mb-3">C. Rincian Data Karyawan</h5>
                <table class="table table-striped table-bordered text-sm">
                    <thead class="table-dark">
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama Karyawan</th>
                            <th>Rekomendasi Pelatihan</th>
                            <th>Status Akhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($results as $res)
                        <tr>
                            <td>{{ $res->created_at->format('d/m/Y') }}</td>
                            <td>{{ $res->user->name }}</td>
                            <td>{{ $res->recommended_training }}</td>
                            <td>
                                @if($res->status == 'approved') Setuju @endif
                                @if($res->status == 'pending') Pending @endif
                                @if($res->status == 'rejected') Ditolak @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div class="mt-5 text-end no-print">
                    <p>Mengetahui,</p>
                    <br><br><br>
                    <p class="fw-bold text-decoration-underline">{{ auth()->user()->name }}</p>
                    <p>Supervisor / Pimpinan</p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>