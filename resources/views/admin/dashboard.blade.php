@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12 mb-4">
        <h2>Dashboard</h2>
    </div>
</div>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h5 class="card-title">Guru</h5>
                        <h2 class="mb-3">{{ $total_guru }}</h2>
                        <p class="card-text">Total data guru</p>
                    </div>
                    <div class="bg-primary rounded-circle p-3">
                        <i class="bi bi-person-badge text-white fs-4"></i>
                    </div>
                </div>
                <a href="{{ route('admin.guru') }}" class="btn btn-primary mt-3">Kelola Data</a>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h5 class="card-title">Ekstrakurikuler</h5>
                        <h2 class="mb-3">{{ $total_ekstrakurikuler }}</h2>
                        <p class="card-text">Total ekstrakurikuler</p>
                    </div>
                    <div class="bg-success rounded-circle p-3">
                        <i class="bi bi-people text-white fs-4"></i>
                    </div>
                </div>
                <a href="{{ route('admin.ekstrakurikuler') }}" class="btn btn-success mt-3">Kelola Data</a>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h5 class="card-title">Event Sekolah</h5>
                        <h2 class="mb-3">{{ $total_event }}</h2>
                        <p class="card-text">Total event sekolah</p>
                    </div>
                    <div class="bg-warning rounded-circle p-3">
                        <i class="bi bi-calendar-event text-white fs-4"></i>
                    </div>
                </div>
                <a href="{{ route('admin.eventsekolah') }}" class="btn btn-warning mt-3">Kelola Data</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">Guru Terbaru</h5>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    @forelse($guru_terbaru as $guru)
                        <div class="list-group-item">
                            <div class="d-flex align-items-center">
                                @if($guru->foto)
                                    <img src="{{ asset('storage/' . $guru->foto) }}" alt="Foto {{ $guru->nama_lengkap }}" class="rounded-circle me-3" style="width: 40px; height: 40px; object-fit: cover;">
                                @else
                                    <div class="rounded-circle bg-secondary me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <i class="bi bi-person text-white"></i>
                                    </div>
                                @endif
                                <div>
                                    <h6 class="mb-0">{{ $guru->nama_lengkap }}</h6>
                                    <small class="text-muted">{{ $guru->jabatan }}</small>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="list-group-item">Belum ada data guru</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="card-title mb-0">Ekstrakurikuler Terbaru</h5>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    @forelse($ekstrakurikuler_terbaru as $ekskul)
                        <div class="list-group-item">
                            <div class="d-flex align-items-center">
                                @if($ekskul->foto)
                                    <img src="{{ asset('storage/' . $ekskul->foto) }}" alt="Foto {{ $ekskul->nama }}" class="rounded me-3" style="width: 40px; height: 40px; object-fit: cover;">
                                @else
                                    <div class="rounded bg-secondary me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <i class="bi bi-people text-white"></i>
                                    </div>
                                @endif
                                <div>
                                    <h6 class="mb-0">{{ $ekskul->nama }}</h6>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="list-group-item">Belum ada data ekstrakurikuler</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-warning text-white">
                <h5 class="card-title mb-0">Event Sekolah Terbaru</h5>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    @forelse($event_terbaru as $event)
                        <div class="list-group-item">
                            <div class="d-flex align-items-center">
                                @if($event->foto)
                                    <img src="{{ asset('storage/' . $event->foto) }}" alt="Foto {{ $event->nama_event }}" class="rounded me-3" style="width: 40px; height: 40px; object-fit: cover;">
                                @else
                                    <div class="rounded bg-secondary me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <i class="bi bi-calendar-event text-white"></i>
                                    </div>
                                @endif
                                <div>
                                    <h6 class="mb-0">{{ $event->nama_event }}</h6>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="list-group-item">Belum ada data event</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
