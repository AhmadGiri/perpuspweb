<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Buku extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function peminjaman()
    {
        return $this->hasMany(peminjaman::class);
    }

    protected $table = 'bukus';

    protected $fillable = [
        'kode_buku',
        'judul',
        'pengarang',
        'penerbit',
        'stok',
    ];
}
 