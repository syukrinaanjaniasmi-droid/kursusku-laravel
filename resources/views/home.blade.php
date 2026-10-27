
@extends('layouts.app')

@section('title', 'Beranda - KursusKu')

@section('content')

{{-- BAGIAN UTAMA --}}
<section class="hero-section py-4">
    <div class="row align-items-center g-4">
        <div class="col-lg-8">
            <span class="hero-badge mb-3">
                Kursus teknologi untuk mahasiswa
            </span>

            <h1 class="display-5 fw-bold">
                Bangun kemampuan web dari PHP sampai Laravel.
            </h1>

            <p class="lead text-secondary mt-3">
                KursusKu menyediakan latihan terarah untuk pemula.
                Pilih kursus, pelajari materi, dan kembangkan
                keterampilan pemrograman web secara bertahap.
            </p>

            <a href="{{ route('enrollments.create') }}"
               class="btn btn-primary mt-2">
                Daftar Kursus
            </a>
        </div>

        <div class="col-lg-4 hero-image-container">
            <img
                src="{{ asset('images/hero-kursus.jpg') }}"
                alt="Ilustrasi kelas KursusKu"
                class="hero-image"
            >
        </div>
    </div>
</section>

{{-- DAFTAR KURSUS --}}
<section class="course-section py-4">
    <h2 class="fw-bold mb-4">Program Belajar Unggulan</h2>

    <div class="row g-4">
        @foreach ($featured as $course)
            <div class="col-md-6">
                <article class="card course-card h-100">
                    <div class="card-body">
                        <small class="course-code">
                            {{ $course['code'] }}
                        </small>

                        <h3 class="h5 mt-3">
                            {{ $course['name'] }}
                        </h3>

                        <p class="text-secondary mb-0">
                            {{ $course['description'] }}
                        </p>
                    </div>
                </article>
            </div>
        @endforeach
    </div>
</section>
@endsection