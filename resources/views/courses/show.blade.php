@extends('layouts.app')

@section('content')
<style>
    :root {
        --hero-1: #dbeafe;     
        --hero-2: #bfdbfe;      
        --hero-text: #0f172a; 
        --hero-sub: #334155; 
        --hero-border: #93c5fd;
        --accent: #1d4ed8;
        --page-width: 960px;
    }

    .hero {
        border-radius: 1.25rem;
        padding: 2rem;
        color: var(--hero-text);
        background: linear-gradient(135deg, var(--hero-1), var(--hero-2));
        border: 1px solid var(--hero-border);
    }
    .code-pill {
        display: inline-block;
        background: var(--accent);
        color: #fff;
        border-radius: 8px;
        padding: .25rem .75rem;
        font-size: .8rem;
        font-weight: 700;
        letter-spacing: .1em;
    }
    .hero-title {
        font-size: clamp(1.6rem, 4vw, 2.3rem);
        font-weight: 800;
        line-height: 1.2;
        color: var(--hero-text);
    }
    .hero-sub {
        color: var(--hero-sub);
        font-weight: 500;
    }
    .status-pill {
        display: inline-block;
        border-radius: 999px;
        padding: .4rem 1.1rem;
        font-weight: 700;
        font-size: .85rem;
    }

    .stat-card {
        border: 0;
        border-radius: 1rem;
        color: #fff;
        background: linear-gradient(135deg, var(--c1), var(--c2));
        transition: transform .2s ease, box-shadow .2s ease;
    }
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 .8rem 1.4rem rgba(0, 0, 0, .18) !important;
    }
    .stat-emoji {
        width: 46px;
        height: 46px;
        border-radius: 12px;
        background: rgba(255, 255, 255, .22);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
    }
    .stat-label {
        font-size: .7rem;
        text-transform: uppercase;
        letter-spacing: .1em;
        opacity: .9;
    }

    .info-card {
        border: 0;
        border-radius: 1rem;
    }
    .section-title {
        display: flex;
        align-items: center;
        gap: .6rem;
        font-weight: 700;
    }
    .section-title::before {
        content: "";
        width: 6px;
        height: 22px;
        border-radius: 3px;
        background: var(--accent);
    }

    .btn-soft {
        transition: transform .15s ease, box-shadow .15s ease;
    }
    .btn-soft:hover {
        transform: translateY(-2px);
        box-shadow: 0 .4rem .8rem rgba(0, 0, 0, .15);
    }
    .btn-main {
        background: var(--accent);
        border-color: var(--accent);
        color: #fff;
    }
    .btn-main:hover {
        color: #fff;
        background: #1e40af;
        border-color: #1e40af;
    }
</style>

@php
    [$statusBg, $statusText] = match ($course->status) {
        'open' => ['#16a34a', '#ffffff'],
        'closed' => ['#dc2626', '#ffffff'],
        default => ['#facc15', '#1f2937'],
    };
@endphp

<div class="container py-4" style="max-width: var(--page-width)">
    @if (session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif

    <div class="hero shadow-sm">
        <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
            <div>
                <span class="code-pill">{{ $course->code }}</span>
                <h1 class="hero-title mt-3 mb-1">{{ $course->name }}</h1>
                <small class="hero-sub">Detail Kursus</small>
            </div>
            <span class="status-pill" style="background: {{ $statusBg }}; color: {{ $statusText }}">
                {{ ucfirst($course->status) }}
            </span>
        </div>
    </div>

    <div class="row g-3 my-2">
        <div class="col-md-4">
            <div class="card stat-card shadow-sm h-100" style="--c1:#059669; --c2:#34d399">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="stat-emoji">💰</div>
                    <div>
                        <div class="stat-label">Biaya</div>
                        <div class="fw-bold fs-5">Rp {{ number_format($course->fee, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card stat-card shadow-sm h-100" style="--c1:#2563eb; --c2:#60a5fa">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="stat-emoji">👥</div>
                    <div>
                        <div class="stat-label">Kuota</div>
                        <div class="fw-bold fs-5">{{ $course->quota }} peserta</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card stat-card shadow-sm h-100" style="--c1:#ea580c; --c2:#fb923c">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="stat-emoji">📅</div>
                    <div>
                        <div class="stat-label">Tanggal Mulai</div>
                        <div class="fw-bold fs-5">{{ $course->start_date?->format('d-m-Y') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card info-card shadow-sm">
        <div class="card-body p-4">
            <h2 class="h5 section-title mb-3">Deskripsi</h2>
            <p class="mb-0 text-secondary" style="white-space: pre-line;">{{ $course->description ?: '-' }}</p>
        </div>
    </div>

    {{-- Tombol --}}
    <div class="d-flex justify-content-between mt-4">
        <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary btn-soft">&larr; Kembali</a>
        <a href="{{ route('courses.edit', $course) }}" class="btn btn-main px-4 btn-soft">Edit Kursus</a>
    </div>
</div>
@endsection