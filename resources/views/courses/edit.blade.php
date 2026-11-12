@extends('layouts.app')

@section('title', 'Edit Kursus')

@section('content')
<div class="course-edit-page">
    <div class="course-edit-container">

        <div class="course-edit-header">
            <div>
                <h1 class="course-edit-title">Edit Kursus</h1>
                <p class="course-edit-subtitle">
                    Perbarui informasi kursus.
                </p>
            </div>

            <a href="{{ route('courses.show', $course) }}"
               class="course-edit-back">
                ← Kembali
            </a>
        </div>

        <form method="POST"
              action="{{ route('courses.update', $course) }}"
              class="course-edit-card">

            @csrf
            @method('PUT')

            <div class="edit-field">
                <label for="code">Kode Kursus</label>
                <input type="text"
                       id="code"
                       name="code"
                       value="{{ old('code', $course->code) }}"
                       placeholder="Contoh: WEB-01"
                       class="@error('code') is-invalid @enderror"
                       required>
                @error('code')
                    <small class="edit-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- NAMA --}}
            <div class="edit-field">
                <label for="name">Nama Kursus</label>
                <input type="text"
                       id="name"
                       name="name"
                       value="{{ old('name', $course->name) }}"
                       placeholder="Masukkan nama kursus"
                       class="@error('name') is-invalid @enderror"
                       required>
                @error('name')
                    <small class="edit-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="edit-field">
                <label for="description">Deskripsi</label>
                <textarea id="description"
                          name="description"
                          rows="3"
                          placeholder="Deskripsi kursus"
                          class="@error('description') is-invalid @enderror">{{ old('description', $course->description) }}</textarea>
                @error('description')
                    <small class="edit-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="edit-row">
                <div class="edit-field">
                    <label for="fee">Biaya (Rp)</label>
                    <input type="number"
                           id="fee"
                           name="fee"
                           min="0"
                           value="{{ old('fee', $course->fee) }}"
                           class="@error('fee') is-invalid @enderror"
                           required>
                    @error('fee')
                        <small class="edit-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="edit-field">
                    <label for="quota">Kuota</label>
                    <input type="number"
                           id="quota"
                           name="quota"
                           min="1"
                           max="500"
                           value="{{ old('quota', $course->quota) }}"
                           class="@error('quota') is-invalid @enderror"
                           required>
                    @error('quota')
                        <small class="edit-error">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="edit-row">
                <div class="edit-field">
                    <label for="start_date">Tanggal Mulai</label>
                    <input type="date"
                           id="start_date"
                           name="start_date"
                           value="{{ old('start_date', $course->start_date?->format('Y-m-d')) }}"
                           class="@error('start_date') is-invalid @enderror">
                    @error('start_date')
                        <small class="edit-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="edit-field">
                    <label for="status">Status</label>
                    <select id="status"
                            name="status"
                            class="@error('status') is-invalid @enderror"
                            required>
                        @foreach (['draft' => 'Draft', 'open' => 'Open', 'closed' => 'Closed'] as $value => $label)
                            <option value="{{ $value }}"
                                @selected(old('status', $course->status) === $value)>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('status')
                        <small class="edit-error">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="edit-actions">
                <a href="{{ route('courses.show', $course) }}"
                   class="edit-btn-cancel">
                    Batal
                </a>

                <button type="submit" class="edit-btn-save">
                    ✓ Simpan Perubahan
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
