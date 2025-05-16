<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .card-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
            padding: 2rem 0;
        }
        .card {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }
        .card-text {
            overflow: hidden;
            max-height: 100px;
            transition: max-height 0.3s ease;
            color: #666;
        }
        .card-text.expanded {
            max-height: 500px;
        }
        .btn-link {
            color: #0d6efd;
            text-decoration: none;
            padding: 0;
        }
        .btn-link:hover {
            text-decoration: underline;
        }
        .navbar {
            background-color: #fff !important;
        }
        .navbar-brand {
            font-size: 1.2rem;
        }
        .nav-link {
            color: #333 !important;
            font-weight: 500;
        }
        .nav-link:hover {
            color: #0d6efd !important;
        }
    </style>
</head>
<body>
    <nav class="navbar bg-body-tertiary fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="/image/logotut.png" alt="Logo" width="50" height="50" class="d-inline-block">
                <span class="ms-3 fw-bold">SD NEGERI 36 PONTIANAK SELATAN</span>
            </a>
            <ul class="navbar-nav ms-auto d-flex flex-row">
                <li class="nav-item me-3">
                    <a class="nav-link" href="#About">About</a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link" href="#Visi dan Misi">Visi dan Misi</a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link" href="#Contact">Contact</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5 pt-5">
        <h2 class="text-center mb-4">Event Sekolah</h2>
        <div class="card-container">
            @foreach($event as $key => $ev)
            <div class="card">
                @if($ev->foto)
                    <img src="{{ asset('storage/' . $ev->foto) }}" class="card-img-top" alt="{{ $ev->nama_event }}">
                @else
                    <img src="/image/pramuka.png" class="card-img-top" alt="Default Image">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $ev->nama_event }}</h5>
                    <p class="card-text" id="desc{{ $key }}">
                        {!! nl2br(e($ev->deskripsi)) !!}
                    </p>
                    <button class="btn btn-link p-0" onclick="toggleDescription('desc{{ $key }}', this)">
                        <i class="fas fa-chevron-down"></i> Lihat selengkapnya
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <script>
        function toggleDescription(id, btn) {
            const desc = document.getElementById(id);
            const icon = btn.querySelector('i');
            desc.classList.toggle('expanded');
            
            if (desc.classList.contains('expanded')) {
                btn.innerHTML = '<i class="fas fa-chevron-up"></i> Lihat lebih sedikit';
            } else {
                btn.innerHTML = '<i class="fas fa-chevron-down"></i> Lihat selengkapnya';
            }
        }
    </script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script> -->
</body>
</html>