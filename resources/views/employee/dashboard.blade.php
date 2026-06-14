<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Karyawan - UpSkill</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    
    <nav class="navbar navbar-expand-md navbar-dark bg-primary mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">UpSkill Karyawan</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarKaryawan">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarKaryawan">
                <div class="d-flex flex-column flex-md-row align-items-md-center gap-3 mt-3 mt-md-0">
                    <span class="navbar-text text-white fw-medium">Halo, {{ auth()->user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger w-100">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mb-5">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow-sm mb-4 border-0">
            <div class="card-body text-center py-4 py-md-5 px-3">
                <h4 class="mb-3 fw-bold">Analisis Kebutuhan Pelatihan</h4>
                <p class="text-muted mb-4">Silakan isi kuesioner agar sistem dapat mendiagnosa jenis pelatihan yang paling Anda butuhkan untuk peningkatan karir.</p>
                <a href="{{ url('/employee/questionnaire') }}" class="btn btn-primary btn-lg px-4 px-md-5 w-100 w-md-auto">Isi Kuesioner Sekarang</a>
            </div>
        </div>

        <h5 class="mb-3 fw-bold">Riwayat Pengajuan Pelatihan</h5>
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 text-nowrap">
                        <thead class="table-light">
                            <tr>
                                <th class="px-3">Tanggal Tes</th>
                                <th>Rekomendasi Pelatihan</th>
                                <th>Status SPV</th>
                                <th class="px-3">Catatan SPV</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($results as $res)
                            <tr>
                                <td class="px-3">{{ $res->created_at->format('d M Y, H:i') }}</td>
                                <td class="fw-bold text-primary">{{ $res->recommended_training }}</td>
                                <td>
                                    @if($res->status == 'pending') <span class="badge bg-warning text-dark">Menunggu Review</span> @endif
                                    @if($res->status == 'approved') <span class="badge bg-success">Disetujui</span> @endif
                                    @if($res->status == 'rejected') <span class="badge bg-danger">Ditolak/Revisi</span> @endif
                                </td>
                                <td class="px-3">{{ $res->spv_notes ?? '-' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">Belum ada riwayat kuesioner.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>