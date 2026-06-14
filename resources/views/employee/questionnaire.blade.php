<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuesioner Kompetensi - UpSkill</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-primary mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold fs-6 fs-md-5" href="{{ url('/employee/dashboard') }}">⬅ Kembali ke Dashboard</a>
        </div>
    </nav>

    <div class="container mb-5">
        <div class="card shadow-sm border-0">
            <div class="card-body p-3 p-md-4">
                <h4 class="mb-2 fw-bold">Kuesioner Kompetensi Lapangan</h4>
                <p class="text-muted mb-4 small md-fs-6">Jawablah pertanyaan berikut dengan jujur (Skala 1 = Sangat Kurang Paham, 5 = Sangat Paham). Sistem pakar akan menganalisa kelemahan Anda dan memberikan rekomendasi pelatihan.</p>
                <hr>

                <form action="{{ url('/employee/questionnaire') }}" method="POST">
                    @csrf
                    
                    @php $no = 1; @endphp
                    @foreach($questions as $q)
                        <div class="mb-4 bg-white p-3 rounded border">
                            <p class="fw-bold mb-3">{{ $no++ }}. {{ $q->question_text }} <br><span class="badge bg-secondary mt-1">{{ $q->category }}</span></p>
                            
                            <div class="d-flex flex-wrap gap-3 gap-md-4">
                                <div class="form-check form-check-inline me-0">
                                    <input class="form-check-input" type="radio" name="q_{{ $q->id }}" value="1" id="q_{{ $q->id }}_1" required>
                                    <label class="form-check-label fw-bold" for="q_{{ $q->id }}_1">1</label>
                                </div>
                                <div class="form-check form-check-inline me-0">
                                    <input class="form-check-input" type="radio" name="q_{{ $q->id }}" value="2" id="q_{{ $q->id }}_2">
                                    <label class="form-check-label fw-bold" for="q_{{ $q->id }}_2">2</label>
                                </div>
                                <div class="form-check form-check-inline me-0">
                                    <input class="form-check-input" type="radio" name="q_{{ $q->id }}" value="3" id="q_{{ $q->id }}_3">
                                    <label class="form-check-label fw-bold" for="q_{{ $q->id }}_3">3</label>
                                </div>
                                <div class="form-check form-check-inline me-0">
                                    <input class="form-check-input" type="radio" name="q_{{ $q->id }}" value="4" id="q_{{ $q->id }}_4">
                                    <label class="form-check-label fw-bold" for="q_{{ $q->id }}_4">4</label>
                                </div>
                                <div class="form-check form-check-inline me-0">
                                    <input class="form-check-input" type="radio" name="q_{{ $q->id }}" value="5" id="q_{{ $q->id }}_5">
                                    <label class="form-check-label fw-bold" for="q_{{ $q->id }}_5">5</label>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <button type="submit" class="btn btn-success btn-lg w-100 mt-3 fw-bold">Submit Jawaban & Analisa</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>