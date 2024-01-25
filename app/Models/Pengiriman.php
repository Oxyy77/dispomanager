<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    protected $table = 'pengiriman';

    protected $fillable = [
        'user_id',
        'no_surat',
        'nama_surat',
        'jenis_surat',
        'status_pengiriman',
        'file_surat',     
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
