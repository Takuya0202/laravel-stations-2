<?php

namespace Database\Seeders;

use App\Models\Screen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScreenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $screens = [
            [
                'name' => 'スクリーン1'
            ],
            [
                'name' => 'スクリーン2'
            ],
            [
                'name' => 'スクリーン3'
            ]
            ];

        foreach ($screens as $screen) {
            Screen::create($screen);
        }
    }
}
