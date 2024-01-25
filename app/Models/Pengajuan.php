<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    protected $table = 'pengajuan';
    protected $primaryKey = 'id'; // Sesuaikan dengan nama kunci utama yang Anda gunakan

    protected $fillable = [
        'kategori_surat', // tambahkan ini
        'no_surat',
        'user_id',
        'format_id',
        'nama_surat',
        'nama_file',
        'jenis_surat',
        'status_pengajuan'
    ];

     


    use HasFactory;
}
