<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    protected $table = 'surat_keluars';

    protected $fillable = [
        'nomor_surat',
        'pengirim',
        'tanggal_surat',
        'perihal',
        'file'
    ];
}
