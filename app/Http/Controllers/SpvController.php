<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrainingResult;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB; // Tambahan untuk rekap data laporan

class SpvController extends Controller
{
    public function dashboard()
    {
        $results = TrainingResult::with('user')->latest()->get();
        return view('spv.dashboard', compact('results'));
    }

    public function review(int $id)
    {
        $result = TrainingResult::with('user')->findOrFail($id);
        return view('spv.review', compact('result'));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
            'spv_notes' => 'nullable|string'
        ]);

        $result = TrainingResult::findOrFail($id);
        
        $result->update([
            'status' => $request->status,
            'spv_notes' => $request->spv_notes,
        ]);

        return redirect('/spv/dashboard')->with('success', 'Data pelatihan berhasil diupdate.');
    }

    public function createUser()
    {
        return view('spv.create_user');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:spv,karyawan',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect('/spv/dashboard')->with('success', 'User baru berhasil ditambahkan!');
    }

    // ==========================================
    // FUNGSI BARU: LAPORAN (REPORT)
    // ==========================================
    public function report()
    {
        // Menghitung status pengajuan
        $stats = [
            'total' => TrainingResult::count(),
            'approved' => TrainingResult::where('status', 'approved')->count(),
            'pending' => TrainingResult::where('status', 'pending')->count(),
            'rejected' => TrainingResult::where('status', 'rejected')->count(),
        ];

        // Menghitung jenis pelatihan yang paling banyak direkomendasikan
        $training_ranks = TrainingResult::select('recommended_training', DB::raw('count(*) as total'))
            ->groupBy('recommended_training')
            ->orderByDesc('total')
            ->get();

        // Data lengkap untuk tabel
        $results = TrainingResult::with('user')->latest()->get();

        return view('spv.report', compact('stats', 'training_ranks', 'results'));
    }
}