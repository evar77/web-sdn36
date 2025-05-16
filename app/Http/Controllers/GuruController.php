<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{
    public function index()
    {
        $guru = Guru::all();
        return view('admin.list_guru', compact('guru'));
    }

    public function create()
    {
        return view('admin.tambah_guru');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_induk' => 'required|unique:guru',
            'nama_lengkap' => 'required',
            'jabatan' => 'required',
            'foto' => 'nullable|file|mimes:jpeg,png,jpg',
        ]);

        $data = $request->only(['nomor_induk', 'nama_lengkap', 'jabatan']);

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

        Guru::create($data);

        return redirect()->route('admin.guru')->with('success', 'Data guru berhasil ditambahkan');
    }

    public function edit($nomor_induk)
    {
        $guru = Guru::findOrFail($nomor_induk);
        return view('admin.edit_guru', compact('guru'));
    }

    public function update(Request $request, $nomor_induk)
    {
        $request->validate([
            'nomor_induk' => 'required|unique:guru,nomor_induk,' . $nomor_induk . ',nomor_induk',
            'nama_lengkap' => 'required',
            'jabatan' => 'required',
            'foto' => 'nullable|file|mimes:jpeg,png,jpg',
        ]);

        $guru = Guru::findOrFail($nomor_induk);
        $data = $request->only(['nomor_induk', 'nama_lengkap', 'jabatan']);

        if ($request->hasFile('foto')) {
            try {
                // Hapus foto lama jika ada
                if ($guru->foto) {
                    Storage::disk('public')->delete($guru->foto);
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

        $guru->update($data);

        return redirect()->route('admin.guru')->with('success', 'Data guru berhasil diupdate');
    }

    public function destroy($nomor_induk)
    {
        $guru = Guru::findOrFail($nomor_induk);
        if ($guru->foto) {
            Storage::delete('public/' . $guru->foto);
        }
        $guru->delete();
        return redirect()->route('admin.guru')->with('success', 'Data guru berhasil dihapus');
    }
}
