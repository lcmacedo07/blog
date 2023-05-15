<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class SearchController extends Controller
{
    public function __construct()
    {
        $categories = Category::all();
        $posts = Post::latest()->approved()->published()->take(6)->get();

        View::share('categories', $categories);
        View::share('posts', $posts);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $posts = Post::where('title','LIKE',"%$query%")->approved()->published()->get();
        return view('search',compact('posts','query'));
    }
}