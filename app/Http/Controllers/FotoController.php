<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class FotoController extends Controller
{
    public function index()
    {
        // Gunakan eager loading 'user' agar tidak error 'column not found users.id'
        $fotos = Foto::with('user')->latest()->get();
        return view('foto.index', compact('fotos'));
    }

    public function create()
    {
        $albums = Album::all();

        return view('foto.create', compact('albums'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_foto' => 'required',
            'deskripsi_foto' => 'required',
            'lokasi_file' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'album_id' => 'required'
        ]);

        $path = $request->file('lokasi_file')->store('fotos', 'public');

        Foto::create([
            'judul_foto' => $request->judul_foto,
            'deskripsi_foto' => $request->deskripsi_foto,
            'tanggal_unggah' => now(),
            'lokasi_file' => $path,
            'album_id' => $request->album_id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('foto.index')->with('success', 'Foto berhasil diunggah!');
    }

    public function show($id)
    {
        $foto = Foto::with(['user', 'komentars.user'])->findOrFail($id);
        return view('foto.show', compact('foto'));
    }

    public function edit($id)
    {
        $foto = Foto::findOrFail($id);

        if (auth()->user()->role !== 'admin' && $foto->user_id !== auth()->id()) {
            return redirect('/foto')->with('error', 'Akses dilarang!');
        }
        $albums = Album::all();

        return view('foto.edit', compact('foto', 'albums'));
    }
    public function update(Request $request, $id)
    {
        $foto = Foto::findOrFail($id);

        $request->validate([
            'judul_foto' => 'required',
            'deskripsi_foto' => 'required',
            'album_id' => 'required'
        ]);

        $foto->update([
            'judul_foto' => $request->judul_foto,
            'deskripsi_foto' => $request->deskripsi_foto,
            'album_id' => $request->album_id,
        ]);

        return redirect()->route('foto.index')->with('success', 'Foto berhasil diperbarui!');
    }

    // HANYA SATU FUNGSI DESTROY
    public function destroy($id)
    {
        $foto = Foto::findOrFail($id);

        // Cek izin
        if (auth()->user()->role !== 'admin' && $foto->user_id !== auth()->id()) {
            return back()->with('error', 'Akses ditolak!');
        }

        // Hapus file fisik
        Storage::disk('public')->delete($foto->lokasi_file);

        $foto->delete();
        return back()->with('success', 'Foto berhasil dihapus!');
    }
}