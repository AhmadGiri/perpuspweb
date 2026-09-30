<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KatalogController extends Controller
{
    public function index()
    {
        $bukus = Buku::where('stok', '>', 0)->get();

        $riwayat = Peminjaman::with('buku')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('user.katalog', compact('bukus', 'riwayat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:bukus,id',
            'tanggal_kembali' => 'required|date|after:today',
        ]);

        $buku = Buku::findOrFail($request->buku_id);

        if ($buku->stok <= 0) {
            return redirect()->back()->with(
                'error',
                'Buku tidak tersedia untuk dipinjam.'
            );
        }

        Peminjaman::create([
            'user_id' => auth()->id(),
            'buku_id' => $buku->id,
            'tanggal_pinjam' => now(),
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => 'dipinjam',
        ]);

        $buku->decrement('stok');

        return redirect()->back()->with(
            'success',
            'Buku berhasil dipinjam. Silakan ambil buku di perpustakaan.'
        );
    }

    public function kembali($id)
    {
        DB::transaction(function () use ($id) {

            $peminjaman = Peminjaman::with('buku')->where('user_id', auth()->id())->where('id', $id)->lockForUpdate()->firstOrFail();

            if ($peminjaman->status !== 'dipinjam') {
                abort(422, 'Buku ini sudah dikembalikan.');
            }

            $peminjaman->update([
                'status' => 'dikembalikan',
            ]);

            $peminjaman->buku->increment('stok');
        });

        return redirect()->back()->with(
            'success',
            'Buku berhasil dikembalikan.'
        );
    }
}
