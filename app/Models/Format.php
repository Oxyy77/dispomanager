<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Format extends Model
{
    protected $table = 'format';
    protected $fillable = [
        'kategori_surat', // tambahkan ini
        'format_surat',
        'user_id'
    ];
    use HasFactory;

    public function surat ()
    {
        return $this->hasMany(Surat::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'format_user')->withTimestamps();
    }

    
}
