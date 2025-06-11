<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Game</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #FFE5D4 0%, #FFD1DC 50%, #E0BBE4 100%);
            font-family: 'Comic Sans MS', cursive, sans-serif;
            min-height: 100vh;
        }
        .menu-list {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
        }
        .menu-item {
            background-color: #ffffff;
            border-radius: 15px;
            margin-bottom: 15px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.2s;
            cursor: pointer;
            font-size: 24px;
            color: #2c3e50;
            text-decoration: none;
            display: block;
        }
        .menu-item:hover {
            transform: scale(1.05);
            background-color: #e3f2fd;
            text-decoration: none;
            color: #1565c0;
        }
        h1 {
            color: #1565c0;
            text-align: center;
            margin-bottom: 30px;
            font-size: 36px;
        }
    </style>
</head>
<body style="background: linear-gradient(135deg, #f6d365 0%, #fda085 100%); min-height: 100vh; padding: 40px 0;">
    <div class="container py-5">
        <h1>Menu Pembelajaran</h1>
        
        <div class="menu-list">
            <a href="{{ route('kamera') }}" class="menu-item">Kamera Augmented Reality</a>
            <a href="{{ route('web-materi') }}" class="menu-item">Daftar Materi</a>
            <a href="{{ route('web-quiz') }}" class="menu-item">Quiz</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
