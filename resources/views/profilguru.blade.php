<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Guru - SD Negeri 36 Pontianak Selatan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .teacher-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            
        }
        .table-container {
            margin-top: 120px;
        }
        thead.table th {
            background-color: #1c7bbc;
            color: white;
        }
    </style>
</head>
<body>
    <nav class="navbar bg-body-tertiary fixed-top shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="/image/logotut.png" alt="Logo" width="50" height="50" class="d-inline-block">
                <span class="ms-3 fw-bold">SD NEGERI 36 PONTIANAK SELATAN</span>
            </a>
            <ul class="navbar-nav ms-auto d-flex flex-row py-4 px-5">
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

    <div class="container table-container">
        <h2 class="mb-4">Profil Guru</h2>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Nama Lengkap</th>
                        <th scope="col">NIP</th>
                        <th scope="col">Jabatan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($guru as $key => $g)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>
                            @if($g->foto)
                                <img src="{{ asset('storage/' . $g->foto) }}" alt="Foto Guru" class="teacher-image">
                            @else
                                <img src="/image/default-teacher.png" alt="Default Foto" class="teacher-image">
                            @endif
                        </td>
                        <td>{{ $g->nama_lengkap }}</td>
                        <td>{{ $g->nomor_induk }}</td>
                        <td>{{ $g->jabatan }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>