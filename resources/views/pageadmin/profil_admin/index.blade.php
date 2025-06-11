@extends('template-admin.layout')

@section('content')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Profil Admin</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item">
                                <a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Profil Admin</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->

            <div class="container">
                <div class="main-body">
                    <div class="row">
                        <!-- Profil Card -->
                        <div class="col-lg-4">
                            <div class="card shadow-sm">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0"><i class="bx bx-user-circle me-2"></i>Informasi Profil</h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex flex-column align-items-center text-center mb-4">
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTML0gExaohZHdZW3609F12nUmVc14WXYNx_w&s" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
                                        <div class="mt-3">
                                            <h4>{{ $data->nama }}</h4>
                                            <p class="text-muted mb-1">Administrator</p>
                                        </div>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="mb-0">
                                                <i class="bx bx-user me-2 text-primary"></i>Nama
                                            </h6>
                                            <span class="text-secondary">{{ $data->nama }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="mb-0">
                                                <i class="bx bx-user-pin me-2 text-primary"></i>Username
                                            </h6>
                                            <span class="text-secondary">{{ $data->username }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Form Edit Profil -->
                        <div class="col-lg-8">
                            <div class="card shadow-sm">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0"><i class="bx bx-edit me-2"></i>Edit Profil</h5>
                                </div>
                                <form action="{{ route('profil-admin.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="card-body">
                                        <!-- Nama -->
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Nama</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="bx bx-user"></i></span>
                                                    <input type="text" name="nama" class="form-control" value="{{ $data->nama }}" />
                                                </div>
                                                <small class="text-danger">
                                                    @foreach ($errors->get('nama') as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </small>
                                            </div>
                                        </div>

                                        <hr class="my-4" />

                                        <!-- Username -->
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Username</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="bx bx-user-pin"></i></span>
                                                    <input type="text" name="username" class="form-control" value="{{ $data->username }}" />
                                                </div>
                                                <small class="text-danger">
                                                    @foreach ($errors->get('username') as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </small>
                                            </div>
                                        </div>

                                        <!-- Password -->
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Password</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="bx bx-lock-alt"></i></span>
                                                    <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah" />
                                                </div>
                                                <small class="text-danger">
                                                    @foreach ($errors->get('password') as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </small>
                                            </div>
                                        </div>

                                        <!-- Konfirmasi Password -->
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Konfirmasi Password</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="bx bx-lock"></i></span>
                                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah" />
                                                </div>
                                                <small class="text-danger">
                                                    @foreach ($errors->get('password_confirmation') as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </small>
                                            </div>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="row">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9 text-secondary">
                                                <button type="submit" class="btn btn-primary px-4">
                                                    <i class="bx bx-save me-1"></i> Simpan Perubahan
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end wrapper-->
@endsection
