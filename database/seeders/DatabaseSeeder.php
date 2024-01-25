<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Surat;
use App\Models\Format;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        User::factory()->create([
            'name' => 'ilham',
            'email' => 'ilhmoxy@gmail.com',
            'role' => 'direktur',
            'password'=> bcrypt('12345678')
        ]);

        User::factory()->create([
            'name' => 'sekre',
            'email' => 'sekre@gmail.com',
            'role' => 'sekretaris',
            'password'=> bcrypt('12345678')
        ]);

        User::factory()->create([
            'name' => 'kurir',
            'email' => 'kurir@gmail.com',
            'role' => 'kurir',
            'password'=> bcrypt('12345678')
        ]);
        
        Format::create([
            'format_surat' => '001/pt/U',
            'kategori_surat' => 'Undangan',
        ]);

        Format::create([
            'format_surat' => '002/pt/S',
            'kategori_surat' => 'Sertifikat',
        ]);

        Format::create([
            'format_surat' => '003/pt/R',
            'kategori_surat' => 'Rapat',
        ]);

        Surat::create([
            'user_id' => 1,
            'format_id' => 1,
            'no_surat' => '001/pt/U/1',
            'kategori_surat' => 'Undangan',
            'jenis_surat' => 'Surat Masuk',
            'status_surat' => 'Sudah Dibaca',
            'nama_file' => 'ilham.pdf',
        ]);
        
    }
}
