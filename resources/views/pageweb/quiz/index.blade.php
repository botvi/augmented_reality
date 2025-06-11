<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Seru!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #FFE5D4 0%, #FFD1DC 50%, #E0BBE4 100%);
            font-family: 'Comic Sans MS', cursive, sans-serif;
            min-height: 100vh;
            background-image: url('https://img.freepik.com/free-vector/cute-pattern-background-doodle-style_53876-100265.jpg');
            background-size: cover;
            background-attachment: fixed;
        }

        .quiz-container {
            position: relative;
            overflow: hidden;
        }

        .floating-emoji {
            position: absolute;
            font-size: 2em;
            animation: float 3s ease-in-out infinite;
            opacity: 0.6;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }

        .card {
            border: 5px solid #FFD700;
            border-radius: 20px !important;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2) !important;
            background: rgba(255, 255, 255, 0.95) !important;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px rgba(0,0,0,0.3) !important;
        }

        .form-check {
            border: 3px solid #FFD700;
            border-radius: 15px !important;
            margin-bottom: 15px !important;
            transition: all 0.3s ease;
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%) !important;
        }

        .form-check:hover {
            transform: scale(1.02);
            background: linear-gradient(135deg, #e8f4f8 0%, #ffffff 100%) !important;
            border-color: #FF6B6B;
        }

        .form-check-input:checked + .form-check-label {
            color: #FF6B6B !important;
            font-weight: bold;
            transform: scale(1.05);
        }

        .card-title {
            color: #FF6B6B !important;
            font-size: 2em !important;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .card-text {
            font-size: 1.3em !important;
            color: #2c3e50;
            line-height: 1.6;
        }

        .btn-detail {
            background: linear-gradient(45deg, #FF6B6B, #FFD93D);
            border: none;
            padding: 12px 25px;
            border-radius: 30px;
            font-size: 1.2em;
            font-weight: bold;
            color: white;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
            box-shadow: 0 4px 15px rgba(255,107,107,0.3);
            transition: all 0.3s ease;
        }

        .btn-detail:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255,107,107,0.4);
            background: linear-gradient(45deg, #FFD93D, #FF6B6B);
        }

        .section-title h2 {
            font-size: 3em !important;
            color: #FF6B6B !important;
            text-shadow: 3px 3px 6px rgba(0,0,0,0.2);
            margin-bottom: 20px;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .section-title p {
            font-size: 1.4em !important;
            color: #2c3e50;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        }

        .quiz-card {
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from { 
                opacity: 0;
                transform: translateX(50px);
            }
            to { 
                opacity: 1;
                transform: translateX(0);
            }
        }

        .swal2-popup {
            border-radius: 20px !important;
            font-family: 'Comic Sans MS', cursive !important;
        }

        .swal2-title {
            color: #FF6B6B !important;
            font-size: 2em !important;
        }

        .swal2-content {
            font-size: 1.2em !important;
        }
    </style>
</head>
<body> <!-- Quiz Section -->
    <section id="quiz" class="quiz section" style="background: linear-gradient(135deg, #f6d365 0%, #fda085 100%); min-height: 100vh; padding: 40px 0;">
        <!-- Section Title -->
        <div class="container section-title text-center" data-aos="fade-up">
            <h2 style="color: #2c3e50; font-family: 'Comic Sans MS', cursive; font-size: 2.5em; text-shadow: 2px 2px 4px rgba(0,0,0,0.1);">🎮 Quiz! 🎮</h2>
            <p style="color: #34495e; font-size: 1.2em; font-family: 'Comic Sans MS', cursive;">Ayo jawab pertanyaan berikut dengan benar! 🌟</p>
            <a href="{{ url('/') }}" class="btn btn-primary mb-4" style="font-family: 'Comic Sans MS', cursive; background: linear-gradient(45deg, #FF6B6B, #FFD93D); border: none; padding: 10px 25px; border-radius: 30px; font-size: 1.1em; font-weight: bold; color: white; text-shadow: 1px 1px 2px rgba(0,0,0,0.2); box-shadow: 0 4px 15px rgba(255,107,107,0.3); transition: all 0.3s ease;">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow" style="border-radius: 20px; border: none; background: rgba(255, 255, 255, 0.95);">
                        <div class="card-body" style="padding: 30px;">
                            @if(count($soal) > 0)
                              

                                <input type="hidden" name="nilai_tkdk" id="nilai_tkdk" value="0">
                                
                                <div id="quiz-container">
                                    @foreach($soal as $key => $item)
                                        <div class="quiz-card {{ $key === 0 ? 'active' : 'd-none' }}" id="soal-{{ $key }}">
                                            <div class="card mb-4" style="border-radius: 15px; border: none; background: #fff; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                                                <div class="card-body">
                                                    <h5 class="card-title" style="color: #3498db; font-family: 'Comic Sans MS', cursive; font-size: 1.5em;">Pertanyaan {{ $key+1 }} 📝</h5>
                                                    <p class="card-text" style="font-size: 1.2em; color: #2c3e50; font-family: 'Comic Sans MS', cursive;">{{ $item['pertanyaan'] }}</p>

                                                    @if($item['gambar'])
                                                        <div class="mb-3 text-center">
                                                            <img src="{{ asset($item['gambar']) }}" alt="Soal Image" class="img-fluid" style="max-width: 200px; height: auto; border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                                                        </div>
                                                    @endif

                                                    <div class="options" style="margin-top: 20px;">
                                                        <div class="form-check mb-3" style="background: #f8f9fa; padding: 15px; border-radius: 10px; transition: all 0.3s ease;">
                                                            <input class="form-check-input jawaban-radio" type="radio" name="jawaban{{ $key }}" id="pilihan_a{{ $key }}" value="a" data-soal-id="{{ $key }}" data-jawaban-benar="{{ $item['jawaban'] }}">
                                                            <label class="form-check-label" for="pilihan_a{{ $key }}" style="font-family: 'Comic Sans MS', cursive; font-size: 1.1em; color: #2c3e50;">
                                                                A: {{ $item['pilihan']['a'] }}
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3" style="background: #f8f9fa; padding: 15px; border-radius: 10px; transition: all 0.3s ease;">
                                                            <input class="form-check-input jawaban-radio" type="radio" name="jawaban{{ $key }}" id="pilihan_b{{ $key }}" value="b" data-soal-id="{{ $key }}" data-jawaban-benar="{{ $item['jawaban'] }}">
                                                            <label class="form-check-label" for="pilihan_b{{ $key }}" style="font-family: 'Comic Sans MS', cursive; font-size: 1.1em; color: #2c3e50;">
                                                                B: {{ $item['pilihan']['b'] }}
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3" style="background: #f8f9fa; padding: 15px; border-radius: 10px; transition: all 0.3s ease;">
                                                            <input class="form-check-input jawaban-radio" type="radio" name="jawaban{{ $key }}" id="pilihan_c{{ $key }}" value="c" data-soal-id="{{ $key }}" data-jawaban-benar="{{ $item['jawaban'] }}">
                                                            <label class="form-check-label" for="pilihan_c{{ $key }}" style="font-family: 'Comic Sans MS', cursive; font-size: 1.1em; color: #2c3e50;">
                                                                C: {{ $item['pilihan']['c'] }}
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3" style="background: #f8f9fa; padding: 15px; border-radius: 10px; transition: all 0.3s ease;">
                                                            <input class="form-check-input jawaban-radio" type="radio" name="jawaban{{ $key }}" id="pilihan_d{{ $key }}" value="d" data-soal-id="{{ $key }}" data-jawaban-benar="{{ $item['jawaban'] }}">
                                                            <label class="form-check-label" for="pilihan_d{{ $key }}" style="font-family: 'Comic Sans MS', cursive; font-size: 1.1em; color: #2c3e50;">
                                                                D: {{ $item['pilihan']['d'] }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        let skor = 0;
                                        let currentQuestion = 0;
                                        const totalSoal = {{ count($soal) }};
                                        const radioButtons = document.querySelectorAll('.jawaban-radio');
                                        const skorInput = document.getElementById('nilai_tkdk');
                                        
                                        let jawabanDipilih = new Array(totalSoal).fill(false);
                                        
                                        function showQuestion(index) {
                                            document.querySelectorAll('.quiz-card').forEach(card => card.classList.add('d-none'));
                                            document.getElementById(`soal-${index}`).classList.remove('d-none');
                                        }

                                        radioButtons.forEach(radio => {
                                            radio.addEventListener('change', function() {
                                                const soalId = parseInt(this.getAttribute('data-soal-id'));
                                                const jawabanBenar = this.getAttribute('data-jawaban-benar');
                                                const jawabanTerpilih = this.value;
                                                
                                                if (jawabanTerpilih === jawabanBenar) {
                                                    skor++;
                                                    skorInput.value = skor;
                                                    Swal.fire({
                                                        icon: 'success',
                                                        title: '🎉 Horee! Benar!',
                                                        text: 'Jawaban kamu benar!',
                                                        timer: 1500,
                                                        showConfirmButton: false,
                                                        background: '#fff',
                                                        customClass: {
                                                            title: 'swal2-title-custom'
                                                        }
                                                    }).then(() => {
                                                        if (currentQuestion < totalSoal - 1) {
                                                            currentQuestion++;
                                                            showQuestion(currentQuestion);
                                                        } else {
                                                            Swal.fire({
                                                                icon: 'success',
                                                                title: '🎮 Selesai!',
                                                                text: 'Kamu telah menyelesaikan semua soal!',
                                                                confirmButtonText: 'Kembali ke Awal',
                                                                background: '#fff'
                                                            }).then(() => {
                                                                currentQuestion = 0;
                                                                showQuestion(currentQuestion);
                                                                radioButtons.forEach(radio => radio.checked = false);
                                                                jawabanDipilih.fill(false);
                                                                skor = 0;
                                                                skorInput.value = skor;
                                                            });
                                                        }
                                                    });
                                                } else {
                                                    Swal.fire({
                                                        icon: 'error',
                                                        title: '😢 Belum Tepat!',
                                                        text: 'Jawaban kamu belum tepat. Ayo coba lagi!',
                                                        timer: 1500,
                                                        showConfirmButton: false,
                                                        background: '#fff'
                                                    });
                                                }
                                                
                                                jawabanDipilih[soalId] = true;
                                            });
                                        });
                                    });
                                </script>
                            @else
                                <div class="alert alert-info" style="font-family: 'Comic Sans MS', cursive; font-size: 1.2em;">
                                    Tidak ada soal yang tersedia.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .form-check:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
            background: #e8f4f8 !important;
        }
        
        .form-check-input:checked + .form-check-label {
            color: #3498db !important;
            font-weight: bold;
        }
        
        .swal2-title-custom {
            font-family: 'Comic Sans MS', cursive !important;
        }
        
        .quiz-card {
            transition: all 0.3s ease;
        }
        
        .quiz-card.active {
            animation: fadeIn 0.5s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
