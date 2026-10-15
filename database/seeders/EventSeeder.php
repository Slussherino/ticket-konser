<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('events')->insert([
            [
                'title' => 'FALL OUT BOY ASIA TOUR 2026',
                'category' => 'Musik',
                'description' => 'Fall Out Boy, band pop-punk asal Amerika Serikat, akan menggelar tur Asia pada tahun 2026.',
                'price' => 3000000,
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Lollapalooza Festival 2026',
                'category' => 'Festival',
                'description' => 'Lollapalooza adalah festival musik tahunan yang menampilkan berbagai genre musik, termasuk rock, hip-hop, dan elektronik.',
                'price' => 1500000,
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Seminar Teknologi AI 2026',
                'category' => 'Seminar',
                'description' => 'Seminar ini akan membahas perkembangan terbaru dalam teknologi kecerdasan buatan (AI) dan dampaknya pada berbagai industri.',
                'price' => 55000,
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Parenting Guidance 2026',
                'category' => 'Seminar',
                'description' => 'Parenting Guidance 2026 adalah seminar yang dibuka dengan lokal untuk mengajar dan mengarah untuk orang tua dalam menghadapi masalah dalam mendidik anak, lengkap dengan sesi presentasi, tanya jawab, dan refleksi dengan seorang ahli dan psikolog anak.',
                'price' => 40000,
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'COMIFURO EXPO 23',
                'category' => 'Festival',
                'description' => 'Comic Frontier (atau Comifuro) adalah sebuah konvensi kreatif untuk merayakan budaya pop, anime, game, dan ilustrasi.',
                'price' => 75000,
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
