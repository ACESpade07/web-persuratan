<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Arsip extends Model
{
    protected $table = 'arsip';

    protected $fillable = [
        'nomor_surat',
        'jenis',
        'kontak',
        'perihal',
        'tanggal_surat',
        'file',
        'surat_id',
    ];
}