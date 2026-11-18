@extends('layouts.app')

@section('title', 'Laporan Enrollment')

@section('content')
<style>
    .enr-hero {
        background: linear-gradient(135deg, #0a2a66 0%, #1558d6 55%, #38bdf8 100%);
        border-radius: 24px;
        color: #fff;
        padding: 32px;
        position: relative;
        overflow: hidden;
    }
    .enr-hero::after {
        content: "";
        position: absolute;
        right: -60px; top: -60px;
        width: 240px; height: 240px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .12);
    }
    .enr-hero::before {
        content: "";
        position: absolute;
        right: 80px; bottom: -90px;
        width: 180px; height: 180px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .08);
    }
    .enr-hero > * { position: relative; z-index: 1; }
    .enr-tag {
        display: inline-block;
        background: rgba(255, 255, 255, .18);
        border: 1px solid rgba(255, 255, 255, .35);
        padding: 4px 14px;
        border-radius: 999px;
        font-size: .75rem;
        letter-spacing: .08em;
        text-transform: uppercase;
    }
    .enr-btn {
        background: #fff;
        color: #1558d6;
        font-weight: 600;
        border-radius: 999px;
        padding: 10px 22px;
        border: 0;
        text-decoration: none;
        transition: transform .15s, box-shadow .15s;
    }
    .enr-btn:hover {
        color: #0a2a66;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, .25);
    }

    .enr-stat {
        background: #fff;
        border-radius: 18px;
        padding: 20px 22px;
        border: 1px solid #dbe7ff;
        border-left: 6px solid #1558d6;
        box-shadow: 0 6px 18px rgba(21, 88, 214, .08);
        height: 100%;
    }
    .enr-stat .num {
        font-size: 2rem;
        font-weight: 800;
        color: #0a2a66;
        line-height: 1;
    }
    .enr-stat .lbl {
        color: #5b6b8c;
        font-size: .85rem;
        margin-top: 6px;
    }

    .enr-panel {
        background: #f3f8ff;
        border-radius: 24px;
        padding: 24px;
        border: 1px solid #dbe7ff;
    }
    .enr-table {
        border-collapse: separate;
        border-spacing: 0 10px;
        margin: 0;
    }
    .enr-table thead th {
        border: 0;
        background: transparent;
        color: #1558d6;
        font-size: .75rem;
        text-transform: uppercase;
        letter-spacing: .1em;
        padding: 0 16px 4px;
    }
    .enr-table tbody tr {
        background: #fff;
        box-shadow: 0 3px 10px rgba(21, 88, 214, .07);
        transition: transform .15s, box-shadow .15s;
    }
    .enr-table tbody tr:hover {
        transform: translateX(6px);
        box-shadow: 0 8px 20px rgba(21, 88, 214, .18);
    }
    .enr-table td {
        border: 0;
        padding: 14px 16px;
        vertical-align: middle;
    }
    .enr-table td:first-child { border-radius: 14px 0 0 14px; }
    .enr-table td:last-child  { border-radius: 0 14px 14px 0; }

    .enr-no {
        width: 34px; height: 34px;
        border-radius: 10px;
        background: #e6efff;
        color: #1558d6;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .enr-avatar {
        width: 42px; height: 42px;
        border-radius: 50%;
        background: linear-gradient(135deg, #1558d6, #38bdf8);
        color: #fff;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .enr-course {
        background: #e6efff;
        color: #0a2a66;
        border-radius: 8px;
        padding: 4px 10px;
        font-weight: 600;
        font-size: .9rem;
    }
    .enr-status {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #e0f2fe;
        color: #0369a1;
        border-radius: 999px;
        padding: 5px 14px;
        font-size: .85rem;
        font-weight: 600;
        text-transform: capitalize;
    }
    .enr-status::before {
        content: "";
        width: 8px; height: 8px;
        border-radius: 50%;
        background: #0ea5e9;
        box-shadow: 0 0 0 4px rgba(14, 165, 233, .25);
    }
    .enr-empty {
        text-align: center;
        color: #5b6b8c;
        padding: 40px 0;
    }

    @@media (max-width: 576px) {
        .enr-hero { padding: 24px; }
        .enr-table tbody tr:hover { transform: none; }
    }
</style>

<div class="container py-4">

    {{-- Banner --}}
    <div class="enr-hero mb-4">
        <span class="enr-tag">Pertemuan 12 &bull; Relational Core</span>
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mt-3">
            <div>
                <h2 class="fw-bold mb-1">Laporan Enrollment KursusKu</h2>
                <p class="mb-0 opacity-75">
                    Siapa mengikuti kursus apa, dirangkai dari tabel participants, courses, dan enrollments.
                </p>
            </div>
            <a href="{{ route('enrollments.create') }}" class="enr-btn">
                + Tambah Enrollment
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-primary alert-dismissible fade show rounded-4 border-0 shadow-sm">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Statistik --}}
    <div class="row g-3 mb-4">
        <div class="col-12 col-md-4">
            <div class="enr-stat">
                <div class="num">{{ $enrollments->count() }}</div>
                <div class="lbl">Total enrollment</div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="enr-stat">
                <div class="num">{{ $enrollments->pluck('participant_id')->unique()->count() }}</div>
                <div class="lbl">Peserta terdaftar</div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="enr-stat">
                <div class="num">{{ $enrollments->pluck('course_id')->unique()->count() }}</div>
                <div class="lbl">Kursus yang diikuti</div>
            </div>
        </div>
    </div>

    {{-- Tabel --}}
    <div class="enr-panel">
        <div class="table-responsive">
            <table class="table enr-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Participant</th>
                        <th>Course</th>
                        <th>Start Date</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($enrollments as $enrollment)
                        <tr>
                            <td><span class="enr-no">{{ $loop->iteration }}</span></td>

                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <span class="enr-avatar">
                                        {{ strtoupper(substr($enrollment->participant?->name ?? '?', 0, 1)) }}
                                    </span>
                                    <div>
                                        <div class="fw-semibold">
                                            {{ $enrollment->participant?->name ?? '-' }}
                                        </div>
                                        <small class="text-secondary">
                                            {{ $enrollment->participant?->email }}
                                        </small>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <span class="enr-course">
                                    {{ $enrollment->course?->name ?? '-' }}
                                </span>
                            </td>

                            <td>
                                @if ($enrollment->course?->start_date)
                                    {{ \Carbon\Carbon::parse($enrollment->course->start_date)->format('d M Y') }}
                                @else
                                    -
                                @endif
                            </td>

                            <td>
                                <span class="enr-status">{{ $enrollment->status }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="enr-empty">
                                Belum ada enrollment. Klik "Tambah Enrollment" untuk memulai.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection