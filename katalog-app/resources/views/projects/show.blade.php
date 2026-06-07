<!DOCTYPE html>
<html>
<head>
    <title>{{ $project->title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            background: #f9f9f9;
        }
        .container {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .gallery img {
            width: 200px;
            margin: 10px;
            border-radius: 8px;
        }
        .btn-back {
            display: inline-block;
            margin-top: 20px;
            padding: 8px 12px;
            background: #333;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>{{ $project->title }}</h1>
        <p><strong>Kategori:</strong> {{ $project->category->name ?? '-' }}</p>
        <p><strong>Lokasi:</strong> {{ $project->location ?? '-' }}</p>
        <p><strong>Klien:</strong> {{ $project->client_name ?? '-' }}</p>
        <p><strong>Tanggal:</strong> {{ $project->project_date ?? '-' }}</p>
        <p><strong>Status:</strong> {{ $project->status ?? '-' }}</p>
        <p>{{ $project->description }}</p>

        <h3>Galeri Project</h3>
        <div class="gallery">
            @forelse($project->images as $image)
                <img src="{{ asset($image->image_path) }}" alt="Project Image">
            @empty
                <p>Tidak ada gambar.</p>
            @endforelse
        </div>

        <a href="{{ route('projects.index') }}" class="btn-back">Kembali</a>
    </div>
</body>
</html>
