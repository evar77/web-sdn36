<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Ekstrakurikuler;
use App\Models\EventSekolah;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'total_guru' => Guru::count(),
            'guru_terbaru' => Guru::latest()->take(5)->get(),
            'total_ekstrakurikuler' => Ekstrakurikuler::count(),
            'ekstrakurikuler_terbaru' => Ekstrakurikuler::latest()->take(5)->get(),
            'total_event' => EventSekolah::count(),
            'event_terbaru' => EventSekolah::latest()->take(5)->get(),
        ];

        return view('admin.dashboard', $data);
    }
} 