@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tambah Soal untuk: {{ $materi->judul }}</h3>

    <form action="{{ route('guru.soal.store', $materi->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="pertanyaan" class="form-label">Pertanyaan</label>
            <textarea name="pertanyaan" id="pertanyaan" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="jawaban_benar" class="form-label">Jawaban Benar</label>
            <input type="text" name="jawaban_benar" id="jawaban_benar" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Simpan Soal</button>
    </form>
</div>
@endsection
