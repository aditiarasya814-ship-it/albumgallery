<?php

namespace App\Http\Controllers;

use App\Models\KomentarFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InteraksiController extends Controller
{
    public function komentar(Request $request, $fotoId)
    {
        $request->validate([
            'isi_komentar' => 'required|string'
        ]);

        KomentarFoto::create([
            'foto_id'        => $fotoId,
            'user_id'        => Auth::id(),
            'isi_komentar'   => $request->isi_komentar,
            'tanggal_komentar' => now(),
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan!');
    }
}