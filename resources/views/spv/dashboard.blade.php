<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard SPV - UpSkill</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light text-dark">

    <nav class="navbar navbar-expand-md navbar-light bg-white mb-5 shadow-sm">
        <div class="container py-1">
            <a class="navbar-brand fw-bold text-primary text-uppercase tracking-wide" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-grid-1x2-fill me-1 mb-1" viewBox="0 0 16 16">
                  <path d="M0 1a1 1 0 0 1 1-1h5a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V1zm9 0a1 1 0 0 1 1-1h5a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1h-5a1 1 0 0 1-1-1V1zm0 9a1 1 0 0 1 1-1h5a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1h-5a1 1 0 0 1-1-1v-5z"/>
                </svg>
                Dashboard SPV
            </a>
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSPV">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse justify-content-end" id="navbarSPV">
                <div class="d-flex flex-column flex-md-row align-items-stretch align-items-md-center gap-2 mt-3 mt-md-0">
                    <a href="{{ url('/spv/report') }}" class="btn btn-sm btn-primary fw-bold shadow-sm px-3 py-2">📄 Lihat Laporan</a>
                    <a href="{{ url('/spv/users/create') }}" class="btn btn-sm btn-outline-primary fw-bold px-3 py-2">➕ Tambah User</a>
                    <div class="vr d-none d-md-block mx-1"></div> <form action="{{ route('logout') }}" method="POST" class="d-inline mt-2 mt-md-0">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger fw-bold w-100 px-3 py-2">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mb-5">
        @if(session('success'))
            <div class="alert alert-success shadow-sm border-0 border-start border-4 border-success fw-medium">
                ✅ {{ session('success') }}
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
            <h5 class="fw-bold text-dark mb-0">Review Pengajuan Karyawan</h5>
        </div>

        <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 text-nowrap">
                        <thead class="table-light">
                            <tr>
                                <th class="px-4 py-3 text-secondary">Nama Karyawan</th>
                                <th class="py-3 text-secondary">Rekomendasi Sistem</th>
                                <th class="py-3 text-secondary">Status Keputusan</th>
                                <th class="px-4 py-3 text-secondary">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($results as $res)
                            <tr>
                                <td class="px-4 py-3 fw-bold text-dark">{{ $res->user->name }}</td>
                                <td class="py-3">
                                    <span class="text-primary fw-semibold bg-primary bg-opacity-10 px-2 py-1 rounded">{{ $res->recommended_training }}</span>
                                </td>
                                <td class="py-3">
                                    @if($res->status == 'pending') 
                                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">Menunggu Review</span> 
                                    @endif
                                    @if($res->status == 'approved') 
                                        <span class="badge bg-success px-3 py-2 rounded-pill shadow-sm">Disetujui</span> 
                                    @endif
                                    @if($res->status == 'rejected') 
                                        <span class="badge bg-danger px-3 py-2 rounded-pill shadow-sm">Ditolak / Revisi</span> 
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <a href="{{ url('/spv/review/'.$res->id) }}" class="btn btn-sm btn-primary fw-bold px-4 rounded-pill shadow-sm">Review</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-secondary">
                                    <div class="text-muted mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-inbox" viewBox="0 0 16 16">
                                          <path d="M4.98 4a.5.5 0 0 0-.39.188L1.54 8H6a.5.5 0 0 1 .5.5 1.5 1.5 0 1 0 3 0A.5.5 0 0 1 10 8h4.46l-3.05-3.812A.5.5 0 0 0 11.02 4H4.98zm-1.17-.437A1.5 1.5 0 0 1 4.98 3h6.04a1.5 1.5 0 0 1 1.17.563l3.7 4.625A.5.5 0 0 1 16 8.5V15a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V8.5a.5.5 0 0 1 .158-.35l3.7-4.625zM1 8.5v6h14v-6h-3.46a4.499 4.499 0 0 1-8.08 0H1z"/>
                                        </svg>
                                    </div>
                                    Belum ada pengajuan karyawan saat ini.
                                </td>
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