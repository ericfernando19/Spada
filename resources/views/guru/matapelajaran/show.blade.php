@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>{{ $course->judul }}</h2>
        <p>{{ $course->deskripsi }}</p>

        <hr>

        <h4>📘 Daftar Materi</h4>
        @if ($materis->count() > 0)
            <ul>
                @foreach ($materis as $materi)
                    <li>
                        <strong>{{ $materi->judul }}</strong>
                        <p>{{ $materi->deskripsi }}</p>
                        <a href="{{ route('guru.materi.show', $materi->id) }}" class="btn btn-sm btn-primary">Lihat Materi</a>
                    </li>
                @endforeach
            </ul>
        @else
            <p>Belum ada materi untuk course ini.</p>
        @endif

        <a href="{{ route('guru.materi.create', $course->id) }}" class="btn btn-success">Tambah Materi</a>

        <hr>

        <h4>🧩 Daftar Soal / Kuis</h4>
        @if ($soals->count() > 0)
            <ul>
                @foreach ($soals as $soal)
                    <li>{{ $soal->pertanyaan }}</li>
                @endforeach
            </ul>
        @else
            <p>Belum ada soal untuk course ini.</p>
        @endif

        <a href="{{ route('guru.soal.create', ['materi_id' => $materi->id]) }}" class="btn btn-primary">
            Tambah Soal
        </a>

    </div>
@endsection
