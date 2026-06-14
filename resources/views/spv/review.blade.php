<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Pelatihan - UpSkill</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light text-dark">

    <div class="container mt-4 mt-md-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-7">
                <!-- Card dengan shadow lembut dan sudut membulat modern -->
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body p-4 p-md-5">
                        
                        <!-- Header Modern dengan Ikon -->
                        <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                            <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center me-3 shadow-sm" style="width: 48px; height: 48px;">
                                <!-- Ikon User Check -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                                  <path fill-rule="evenodd" d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                                  <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="mb-0 fw-bold text-dark">Review Pengajuan</h4>
                                <span class="text-primary fw-semibold fs-5">{{ $result->user->name }}</span>
                            </div>
                        </div>
                        
                        <!-- Kotak Callout Analisis Sistem Pakar (Desain Modern) -->
                        <div class="alert alert-primary bg-primary bg-opacity-10 border-0 border-start border-4 border-primary shadow-sm mb-4 rounded-end">
                            <h6 class="alert-heading fw-bold text-primary mb-3">
                                <!-- Ikon Chip/Sistem -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-cpu me-1 pb-1" viewBox="0 0 16 16">
                                  <path d="M5 0a.5.5 0 0 1 .5.5V2h1V.5a.5.5 0 0 1 1 0V2h1V.5a.5.5 0 0 1 1 0V2h1V.5a.5.5 0 0 1 1 0V2A2.5 2.5 0 0 1 14 4.5h1.5a.5.5 0 0 1 0 1H14v1h1.5a.5.5 0 0 1 0 1H14v1h1.5a.5.5 0 0 1 0 1H14v1h1.5a.5.5 0 0 1 0 1H14a2.5 2.5 0 0 1-2.5 2.5v1.5a.5.5 0 0 1-1 0V14h-1v1.5a.5.5 0 0 1-1 0V14h-1v1.5a.5.5 0 0 1-1 0V14h-1v1.5a.5.5 0 0 1-1 0V14A2.5 2.5 0 0 1 2 11.5H.5a.5.5 0 0 1 0-1H2v-1H.5a.5.5 0 0 1 0-1H2v-1H.5a.5.5 0 0 1 0-1H2v-1H.5a.5.5 0 0 1 0-1H2A2.5 2.5 0 0 1 4.5 2V.5A.5.5 0 0 1 5 0zm-.5 3A1.5 1.5 0 0 0 3 4.5v7A1.5 1.5 0 0 0 4.5 13h7a1.5 1.5 0 0 0 1.5-1.5v-7A1.5 1.5 0 0 0 11.5 3h-7zM5 6.5A1.5 1.5 0 0 1 6.5 5h3A1.5 1.5 0 0 1 11 6.5v3A1.5 1.5 0 0 1 9.5 11h-3A1.5 1.5 0 0 1 5 9.5v-3zM6.5 6a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3z"/>
                                </svg>
                                Analisis Sistem Pakar
                            </h6>
                            <p class="mb-2 text-dark"><strong>Rekomendasi:</strong> <span class="badge bg-primary fs-6 ms-1">{{ $result->recommended_training }}</span></p>
                            <hr class="border-primary opacity-25">
                            <p class="mb-0 small text-dark"><strong>Alasan Detail:</strong> {{ $result->explanation ?? 'Tidak ada data analisis (Data Lama).' }}</p>
                        </div>
                        
                        <!-- Form Keputusan -->
                        <form action="{{ url('/spv/review/'.$result->id) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="form-label fw-bold text-secondary">Keputusan Evaluasi</label>
                                <select name="status" class="form-select form-select-lg border-primary shadow-sm" style="background-color: #f8fbff;" required>
                                    <option value="" {{ $result->status == 'pending' ? 'selected' : '' }} disabled>-- Tentukan Keputusan --</option>
                                    <option value="approved" {{ $result->status == 'approved' ? 'selected' : '' }}>✅ Setujui Pelatihan (Approved)</option>
                                    <option value="rejected" {{ $result->status == 'rejected' ? 'selected' : '' }}>❌ Tolak / Revisi (Rejected)</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-bold text-secondary">Catatan Khusus <span class="text-muted fw-normal small">(Opsional)</span></label>
                                <textarea name="spv_notes" class="form-control border-secondary shadow-sm" rows="4" placeholder="Berikan instruksi tambahan atau alasan jika pengajuan ditolak...">{{ $result->spv_notes }}</textarea>
                            </div>
                            
                            <!-- Tombol Responsif: Menyamping di Laptop, Menyusun ke bawah di HP -->
                            <div class="d-flex flex-column flex-md-row justify-content-between gap-3 mt-5">
                                <a href="{{ url('/spv/dashboard') }}" class="btn btn-light border-secondary text-secondary fw-bold px-4 py-2 order-2 order-md-1">⬅ Batal & Kembali</a>
                                <button type="submit" class="btn btn-primary shadow-sm fw-bold px-5 py-2 order-1 order-md-2">Simpan Keputusan</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Wajib Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>