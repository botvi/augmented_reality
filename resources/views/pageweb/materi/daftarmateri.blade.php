<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Materi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #FFE5D4 0%, #FFD1DC 50%, #E0BBE4 100%);
            font-family: 'Baloo 2', cursive;
            min-height: 100vh;
            background-image: url('https://img.freepik.com/free-vector/cute-pattern-background-doodle-style_53876-100265.jpg');
            background-size: cover;
            background-attachment: fixed;
        }
        .materi-container {
            padding: 20px;
        }
        .materi-card {
            background-color: #ffffff;
            border-radius: 20px;
            margin-bottom: 20px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            overflow: hidden;
            border: 3px solid #FFD93D;
        }
        .materi-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }
        .materi-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        .materi-card:hover .materi-image {
            transform: scale(1.1);
        }
        .materi-content {
            padding: 20px;
            text-align: center;
            background: linear-gradient(to bottom, #ffffff, #f8f9fa);
        }
        .materi-title {
            color: #FF6B6B;
            font-size: 24px;
            margin-bottom: 15px;
            font-weight: 600;
        }
        .btn-detail {
            background: linear-gradient(45deg, #FF6B6B, #FFD93D);
            color: white;
            padding: 12px 25px;
            border-radius: 30px;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            font-weight: bold;
            font-size: 16px;
        }
        .btn-detail:hover {
            transform: scale(1.05);
            color: white;
        }
        h1 {
            color: #FF6B6B;
            text-align: center;
            margin-bottom: 30px;
            font-size: 42px;
            font-weight: bold;
        }
        .modal-content {
            border-radius: 25px;
            border: 4px solid #FFD93D;
        }
        .modal-header {
            padding: 0;
            position: relative;
            border-bottom: none;
        }
        .modal-header img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 20px 20px 0 0;
        }
        .modal-title {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
            color: white;
            padding: 20px;
            margin: 0;
            font-size: 28px;
            font-weight: bold;
        }
        .modal-body {
            padding: 25px;
            background: #fff;
            border-radius: 0 0 20px 20px;
        }
        .content-wrapper {
            font-size: 18px;
            line-height: 1.8;
            color: #444;
        }
        .btn-back {
            background: linear-gradient(45deg, #FF6B6B, #FFD93D);
            border: none;
            padding: 12px 30px;
            border-radius: 30px;
            font-size: 18px;
            font-weight: bold;
            color: white;
            transition: all 0.3s ease;
        }
        .btn-back:hover {
            transform: scale(1.05);
            color: white;
        }
    </style>
</head>
<body style="background: linear-gradient(135deg, #f6d365 0%, #fda085 100%); min-height: 100vh; padding: 40px 0;">
    <div class="container py-5">
        <h1>Daftar Materi</h1>
        <a href="{{ url('/') }}" class="btn btn-back mb-4">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <div class="row materi-container">
            @foreach($materi as $materi)
            <div class="col-md-4">
                <div class="materi-card">
                    <img src="{{ asset('/' . $materi->gambar) }}" alt="{{ $materi->judul_materi }}" class="materi-image">
                    <div class="materi-content">
                        <h3 class="materi-title">{{ $materi->judul_materi }}</h3>
                        <button type="button" class="btn btn-detail" data-bs-toggle="modal" data-bs-target="#materiModal{{ $materi->id }}">
                            Detail
                        </button>
                    </div>
                </div>
            </div>

            <!-- Modal untuk setiap materi -->
            <div class="modal fade" id="materiModal{{ $materi->id }}" tabindex="-1" aria-labelledby="materiModalLabel{{ $materi->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content" style="border-radius: 20px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.2);">
                        <div class="modal-header p-0 position-relative">
                            <img src="{{ asset('/' . $materi->gambar) }}" alt="{{ $materi->judul_materi }}" style="width: 100%; height: 300px; object-fit: cover;">
                            <h5 class="modal-title position-absolute bottom-0 start-0 w-100 p-3" id="materiModalLabel{{ $materi->id }}">
                                {{ $materi->judul_materi }}
                            </h5>
                            <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4">
                            <div class="materi-description">
                                <div class="content-wrapper" style="font-size: 16px; line-height: 1.6; color: #333;">
                                    {!! $materi->materi !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
