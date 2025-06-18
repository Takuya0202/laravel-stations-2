<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\Schedule;
use App\Models\Screen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScheduleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $movies = Movie::all();
        $screenId = Screen::pluck('id')->all();
        foreach ($movies as $mv) {
            Schedule::factory(3)->create([
                'movie_id' => $mv->id,
                'screen_id' => fake()->randomElement($screenId)
            ]);
        }
    }
}
