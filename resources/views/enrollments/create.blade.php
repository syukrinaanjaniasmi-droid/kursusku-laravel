@extends('layouts.app')

@section('title', 'Tambah Enrollment')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h1 class="h3 mb-3">Tambah Enrollment</h1>
                <p class="text-secondary">
                    Pilih peserta dan kursus. Sisa kursi dicek tanpa reload halaman.
                </p>

                <form method="POST" action="{{ route('enrollments.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="participant_id" class="form-label">Participant</label>
                        <select name="participant_id" id="participant_id"
                                class="form-select" required>
                            <option value="">-- Pilih Participant --</option>
                            @foreach ($participants as $participant)
                                <option value="{{ $participant->id }}"
                                    @selected(old('participant_id') == $participant->id)>
                                    {{ $participant->name }} - {{ $participant->email }}
                                </option>
                            @endforeach
                        </select>
                        @error('participant_id')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="course_id" class="form-label">Course</label>
                        <select name="course_id" id="course_id"
                                class="form-select" required>
                            <option value="">-- Pilih Course --</option>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}"
                                    @selected(old('course_id') == $course->id)>
                                    {{ $course->code }} - {{ $course->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('course_id')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div id="availability" class="alert alert-secondary">
                        Pilih kursus untuk melihat sisa kursi.
                    </div>

                    <button class="btn btn-success" type="submit">
                        Simpan Enrollment
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('course_id').addEventListener('change', async function () {
    const box = document.getElementById('availability');

    if (!this.value) {
        box.className = 'alert alert-secondary';
        box.textContent = 'Pilih kursus untuk melihat sisa kursi.';
        return;
    }

    try {
        const res = await fetch(`/courses/${this.value}/availability`);
        if (!res.ok) throw new Error('gagal');
        const d = await res.json();

        box.className = d.remaining > 0 ? 'alert alert-success' : 'alert alert-danger';
        box.textContent = `${d.course}: sisa ${d.remaining} dari ${d.quota} kursi.`;
    } catch (e) {
        box.className = 'alert alert-warning';
        box.textContent = 'Gagal memuat data kursi.';
    }
});
</script>
@endsection