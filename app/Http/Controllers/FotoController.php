<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class FotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fotos = Foto::with('user')->latest()->get();
        return view('foto.index', compact('fotos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $albums = Album::where('user_id', Auth::id())->get();
        return view('foto.create', compact('albums'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul_foto' => 'required',
            'deskripsi_foto' => 'required',
            'lokasi_file' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'album_id' => 'required'
        ]);

        // Simpan file ke folder storage/app/public/fotos
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

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Mengambil foto beserta relasi user dan komentar (beserta user komentarnya)
        $foto = Foto::with(['user', 'komentars.user'])->findOrFail($id);
        return view('foto.show', compact('foto'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Foto $foto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Foto $foto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $foto = Foto::findOrFail($id);
        if ($foto->user_id == Auth::id()) {
            Storage::disk('public')->delete($foto->lokasi_file);
            $foto->delete();
            return back()->with('success', 'Foto dihapus!');
        }

        return back()->with('error', 'Tidak diizinkan!');
    }
}
