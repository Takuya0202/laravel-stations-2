<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\Schedule;
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
        foreach ($movies as $mv) {
            Schedule::factory(3)->create([
                'movie_id' => $mv->id
            ]);
        }
    }
}
