<?php
namespace App\Http\Controllers;

use App\Models\LikeFoto;
use App\Models\KomentarFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InteraksiController extends Controller
{
    public function like($fotoId)
    {
        $existingLike = LikeFoto::where('foto_id', $fotoId)->where('user_id', Auth::id())->first();

        if ($existingLike) {
            $existingLike->delete(); // Unlike jika sudah pernah like
        } else {
            LikeFoto::create([
                'foto_id' => $fotoId,
                'user_id' => Auth::id(),
                'tanggal_like' => now(),
            ]);
        }
        return back();
    }

    public function komentar(Request $request, $fotoId)
    {
        $request->validate(['isi_komentar' => 'required']);

        KomentarFoto::create([
            'foto_id' => $fotoId,
            'user_id' => Auth::id(),
            'isi_komentar' => $request->isi_komentar,
            'tanggal_komentar' => now(),
        ]);

        return back()->with('success', 'Komentar ditambahkan!');
    }
}