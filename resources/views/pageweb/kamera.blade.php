<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>Augmented Reality</title>

    <!-- A-Frame & AR.js -->
    <script src="https://aframe.io/releases/1.2.0/aframe.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/ar.js@latest/aframe/build/aframe-ar.min.js"></script>
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body { 
            margin: 0; 
            overflow: hidden; 
            touch-action: none; 
            -webkit-user-select: none;
            user-select: none;
            font-family: 'Comic Neue', cursive;
        }
        .ar-controls {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
            display: flex;
            gap: 15px;
        }
        .ar-button {
            padding: 12px 24px;
            background: #FF6B6B;
            color: white;
            border: none;
            border-radius: 25px;
            font-size: 18px;
            font-weight: bold;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            transition: transform 0.2s, box-shadow 0.2s;
            cursor: pointer;
        }
        .ar-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.3);
        }
        #loading {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(255, 107, 107, 0.9);
            color: white;
            padding: 25px 40px;
            border-radius: 20px;
            z-index: 1000;
            font-size: 18px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            animation: pulse 1.5s infinite;
        }
        @keyframes pulse {
            0% { transform: translate(-50%, -50%) scale(1); }
            50% { transform: translate(-50%, -50%) scale(1.05); }
            100% { transform: translate(-50%, -50%) scale(1); }
        }
        .materi-button {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 12px 25px;
            background: #4ECDC4;
            color: white;
            border: none;
            border-radius: 25px;
            font-size: 18px;
            font-weight: bold;
            display: none;
            z-index: 1000;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            transition: transform 0.2s, box-shadow 0.2s;
            cursor: pointer;
        }
        .materi-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.3);
        }
        .modal {
            display: none;
            position: fixed;
            top: 0;
            right: 0;
            width: 40%;
            height: 100%;
            background: rgba(255, 255, 255, 0.98);
            z-index: 2000;
            box-shadow: -2px 0 15px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease-in-out;
        }
        .modal-content {
            position: relative;
            height: 100%;
            padding: 30px;
            overflow-y: auto;
            background: white;
        }
        .close-modal {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 28px;
            cursor: pointer;
            color: #FF6B6B;
            z-index: 2001;
            transition: transform 0.2s;
        }
        .close-modal:hover {
            transform: scale(1.1);
        }
        #materiContent {
            margin-top: 30px;
            padding-right: 20px;
        }
        #materiContent h3 {
            color: #2C3E50;
            margin-bottom: 20px;
            font-size: 1.8em;
            text-align: center;
        }
        #materiContent div {
            line-height: 1.8;
            color: #34495E;
            font-size: 1.1em;
        }
        #materiContent img {
            width: 100%;
            max-width: 400px;
            height: auto;
            display: block;
            margin: 0 auto 20px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div id="loading">Memuat kamera dan model 3D...</div>

    <button class="materi-button" id="materiButton">Lihat Materi</button>

    <div class="modal" id="materiModal">
        <div class="modal-content">
            <span class="close-modal" id="closeModal">&times;</span>
            <div id="materiContent">
                <h3>Tidak ada materi yang tersedia</h3>
            </div>
        </div>
    </div>

    <div class="ar-controls">
        <button class="ar-button" id="zoomIn">+</button>
        <button class="ar-button" id="zoomOut">-</button>
        <button class="ar-button" id="resetView">Reset</button>
    </div>

    <a-scene embedded arjs="sourceType: webcam; debugUIEnabled: false; detectionMode: mono_and_matrix; matrixCodeType: 3x3;">
        @foreach($ar_list as $ar)
        <a-marker type="pattern" url="{{ asset('pattern/' . $ar->pattern_pattern) }}" emitevents="true" id="marker-{{ $ar->id }}">
            <a-entity id="model-{{ $ar->id }}"
                      gltf-model="{{ asset('objek_3d/' . $ar->objek_3d) }}"
                      position="0 0 0"
                      scale="1 1 1"
                      rotation="0 180 0">
            </a-entity>
        </a-marker>
        @endforeach
        <a-entity camera></a-entity>
    </a-scene>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const loading = document.getElementById("loading");
            const materiButton = document.getElementById("materiButton");
            const materiModal = document.getElementById("materiModal");
            const closeModal = document.getElementById("closeModal");
            const materiContent = document.getElementById("materiContent");
            let currentMateri = null;
            
            // Data AR dari server
            const arData = @json($ar_list);
            
            // Event listener untuk setiap marker
            arData.forEach(ar => {
                const marker = document.getElementById(`marker-${ar.id}`);
                const model = document.getElementById(`model-${ar.id}`);
                
                marker.addEventListener('markerFound', function() {
                    materiButton.style.display = 'block';
                    currentMateri = ar.materi;
                    updateMateriContent();
                });

                marker.addEventListener('markerLost', function() {
                    materiButton.style.display = 'none';
                    materiModal.style.display = 'none';
                    currentMateri = null;
                });

                // Sembunyikan loading setelah model dimuat
                model.addEventListener('model-loaded', function() {
                    loading.style.display = 'none';
                });
            });

            function updateMateriContent() {
                if (currentMateri) {
                    materiContent.innerHTML = `
                        <img src="/${currentMateri.gambar}" alt="Gambar" style="width: 40%; height: 40%; display: block; margin: 0 auto; border-radius: 10px;">
                        <h3>${currentMateri.judul_materi}</h3>
                        <div>${currentMateri.materi}</div>
                    `;
                } else {
                    materiContent.innerHTML = '<h3>Tidak ada materi yang tersedia</h3>';
                }
            }

            // Event listener untuk modal
            materiButton.addEventListener('click', function() {
                materiModal.style.display = 'block';
            });

            closeModal.addEventListener('click', function() {
                materiModal.style.display = 'none';
            });

            window.addEventListener('click', function(event) {
                if (event.target == materiModal) {
                    materiModal.style.display = 'none';
                }
            });

            // Zoom controls
            const zoomIn = document.getElementById('zoomIn');
            const zoomOut = document.getElementById('zoomOut');
            const resetView = document.getElementById('resetView');

            zoomIn.addEventListener('click', function() {
                arData.forEach(ar => {
                    const model = document.getElementById(`model-${ar.id}`);
                    const currentScale = model.getAttribute('scale');
                    model.setAttribute('scale', {
                        x: currentScale.x * 1.2,
                        y: currentScale.y * 1.2,
                        z: currentScale.z * 1.2
                    });
                });
            });

            zoomOut.addEventListener('click', function() {
                arData.forEach(ar => {
                    const model = document.getElementById(`model-${ar.id}`);
                    const currentScale = model.getAttribute('scale');
                    model.setAttribute('scale', {
                        x: currentScale.x * 0.8,
                        y: currentScale.y * 0.8,
                        z: currentScale.z * 0.8
                    });
                });
            });

            resetView.addEventListener('click', function() {
                arData.forEach(ar => {
                    const model = document.getElementById(`model-${ar.id}`);
                    model.setAttribute('scale', '1 1 1');
                    model.setAttribute('rotation', '0 180 0');
                });
            });
        });
    </script>
</body>
</html>