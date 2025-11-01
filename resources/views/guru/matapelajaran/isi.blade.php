<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $course->nama }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

    <div class="container">
        <h1 class="mb-3">{{ $course->nama }}</h1>
        <p>{{ $course->deskripsi }}</p>

        <h2 class="mt-4">Daftar Materi</h2>

        @if($materi->isNotEmpty())
            <ul class="list-group mt-2">
                @foreach($materi as $m)
                    <li class="list-group-item">{{ $m->judul }}</li>
                @endforeach
            </ul>
        @else
            <div class="alert alert-warning mt-3">Belum ada materi di course ini.</div>
        @endif
    </div>

</body>
</html>
