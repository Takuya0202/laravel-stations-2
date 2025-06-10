<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = [
            [
                'name' => 'アクション'
            ],
            [
                'name' => '恋愛'
            ],
            [
                'name' => 'ホラー'
            ],
        ];

        foreach ($genres as $genre) {
            Genre::create($genre);
        }
    }
}
