<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReservationRequest;
use App\Models\Reservation;
use App\Models\Schedule;
use App\Models\Sheet;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function show(string $movie_id , string $schedule_id,Request $request)
    {
        $sheets = Sheet::all()->groupBy('row');

        // 不正なurlの禁止
        if (!$request->input('date')) {
            abort(400,'date not found');
        }

        $carbon = new CarbonImmutable($request->input('date'));
        $date = $carbon->toDateString();

        return view('reservations.index',compact('sheets','movie_id','schedule_id','date'));
    }

    public function create(string $movie_id , string $schedule_id , Request $request)
    {
        // 不正なurlの禁止
        if (!$request->input('date')) {
            abort(400,'date not found');
        }
        if (!$request->input('sheetId')) {
            abort(400,'sheetId not found');
        }

        // クエリパラメータの取得
        $carbon = new CarbonImmutable($request->input('date'));
        $sheet_id = $request->input('sheetId');

        // dateに変更
        $date = $carbon->toDateString();

        return view('reservations.create',compact('movie_id','schedule_id','sheet_id','date'));
    }

    public function store(CreateReservationRequest $request)
    {
        // クエリパラメータの取得
        if ($request->movie_id) {
            $movie_id = $request->movie_id;
        } else{
            // movieIDがなかった時。テストケース用
            $schedule = Schedule::findOrFail($request->schedule_id);
            $movie_id = $schedule->movie_id;
        }
        $schedule_id = $request->schedule_id;


        // 予約可能かどうか
        $is_preserve = Reservation::where('sheet_id' , $request->sheet_id)
                                    ->where('schedule_id' , $request->schedule_id)
                                    ->exists();

        if (!$is_preserve) {
            $reservation = Reservation::create([
                'sheet_id' => $request->sheet_id,
                'schedule_id' => $request->schedule_id,
                'email' =>$request->email,
                'name' => $request->name,
                'date' => $request->date,
                'is_canceled' => false,
            ]);

            return redirect()->route('mv.show' , ['id' => $movie_id])
            ->with('message' , '予約が完了しました。')->withInput();
        }
        else{
            return redirect()->route('reservation.index',
            ['movie_id' => $movie_id , 'schedule_id' => $schedule_id , 'date' => $request->date])
            ->with('message' , 'その座席は既に予約済みです。')->withInput();
        }
    }
}
