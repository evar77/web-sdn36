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
                <h5 class="card-title">Guru</h5>
                <p class="card-text">Kelola data guru</p>
                <a href="{{ route('admin.guru') }}" class="btn btn-primary">Lihat Data</a>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Ekstrakurikuler</h5>
                <p class="card-text">Kelola ekstrakurikuler</p>
                <a href="{{ route('admin.ekstrakurikuler') }}" class="btn btn-primary">Lihat Data</a>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Event Sekolah</h5>
                <p class="card-text">Kelola event sekolah</p>
                <a href="{{ route('admin.eventsekolah') }}" class="btn btn-primary">Lihat Data</a>
            </div>
        </div>
    </div>
</div>
@endsection
