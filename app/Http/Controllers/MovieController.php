<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

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
}
