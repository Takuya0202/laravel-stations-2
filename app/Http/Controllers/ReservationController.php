<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAdminReservationRequest;
use App\Http\Requests\CreateReservationRequest;
use App\Http\Requests\UpdateAdminReservationRequest;
use App\Models\Reservation;
use App\Models\Schedule;
use App\Models\Sheet;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function show(string $movie_id , string $schedule_id,Request $request)
    {
        // 座席の全権取得
        $sheets = Sheet::all()->groupBy('row');

        // 不正なurlの禁止
        if (!$request->input('date')) {
            abort(400,'date not found');
        }

        $carbon = new CarbonImmutable($request->input('date'));
        $date = $carbon->toDateString();

        $sheet_ids = [];
        // 予約されている席のshhet_idを取得する
        $reservedIds = Reservation::where('schedule_id',$schedule_id)
                                ->pluck('sheet_id');

        // 配列に変更
        foreach ($reservedIds as $reservedId) {
            array_push($sheet_ids,$reservedId);
        }

        return view('reservations.index',compact('sheets','movie_id','schedule_id','date','sheet_ids'));
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

        // 予約されている席のページにアクセスできないようにする
        $is_preserve = Reservation::where('sheet_id' , $request->sheetId)
                                    ->where('schedule_id' , $schedule_id)
                                    ->exists();

        if ($is_preserve) {
            abort(400,'Cannot access the page');
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

    public function adminIndex()
    {
        $reservations = Reservation::with(['schedule','sheet','schedule.movie'])
                        ->whereHas('schedule',function ($q) {
                            $q->where('end_time' , '>' , Carbon::now());
                        })
                        ->get();

        return view('reservations.admin.index',compact('reservations'));
    }

    public function adminCreate()
    {
        $sheets = Sheet::all();
        $schedules = Schedule::all();

        return view('reservations.admin.create',compact('sheets','schedules'));
    }

    public function adminStore(CreateAdminReservationRequest $request)
    {
        // 予約できるかどうかのチェック
        $is_preserve = Reservation::where('sheet_id' , $request->sheet_id)
                                    ->where('schedule_id' , $request->schedule_id)
                                    ->exists();

        if (!$is_preserve) {
            $reservation = Reservation::create([
                'sheet_id' => $request->sheet_id,
                'schedule_id' => $request->schedule_id,
                'email' =>$request->email,
                'name' => $request->name,
                'date' => $request->date ?: Carbon::now()->toDateString(),
                'is_canceled' => false,
            ]);

            return redirect()->route('admin.reservation.index')
            ->with('message' , '予約が完了しました。')->withInput();
        }
        else{
            return redirect()->route('admin.reservation.index')
            ->with('message' , 'その座席は既に予約済みです。')->withInput();
        }
    }

    public function adminEdit(string $id)
    {
        $reservation = Reservation::with(['schedule','sheet'])
                    ->findOrFail($id);
        $sheets = Sheet::all();
        $schedules = Schedule::all();

        return view('reservations.admin.edit',compact('reservation','sheets','schedules'));
    }

    public function adminUpdate(UpdateAdminReservationRequest $request , string $id)
    {
        // 受け取ったフォームを連想配列に
        $validated = $request->validated();

        $target = Reservation::findOrFail($id);

        // 予約が不可能の場合別リダイレクト
        $is_preserve = Reservation::where('sheet_id' , $request->sheet_id)
                                    ->where('schedule_id' , $request->schedule_id)
                                    ->exists();

        if ($is_preserve) {
            return redirect()->route('admin.reservation.index')
            ->with('message' , 'その座席は既に予約済みです。')->withInput();
        }else{
            // 更新
            $target->update($validated);
            return redirect()->route('admin.reservation.index')
            ->with('message' , '予約内容を更新しました')->withInput();
        }
    }

    public function adminDelete(string $id)
    {
        $target = Reservation::findOrFail($id);
        $target->delete();

        return redirect()->route('admin.reservation.index');
    }
}
