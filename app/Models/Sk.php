<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sk extends Model
{
    use HasFactory;

    protected $table = 'sks'; // Nama tabel

    protected $fillable = [
        'no_urut', 'kode_sk', 'id_opd', 'tgl_pengajuan', 'perihal', 
        'pemohon', 'tgl_terima', 'tahap1', 'ket1', 'tahap2', 'ket2',
        'tahap3', 'ket3', 'tahap4', 'ket4', 'tahap5', 'ket5',
        'tahap6', 'ket6', 'catatan', 'status', 'tahun', 'no_sk'
    ];
    
    // Casts untuk memastikan kolom tanggal/waktu di-handle sebagai objek Carbon
    protected $casts = [
        'tgl_pengajuan' => 'date',
        'tgl_terima' => 'date',
        'tahap1' => 'datetime',
        'tahap2' => 'datetime',
        'tahap3' => 'datetime',
        'tahap4' => 'datetime',
        'tahap5' => 'datetime',
        'tahap6' => 'datetime',
    ];

    /**
     * Relasi ke model Opd.
     * Satu SK pasti dimiliki oleh satu OPD.
     */
    public function opd()
    {
        return $this->belongsTo(Opd::class, 'id_opd', 'id_opd');
    }

    /**
     * Relasi polymorphic ke model Bon.
     * Satu SK bisa memiliki banyak catatan peminjaman (bon).
     */
    public function bons()
    {
        return $this->morphMany(Bon::class, 'bonable');
    }
}