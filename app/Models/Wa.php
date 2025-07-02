<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wa extends Model
{
    use HasFactory;

    protected $table = 'was';

    protected $fillable = [
        'id_opd',
        'no_wa',
    ];

    /**
     * Relasi ke model Opd.
     * Nomor WA ini milik satu OPD.
     */
    public function opd()
    {
        return $this->belongsTo(Opd::class, 'id_opd', 'id_opd');
    }
}