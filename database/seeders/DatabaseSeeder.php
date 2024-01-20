<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
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
    }
}
