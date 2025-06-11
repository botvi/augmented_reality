@extends('template-admin.layout')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Forms</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Augmented Reality</li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah Augmented Reality</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--breadcrumb-->
            <!--breadcrumb-->

            <div class="row">
                <div class="col-xl-7 mx-auto">
                    <hr />
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-5">
                            <div class="card-title d-flex align-items-center">
                                <div><i class="bx bx-plus-circle me-1 font-22 text-primary"></i></div>
                                <h5 class="mb-0 text-primary">Tambah Augmented Reality</h5>
                            </div>
                            <hr>
                            <form action="{{ route('augmented-reality.store') }}" method="POST" enctype="multipart/form-data"
                                class="row g-3" id="uploadForm">
                                @csrf
                                <div class="col-md-6">
                                    <label for="nama_objek" class="form-label">Nama Objek</label>
                                    <input type="text" class="form-control" id="nama_objek" name="nama_objek"
                                        value="{{ old('nama_objek') }}" required>
                                    @error('nama_objek')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="objek_3d" class="form-label">Objek 3D</label>
                                    <input type="file" class="form-control" id="objek_3d" name="objek_3d" required>
                                    @error('objek_3d')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="pattern_pattern" class="form-label">Pattern Pattern</label>
                                    <input type="file" class="form-control" id="pattern_pattern" name="pattern_pattern" required>
                                    @error('pattern_pattern')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="pattern_image" class="form-label">Pattern Image</label>
                                    <input type="file" class="form-control" id="pattern_image" name="pattern_image" required>
                                    @error('pattern_image')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Progress Bar -->
                                <div class="col-12 d-none" id="progressContainer">
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated" 
                                             role="progressbar" 
                                             style="width: 0%" 
                                             id="uploadProgress">
                                        </div>
                                    </div>
                                    <small class="text-muted mt-2" id="progressText">0%</small>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary px-5" id="submitBtn">Simpan</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.getElementById('uploadForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const progressContainer = document.getElementById('progressContainer');
            const progressBar = document.getElementById('uploadProgress');
            const progressText = document.getElementById('progressText');
            const submitBtn = document.getElementById('submitBtn');
            
            // Tampilkan progress bar
            progressContainer.classList.remove('d-none');
            submitBtn.disabled = true;
            
            // Kirim request dengan XMLHttpRequest untuk tracking progress
            const xhr = new XMLHttpRequest();
            xhr.open('POST', this.action, true);
            
            xhr.upload.onprogress = function(e) {
                if (e.lengthComputable) {
                    const percentComplete = (e.loaded / e.total) * 100;
                    progressBar.style.width = percentComplete + '%';
                    progressText.textContent = Math.round(percentComplete) + '%';
                }
            };
            
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Redirect ke halaman sukses atau lakukan sesuatu
                    window.location.href = '{{ route("augmented-reality.index") }}';
                } else {
                    alert('Terjadi kesalahan saat upload');
                    submitBtn.disabled = false;
                }
            };
            
            xhr.onerror = function() {
                alert('Terjadi kesalahan saat upload');
                submitBtn.disabled = false;
            };
            
            xhr.send(formData);
        });
    </script>
    @endpush
@endsection
