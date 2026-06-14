<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - UpSkill TNA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow-sm border-0 mt-5">
                    <div class="card-body p-5">
                        <h3 class="text-center mb-1 text-dark fw-bold">UpSkill TNA</h3>
                        <p class="text-center text-secondary mb-5 small">Sistem Analisis Kebutuhan Pelatihan</p>
                        
                        @if($errors->any())
                            <div class="alert alert-secondary border-dark text-dark">{{ $errors->first() }}</div>
                        @endif

                        <form action="{{ url('/login') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-medium text-dark">Alamat Email</label>
                                <input type="email" name="email" class="form-control border-dark" required value="{{ old('email') }}">
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-medium text-dark">Password</label>
                                <input type="password" name="password" class="form-control border-dark" required>
                            </div>
                            <button type="submit" class="btn btn-dark w-100 fw-bold py-2">MASUK</button>
                        </form>
                        
                        <hr class="my-4 border-secondary">
                        <div class="alert alert-light border border-secondary text-secondary py-3 text-center" style="font-size: 0.85rem;">
                            <strong>Akun Testing UAS:</strong><br>
                            SPV: spv@gudang.com <br>
                            Karyawan: karyawan@gudang.com <br>
                            <em>Password: password123</em>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>