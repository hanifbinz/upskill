<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User Baru - UpSkill</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body p-4">
                        <h4 class="mb-4 text-center">Registrasi User Baru</h4>
                        
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ url('/spv/users/create') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Alamat Email</label>
                                <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password Sementara</label>
                                <input type="password" name="password" class="form-control" required minlength="6" placeholder="Minimal 6 karakter">
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Hak Akses (Role)</label>
                                <select name="role" class="form-select" required>
                                    <option value="" disabled selected>-- Pilih Hak Akses --</option>
                                    <option value="karyawan">Karyawan (Pengisi Kuesioner)</option>
                                    <option value="spv">Supervisor (Peninjau Hasil)</option>
                                </select>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="{{ url('/spv/dashboard') }}" class="btn btn-secondary">Batal & Kembali</a>
                                <button type="submit" class="btn btn-success">Simpan Akun Baru</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>