<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();



        \App\Models\Role::factory()->create([
            'nama_role' => 'Administrator',
        ]);
        \App\Models\Role::factory()->create([
            'nama_role' => 'Tenant',
        ]);

        \App\Models\Membership::factory()->create([
            'nama_membership' => 'Bronze',
            'harga'=>100000,
            'pesan_maksimum'=>5000,
            'device'=>1,
            'support'=>'Email',
            'fitur'=>'Kirim Pesan Teks,Terbatas pada 1 Nomor WhatsApp (Device),Statistik Pengiriman Bulanan',
            'status_membership'=>1
        ]);

        \App\Models\Membership::factory()->create([
            'nama_membership' => 'Silver',
            'harga'=>200000,
            'device'=>3,
            'pesan_maksimum'=>15000,
            'support'=>'Email dan Chat',
            'fitur'=>'Kirim Pesan Gambar,Kirim Pesan Audio,Terbatas pada 3 Nomor WhatsApp (Device),Statistik Pengiriman Mingguan',
            'status_membership'=>1
        ]);

        \App\Models\Membership::factory()->create([
            'nama_membership' => 'Gold',
            'harga'=>300000,
            'device'=>0,
            'pesan_maksimum'=>30000,
            'support'=>'Email , Chat dan Telephone',
            'fitur'=>'Kirim Pesan Video,Kirim Pesan Dokumen,Kirim Pesan Lokasi,Unlimited Nomor WhatsApp,Statistik Pengiriman Harian,Integrasi API untuk Otomatisasi ',
            'status_membership'=>1
        ]);


        \App\Models\User::factory()->create([
            'name' => 'administrator',
            'email' => 'admin@gmail.com',
            'role_id' => 1,
            'password' => Hash::make('admin123'),
        ]);
    }
}
