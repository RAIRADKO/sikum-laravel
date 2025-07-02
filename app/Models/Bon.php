<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bon extends Model
{
    use HasFactory;

    protected $fillable = [
        'bonable_id',
        'bonable_type',
        'peminjam',
        'tgl_pinjam',
        'tgl_kembali',
    ];

    protected $casts = [
        'tgl_pinjam' => 'date',
        'tgl_kembali' => 'date',
    ];

    /**
     * Mendefinisikan relasi polymorphic.
     * Sebuah bon bisa dimiliki oleh SK, PB, atau Lainnya.
     */
    public function bonable()
    {
        return $this->morphTo();
    }
}