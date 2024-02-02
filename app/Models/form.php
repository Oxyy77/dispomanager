<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class form extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = 'form';
    protected $fillable = [
          'kop_surat',
          'tanggal_surat',
          'hal',
          'no_surat',
          'lampiran',
          'tujuan',
          'alamat',
          'salam_pembuka',
          'isi_surat',
          'salam_penutup',
          'ttd_direktur',
          'ttd_sekretaris',
    ];
}
