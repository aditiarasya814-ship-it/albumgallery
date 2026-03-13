<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
{
    public function index()
    {
                $albums = Album::where('user_id', Auth::id())->withCount('fotos')->get();
        return view('album.index', compact('albums'));
    }

    public function create()
    {
        return view('album.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_album' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        Album::create([
            'nama_album' => $request->nama_album,
            'deskripsi' => $request->deskripsi,
            'tanggal_dibuat' => now(),
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('album.index')->with('success', 'Album berhasil dibuat!');
    }

    public function destroy($id)
    {
        $album = Album::findOrFail($id);
        if ($album->user_id == Auth::id()) {
            $album->delete();
            return back()->with('success', 'Album berhasil dihapus!');
        }
        return back()->with('error', 'Aksi tidak diizinkan.');
    }
}