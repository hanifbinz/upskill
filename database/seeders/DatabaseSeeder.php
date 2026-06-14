<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Question;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat Akun SPV Gudang
        User::create([
            'name' => 'Supervisor Gudang',
            'email' => 'spv@gudang.com',
            'password' => Hash::make('password123'),
            'role' => 'spv',
        ]);

        // 2. Buat Akun Karyawan Lapangan
        User::create([
            'name' => 'Muhammad Hanif',
            'email' => 'karyawan@gudang.com',
            'password' => Hash::make('password123'),
            'role' => 'karyawan',
        ]);

        // 3. Masukkan 20 Pertanyaan Master Data
        $questions = [
            // Kategori 1: Operasional Lapangan & Akurasi Dokumen
            ['category' => 'Operasional Lapangan', 'question_text' => 'Seberapa paham Anda cara mencocokkan Surat Jalan (SJ) dengan aktual fisik barang (palet vs zak)?'],
            ['category' => 'Operasional Lapangan', 'question_text' => 'Seberapa paham Anda prosedur pemeriksaan kelayakan fisik truk (kebocoran/kebersihan) sebelum bongkar muat?'],
            ['category' => 'Operasional Lapangan', 'question_text' => 'Seberapa tahu Anda langkah SOP jika terjadi selisih jumlah barang atau barang rusak (damage)?'],
            ['category' => 'Operasional Lapangan', 'question_text' => 'Seberapa paham Anda batas toleransi tumpukan maksimal (stacking limit) barang di loading yard?'],
            ['category' => 'Operasional Lapangan', 'question_text' => 'Seberapa tanggap Anda memastikan loading dock bersih dari sisa palet/wrapping setelah bongkar muat?'],

            // Kategori 2: Pengoperasian Alat Berat & K3
            ['category' => 'Alat Berat', 'question_text' => 'Seberapa rutin dan paham Anda melakukan checklist harian (baterai/rem) sebelum forklift dioperasikan?'],
            ['category' => 'Alat Berat', 'question_text' => 'Seberapa paham Anda membaca pedoman batas maksimal kapasitas angkat (Safe Working Load) pada forklift?'],
            ['category' => 'Alat Berat', 'question_text' => 'Seberapa yakin Anda dengan manuver radius putar di lorong rak sempit (Reach Truck)?'],
            ['category' => 'Alat Berat', 'question_text' => 'Seberapa paham Anda teknik keselamatan mengambil palet dari dalam wing box/kontainer (Counterbalance)?'],
            ['category' => 'Alat Berat', 'question_text' => 'Seberapa paham prosedur menjaga jarak aman dan klakson dari pejalan kaki di area operasional?'],

            // Kategori 3: Administrasi & Sistem Digital
            ['category' => 'Administrasi & Sistem', 'question_text' => 'Seberapa lancar Anda input data kedatangan dan SLA bongkar muat pada web antrian?'],
            ['category' => 'Administrasi & Sistem', 'question_text' => 'Seberapa menguasai Anda rumus dasar spreadsheet (VLOOKUP/Pivot) untuk laporan harian?'],
            ['category' => 'Administrasi & Sistem', 'question_text' => 'Seberapa paham Anda alur inventory transfer, cetak resi, dan potong stok di sistem ERP?'],
            ['category' => 'Administrasi & Sistem', 'question_text' => 'Seberapa cepat Anda melakukan arsip digital (scan BAST/Surat Jalan) ke database?'],
            ['category' => 'Administrasi & Sistem', 'question_text' => 'Seberapa tanggap Anda update status loading di sistem agar akurat dengan fisik lapangan?'],

            // Kategori 4: Manajerial & Komunikasi
            ['category' => 'Manajerial', 'question_text' => 'Seberapa mampu Anda mengambil keputusan cepat saat terjadi bottleneck antrian truk?'],
            ['category' => 'Manajerial', 'question_text' => 'Seberapa percaya diri Anda menegur supir truk eksternal yang melanggar aturan gudang?'],
            ['category' => 'Manajerial', 'question_text' => 'Seberapa sering Anda memberi usulan perbaikan (continuous improvement) atas alur kerja yang tidak efisien?'],
            ['category' => 'Manajerial', 'question_text' => 'Seberapa mampu Anda menengahi konflik antar anggota tim mengenai pembagian tugas shift?'],
            ['category' => 'Manajerial', 'question_text' => 'Seberapa terampil Anda mendelegasikan tugas (mana alat berat, mana manual) agar target SLA tercapai?'],
        ];

        foreach ($questions as $q) {
            Question::create($q);
        }
    }
}