<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\Schedule;
use Illuminate\Database\Seeder;

use App\Practice;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Practice::factory(10)->create();
        $this->call(GenreTableSeeder::class);
        $this->call(MovieTableSeeder::class);
        $this->call(SheetTableSeeder::class);
        $this->call(ScheduleTableSeeder::class);
    }
}
