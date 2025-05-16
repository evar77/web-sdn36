<?php

namespace App\Http\Controllers;

use App\Models\EventSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventSekolahController extends Controller 
{
    public function index() //tampil semua data event dari database
    {
        $event = EventSekolah::all();
        return view('admin.list_eventsekolah', compact('event'));
    }
    public function create() //tampil form tambah event sekolah
    {
        return view ('admin.tambah_eventsekolah');
    }
    public function store(Request $request)
    {
        $request -> validate([ //validsi input
            'nama_event' => 'required|unique:eventsekolah', //nama harus unik di tabel ekskul
            'deskripsi' => 'required',
            'foto' => 'nullable|file|mimes:jpeg,png,jpg',
        ]);

        $data = $request -> only(['nama_event','deskripsi']);

        if ($request->hasFile('foto')) {
            try {
                $foto = $request->file('foto');
                $fotoName = time() . '_' . $foto->getClientOriginalName();
                
                // Simpan file ke storage/app/public/image
                $path = $foto->storeAs('image', $fotoName, 'public');
                
                if ($path) {
                    // Simpan path relatif ke database
                    $data['foto'] = $path;
                } else {
                    return redirect()->back()->with('error', 'Gagal menyimpan file foto');
                }
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
            }
        }
        EventSekolah::create($data);

        return redirect() -> route('admin.eventsekolah') -> with('success', 'Data event sekolah telah ditambahkan');
    }
    public function edit($id)
    {
        $event = EventSekolah::findOrFail($id);
        return view('admin.edit_eventsekolah', compact('event'));
    }
    public function update(Request $request, $id)
    {
        $request -> validate([
            'nama_event' => 'required|unique:eventsekolah,nama_event,'.$id,
            'deskripsi' => 'required',
            'foto' => 'nullable|file|mimes:jpeg,png,jpg',
        ]);

        $event = EventSekolah::findOrFail($id);
        $data = $request -> only(['nama_event','deskripsi']);

        if ($request->hasFile('foto')) {
            try {
                // Hapus foto lama jika ada
                if ($event->foto) {
                    Storage::disk('public')->delete($event->foto);
                }
                
                $foto = $request->file('foto');
                $fotoName = time() . '_' . $foto->getClientOriginalName();
                
                // Simpan file ke storage/app/public/image
                $path = $foto->storeAs('image', $fotoName, 'public');
                
                if ($path) {
                    // Simpan path relatif ke database
                    $data['foto'] = $path;
                } else {
                    return redirect()->back()->with('error', 'Gagal menyimpan file foto');
                }
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
            }
        }

        $event -> update($data);
        return redirect() -> route('admin.eventsekolah') -> with('success', 'Data event sekolah telah diupdate');
    }
    public function destroy($id)
    {
        $event = EventSekolah::findOrFail($id);
        if ($event -> foto) {
            Storage::delete('public/' . $event -> foto);
        }
        $event -> delete();
        return redirect() -> route('admin.eventsekolah') -> with('success', 'Data event sekolah telah dihapus');
    }

    public function showEvents()
    {
        $event = EventSekolah::all();
        return view('eventsekolah', compact('event'));
    }
}