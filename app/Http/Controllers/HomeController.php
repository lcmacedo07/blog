<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{

    public function __construct()
    {
        $categories = Category::all();
        // $posts = Post::latest()->approved()->published()->take(6)->paginate(1);
        $posts = Post::latest()->approved()->published()->paginate(6);

        View::share('categories', $categories);
        View::share('posts', $posts);
    }

    public function index()
    {
        return view('welcome');
    }
}
