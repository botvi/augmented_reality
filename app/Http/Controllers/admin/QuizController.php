<?php

namespace App\Http\Controllers\admin;

use App\Models\Quiz;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
class QuizController extends Controller
{
    public function index()
    {
       
        $quiz = Quiz::orderBy('created_at', 'desc')->get();

        return view('pageadmin.master_quiz.index', compact('quiz'));
    }

    public function create()
    {
       
        return view('pageadmin.master_quiz.create');
    }

    public function store(Request $request)
    {
       
        $validated = $request->validate([
            'soal' => 'required|array',
            'soal.*.gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'soal.*.pertanyaan' => 'required|string|max:255',
            'soal.*.pilihan.a' => 'required|string|max:255',
            'soal.*.pilihan.b' => 'required|string|max:255',
            'soal.*.pilihan.c' => 'required|string|max:255',
            'soal.*.pilihan.d' => 'required|string|max:255',
            'soal.*.jawaban' => 'required|in:a,b,c,d',
          
        ]);

        $soalProcessed = [];

        foreach ($validated['soal'] as $soal) {
            $gambarPath = null;

            // Periksa apakah gambar diunggah
            if (isset($soal['gambar']) && $soal['gambar'] instanceof \Illuminate\Http\UploadedFile) {
                $gambarPath = $soal['gambar']->move(public_path('uploads/soal-gambar'), $soal['gambar']->getClientOriginalName());
                $gambarPath = 'uploads/soal-gambar/' . $soal['gambar']->getClientOriginalName();
            }

            // Tambahkan soal yang diproses ke array
            $soalProcessed[] = [
                'pertanyaan' => $soal['pertanyaan'],
                'gambar' => $gambarPath,
                'pilihan' => [
                    'a' => $soal['pilihan']['a'],
                    'b' => $soal['pilihan']['b'],
                    'c' => $soal['pilihan']['c'],
                    'd' => $soal['pilihan']['d'],
                ],
                'jawaban' => $soal['jawaban'],
            ];
        }

        // Simpan ujian
        $quis = Quiz::create([
            'soal' => $soalProcessed, // Simpan soal yang telah diproses
          
        ]);

        Alert::toast('Quiz berhasil dibuat', 'success');
        return redirect()->route('master-quiz.index');
    }




    public function edit($id)
    {
       
        $quiz = Quiz::find($id);
        return view('pageadmin.master_quiz.edit', compact('quiz'));
    }

    public function update(Request $request, $id)
    {
        try {
            $quiz = Quiz::findOrFail($id);
        
            // Validation rules
            $validated = $request->validate([
                'soal' => 'required|array',
                'soal.*.gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'soal.*.pertanyaan' => 'required|string|max:255',
                'soal.*.pilihan.a' => 'required|string|max:255',
                'soal.*.pilihan.b' => 'required|string|max:255',
                'soal.*.pilihan.c' => 'required|string|max:255',
                'soal.*.pilihan.d' => 'required|string|max:255',
                'soal.*.jawaban' => 'required|in:a,b,c,d',
            ]);
        
            // Process soal
            $soalProcessed = [];
            foreach ($validated['soal'] as $key => $soal) {
                $gambarPath = null;
                
                // Cek gambar yang sudah ada
                if (isset($quiz->soal[$key]) && isset($quiz->soal[$key]['gambar'])) {
                    $gambarPath = $quiz->soal[$key]['gambar'];
                }
        
                // Jika ada gambar baru yang diupload
                if (isset($soal['gambar']) && $soal['gambar'] instanceof \Illuminate\Http\UploadedFile) {
                    // Hapus gambar lama jika ada
                    if ($gambarPath && file_exists(public_path($gambarPath))) {
                        unlink(public_path($gambarPath));
                    }
        
                    // Simpan gambar baru
                    $fileName = time() . '-' . $soal['gambar']->getClientOriginalName();
                    $soal['gambar']->move(public_path('uploads/soal-gambar'), $fileName);
                    $gambarPath = 'uploads/soal-gambar/' . $fileName;
                }
        
                // Tambahkan soal yang diproses ke array
                $soalProcessed[] = [
                    'pertanyaan' => $soal['pertanyaan'],
                    'gambar' => $gambarPath,
                    'pilihan' => [
                        'a' => $soal['pilihan']['a'],
                        'b' => $soal['pilihan']['b'],
                        'c' => $soal['pilihan']['c'],
                        'd' => $soal['pilihan']['d'],
                    ],
                    'jawaban' => $soal['jawaban'],
                ];
            }
        
            // Update quiz
            $quiz->update([
                'soal' => $soalProcessed,
            ]);

            Alert::toast('Quiz berhasil diperbarui', 'success');
            return redirect()->route('master-quiz.index');
            
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan saat memperbarui quiz: ' . $e->getMessage());
            return redirect()->back();
        }
    }
    
    



    public function destroy($id)
    {
        $quiz = Quiz::find($id);
        $quiz->delete();
        Alert::success('Success', 'Quiz berhasil dihapus');
        return redirect()->route('master-quiz.index');
    }


    public function show($id)
    {
        
        $quiz = Quiz::find($id);  
        $soal = $quiz->soal;      
    
        return view('pageadmin.master_quiz.view_soal', compact('soal', 'quiz'));
    }


    
}