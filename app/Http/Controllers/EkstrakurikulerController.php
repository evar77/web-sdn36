<?php

namespace App\Http\Controllers;

use App\Models\Ekstrakurikuler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EkstrakurikulerController extends Controller 
{
    public function index() //tampil semua data ekskul dari database
    {
        $ekskul = Ekstrakurikuler::all();
        return view('admin.list_ekstrakurikuler', compact('ekskul'));
    }
    public function create() //tampil form tambah ekskul
    {
        return view ('admin.tambah_ekstrakurikuler');
    }
    public function store(Request $request)
    {
        $request->validate([ //validasi input
            'nama' => 'required|unique:ekstrakurikuler',
            'deskripsi' => 'required',
            'foto' => 'nullable|file|mimes:jpeg,png,jpg',
        ]);

        $data = $request->only(['nama','deskripsi']);

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
        Ekstrakurikuler::create($data);

        return redirect()->route('admin.ekstrakurikuler')->with('success', 'Data ekstrakurikuler berhasil ditambahkan');
    }
    public function edit($id)
    {
        $ekskul = Ekstrakurikuler::findOrFail($id);
        return view('admin.edit_ekstrakurikuler', compact('ekskul'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|unique:ekstrakurikuler,nama,'.$id,
            'deskripsi' => 'required',
            'foto' => 'nullable|file|mimes:jpeg,png,jpg',
        ]);

        $ekskul = Ekstrakurikuler::findOrFail($id);
        $data = $request->only(['nama','deskripsi']);

        if ($request->hasFile('foto')) {
            try {
                // Hapus foto lama jika ada
                if ($ekskul->foto) {
                    Storage::disk('public')->delete($ekskul->foto);
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

        $ekskul->update($data);
        return redirect()->route('admin.ekstrakurikuler')->with('success', 'Data ekstrakurikuler telah diupdate');
    }
    public function destroy($id)
    {
        $ekskul = Ekstrakurikuler::findOrFail($id);
        if ($ekskul -> foto) {
            Storage::delete('public/' . $ekskul -> foto);
        }
        $ekskul -> delete();
        return redirect() -> route('admin.ekstrakurikuler') -> with('success', 'Data ekstrakurikuler telah dihapus');
    }
}