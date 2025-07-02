<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opd extends Model
{
    use HasFactory;

    // Mendefinisikan primary key karena tidak menggunakan 'id'
    protected $primaryKey = 'id_opd';

    protected $fillable = [
        'nama_opd',
        'status',
    ];

    /**
     * Relasi ke model User.
     * Satu OPD bisa memiliki banyak User (pegawai).
     */
    public function users()
    {
        return $this->hasMany(User::class, 'id_opd', 'id_opd');
    }

    /**
     * Relasi ke model Sk.
     * Satu OPD bisa memiliki banyak pengajuan SK.
     */
    public function sks()
    {
        return $this->hasMany(Sk::class, 'id_opd', 'id_opd');
    }
    
    // Tambahkan relasi serupa untuk Pbs dan Lains jika diperlukan
}