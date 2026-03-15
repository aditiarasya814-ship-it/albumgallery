<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
{
    // Fungsi pembantu untuk cek Admin
    private function isAdmin() {
        if (auth()->user()->role !== 'admin') {
            return false;
        }
        return true;
    }

    public function index()
    {
        if (!$this->isAdmin()) return redirect('/foto')->with('error', 'Akses khusus Admin!');
        
        // Admin melihat semua album
        $albums = Album::withCount('fotos')->get();
        return view('album.index', compact('albums'));
    }

    public function create()
    {
        if (!$this->isAdmin()) return redirect('/foto')->with('error', 'Akses khusus Admin!');
        return view('album.create');
    }

    public function store(Request $request)
    {
        if (!$this->isAdmin()) return redirect('/foto')->with('error', 'Akses khusus Admin!');

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
        if (!$this->isAdmin()) return redirect('/foto')->with('error', 'Akses khusus Admin!');

        $album = Album::findOrFail($id);
        $album->delete();
        
        return back()->with('success', 'Album berhasil dihapus!');
    }
}