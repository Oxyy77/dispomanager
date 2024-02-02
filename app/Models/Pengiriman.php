<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Surat;

class Pengiriman extends Model
{
    protected $table = 'pengiriman';

    protected $fillable = [
        'user_id',
        'surat_id',
        'no_surat',
        'nama_surat',
        'jenis_surat',
        'status_pengiriman',
        'file_surat',
        'pengirim'   
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Model Pengiriman
    public function surat()
    {
        return $this->belongsTo(Surat::class, 'surat_id');
    }


}
