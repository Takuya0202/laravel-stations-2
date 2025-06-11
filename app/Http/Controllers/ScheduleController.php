<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use App\Models\Movie;
use App\Models\Schedule;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function adminIndex()
    {
        $movies = Movie::with(['genre','schedules'])
                ->get();

        return view('schedules.admin.index',compact('movies'));
    }

    public function adminShow(string $id)
    {
        $sc = Schedule::with(['movie'])
            ->findOrFail($id);

        return view('schedules.admin.show',compact('sc'));
    }

    public function adminCreate(string $id)
    {
        $movie_id = $id;
        return view('schedules.admin.create',compact('movie_id'));
    }

    public function adminStore(CreateScheduleRequest $request,string $id)
    {
        // datetimeに変換
        $start_time = new CarbonImmutable($request->start_time_date . ' ' . $request->start_time_time);
        $end_time = new CarbonImmutable($request->end_time_date . ' ' . $request->end_time_time);

        $schedules = Schedule::create([
            'movie_id' => $request->movie_id,
            'start_time' => $start_time,
            'end_time' => $end_time,
        ]);

        return redirect()->route('mv.show' , ['id' => $id]);
    }

    public function adminEdit(string $scheduleId)
    {
        $sc = Schedule::findOrFail($scheduleId);

        return view('schedules.admin.edit',compact('sc'));
    }

    public function adminUpdate(string $id ,  UpdateScheduleRequest $request)
    {
        // datetimeに変換
        $start_time = new CarbonImmutable($request->start_time_date . ' ' . $request->start_time_time);
        $end_time = new CarbonImmutable($request->end_time_date . ' ' . $request->end_time_time);

        // 連想配列の作成
        $data = $request->validated();
        $data['start_time'] = $start_time;
        $data['end_time'] = $end_time;

        $target = Schedule::findOrFail($id);
        $target->update($data);

        return redirect()->route('admin.schedules.show' , ['id' => $id]);
    }

    public function adminDelete(string $scheduleId)
    {
        $target = Schedule::findOrFail($scheduleId);
        $target->delete();

        return redirect()->route('admin.schedules.index');
    }
}
