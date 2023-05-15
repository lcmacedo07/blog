<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class PostController extends Controller
{

    public function __construct()
    {
        $categories = Category::all();
        $posts = Post::latest()->approved()->published()->take(6)->get();

        View::share('categories', $categories);
        View::share('posts', $posts);
    }
    
    public function index()
    {
        $posts = Post::latest()->approved()->published()->paginate(6);
        return view('posts',compact('posts'));
    }
    
    public function details($slug)
    {
        $post = Post::where('slug',$slug)->approved()->published()->with('user')->first();

        $blogKey = 'blog_' . $post->id;

        if (!Session::has($blogKey)) {
            $post->increment('view_count');
            Session::put($blogKey,1);
        }
        $randomposts = Post::approved()->published()->take(3)->inRandomOrder()->get();
        return view('post',compact('post','randomposts'));

    }

    public function postByCategory($slug)
    {
        $category = Category::where('slug',$slug)->first();
        $posts = $category->posts()->approved()->published()->get();

        return view('category',compact('category','posts'));
    }

    public function postByTag($slug)
    {
        $tag = Tag::where('slug',$slug)->first();
        $posts = $tag->posts()->approved()->published()->get();
        return view('tag',compact('tag','posts'));
    }
}
