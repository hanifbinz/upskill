<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\TrainingResult;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function dashboard()
    {
        $results = TrainingResult::where('user_id', Auth::id())->latest()->get();
        return view('employee.dashboard', compact('results'));
    }

    public function questionnaire()
    {
        $questions = Question::all();
        return view('employee.questionnaire', compact('questions'));
    }

    public function store(Request $request)
    {
        $answers = $request->except('_token');
        $questions = Question::all();
        
        $scores = [
            'Operasional Lapangan' => 0,
            'Alat Berat' => 0,
            'Administrasi & Sistem' => 0,
            'Manajerial' => 0,
        ];

        foreach ($questions as $q) {
            $answer_value = isset($answers['q_'.$q->id]) ? (int)$answers['q_'.$q->id] : 0;
            $scores[$q->category] += $answer_value;
        }

        $recommended_training = 'Leadership';
        $explanation = 'Kompetensi teknis dan manajerial Anda sudah sangat baik. Anda siap dipersiapkan untuk jenjang karir lebih tinggi.';
        $threshold = 15;

        if ($scores['Operasional Lapangan'] < $threshold) {
            $recommended_training = 'Proses Checking Bongkar Muat';
            $explanation = 'Skor operasional rendah. Anda perlu meningkatkan pemahaman SOP bongkar muat dan akurasi dokumen untuk menghindari selisih barang.';
        } elseif ($scores['Alat Berat'] < $threshold) {
            $recommended_training = 'Skill Forklift Reach Truck / CB';
            $explanation = 'Skor teknis alat berat rendah. Pelatihan ini penting untuk keselamatan kerja dan efisiensi operasional forklift.';
        } elseif ($scores['Administrasi & Sistem'] < $threshold) {
            $recommended_training = 'Pelatihan Microsoft Office / ERP';
            $explanation = 'Anda perlu memperkuat kemampuan digital untuk mempercepat input data dan menyusun laporan di sistem perusahaan.';
        } elseif ($scores['Manajerial'] < $threshold) {
            $recommended_training = 'Pelatihan Komunikasi & Problem Solving';
            $explanation = 'Anda perlu meningkatkan kemampuan koordinasi dan penanganan masalah (seperti bottleneck antrian) dengan tim.';
        }

        TrainingResult::create([
            'user_id' => Auth::id(),
            'recommended_training' => $recommended_training, 
            'explanation' => $explanation, 
            'status' => 'pending',
        ]);

        return redirect('/employee/dashboard')->with('success', 'Kuesioner berhasil disubmit! Menunggu review SPV.');
    }
}