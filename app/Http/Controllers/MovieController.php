<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class MovieController extends Controller
{
    public function index():View
    {
        $movies = Movie::all();
        return view('movies.index',compact('movies'));
    }

    public function adminIndex():View
    {
        $movies = Movie::all();
        return view('movies.admin.index',compact('movies'));
    }

    public function adminCreate()
    {
        return view('movies.admin.create');
    }

    public function adminStore(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|unique:movies,title',
            'image_url' => 'required|url',
            'published_year' => 'required|integer',
            'is_showing' => 'required|boolean',
            'description' => 'required|string',
        ]);
        Movie::create([
            'title' => $validated['title'],
            'image_url' => $validated['image_url'],
            'published_year' => $validated['published_year'],
            'is_showing' => $validated['is_showing'],
            'description' => $validated['description'],
        ]);
        return redirect()->route('admin.home');
    }

    public function adminEdit(string $id)
    {
        $mv = Movie::findOrFail($id);
        return view('movies.admin.edit',compact('mv'));
    }

    public function adminUpdate(string $id , Request $request)
    {
        // バリデーション
        $validated = $request->validate([
            'title' => 'required|string|unique:movies,title',
            'image_url' => 'required|url',
            'published_year' => 'required|integer',
            'is_showing' => 'required|boolean',
            'description' => 'required|string',
        ]);
        // 対象を取得
        $mv = Movie::findOrFail($id);
        // リクエストからデータ取得
        $data = [];
        $data['title'] = $validated['title'];
        $data['image_url'] = $validated['image_url'];
        $data['published_year'] = $validated['published_year'];
        $data['is_showing'] = $validated['is_showing'];
        $data['description'] = $validated['description'];
        $mv->update($data);

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
}
