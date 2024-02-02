<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $table = 'surat';
    protected $primaryKey = 'id'; // Sesuaikan dengan nama kunci utama yang Anda gunakan

    protected $fillable = [
        'kategori_surat', // tambahkan ini
        'no_surat',
        'user_id',
        'format_id',
        'nama_surat',
        'pengirim',
        'nama_file',
        'jenis_surat',
        'status_surat'
    ];


    use HasFactory;

    public function format()
    {
        return $this->belongsToMany(Format::class, 'format_user', 'user_id', 'format_id');
    }

    public function pengiriman()
    {
        return $this->hasOne(Pengiriman::class, 'surat_id');
    }
}
