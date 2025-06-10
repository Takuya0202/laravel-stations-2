<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Schedule;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;


class MovieController extends Controller
{
    public function index(Request $request):View
    {
        // クエリ取得
        $key = $request->input('keyword') ?? null;
        $is_showing = $request->input('is_showing') ?? null;

        $query = Movie::query();
        // キーワード検索
        if ($key) {
            $query->where('title' , 'like' , '%' . $key . '%')
            ->orWhere('description' , 'like' , '%' . $key . '%');
        }
        // 上映検索
        if ($is_showing != null) {
            $query->where('is_showing' , $is_showing);
        }
        $movies = $query->paginate(20);

        return view('movies.index',compact('movies'));
    }

    public function adminIndex():View
    {
        $movies = Movie::with(['genre'])->get();
        $genres = Genre::all();
        return view('movies.admin.index',compact('movies','genres'));
    }

    public function adminCreate()
    {
        return view('movies.admin.create');
    }

    public function adminStore(CreateMovieRequest $request)
    {
        // トランザクション
        DB::transaction(function () use($request){
            // 存在していたら該当レコードを返し、なかったら新規作成
            $genre = Genre::firstOrCreate([
                'name' => $request->genre,
            ]);
            $movie = Movie::create([
                'title' => $request->title,
                'image_url' => $request->image_url,
                'published_year' => $request->published_year,
                'is_showing' => $request->is_showing,
                'description' => $request->description,
                'genre_id' => $genre->id,
            ]);
        });
        return redirect()->route('admin.home');
    }

    public function adminEdit(string $id)
    {
        $mv = Movie::with(['genre'])->findOrFail($id);
        return view('movies.admin.edit',compact('mv'));
    }

    public function adminUpdate(string $id ,  UpdateMovieRequest $request)
    {
        // 対象を取得
        $mv = Movie::findOrFail($id);
        $data = $request->validated();
        DB::transaction(function() use($request,$mv,$data){
            $genre = Genre::firstOrCreate([
                'name' => $request->genre,
            ]);
            $data['genre_id'] = $genre->id;

            $mv->update($data);
        });
        return redirect()->route('admin.home');
    }

    public function adminConfirme(string $id)
    {
        $mv = Movie::findOrFail($id);
        return view('movies.admin.confirme',compact('mv'));
    }

    public function adminDelete(string $id)
    {
        $mv = Movie::findOrFail($id);
        if (!$mv) {
            response('存在しません',404);
        }
        else{
            $mv->delete();
        }
        return redirect()->route('admin.home');
    }

    public function show(string $id)
    {
        $mv = Movie::with(['genre'])
            ->findOrFail($id);
        $schedules = Schedule::where('movie_id' , $id)
                    ->orderBy('start_time' , 'asc')
                    ->get();

        return view('movies.show' , compact('mv','schedules'));
    }
}
