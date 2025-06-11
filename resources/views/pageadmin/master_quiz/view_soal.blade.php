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
                            <li class="breadcrumb-item active" aria-current="page">Soal Quiz</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="container">
                <h2>Soal Quiz</h2>
                
                
                
                @if(count($soal) > 0)
                    <ul class="list-group">
                        @foreach($quiz->soal as $key => $item)
                            <li class="list-group-item">
                                <div class="mb-3">
                                    <strong>Pertanyaan:</strong> {{ $item['pertanyaan'] }}
                                </div>
        
                                @if($item['gambar'])
                                    <div class="mb-3">
                                        <img src="{{ asset($item['gambar']) }}" alt="Soal Image" class="img-fluid" style="max-width: 150px; height: auto; border-radius: 8px; object-fit: cover;">
                                    </div>
                                @else
                                    <div class="mb-3">
                                        <em>No image available</em>
                                    </div>
                                @endif
        
                                <div class="mb-3">
                                    <strong>Pilihan:</strong>
                                    <ul>
                                        <li>A: {{ $item['pilihan']['a'] }}</li>
                                        <li>B: {{ $item['pilihan']['b'] }}</li>
                                        <li>C: {{ $item['pilihan']['c'] }}</li>
                                        <li>D: {{ $item['pilihan']['d'] }}</li>
                                    </ul>
                                </div>
        
                                <div class="mb-3">
                                    <strong>Jawaban:</strong> {{ strtoupper($item['jawaban']) }}
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>No soal found.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
