<?php

namespace App\Repositories\Author;

use App\Models\Post;
use App\Interfaces\Author\DashboardInterface;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardRepository implements DashboardInterface
{
    private $model;

    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        return view('author.dashboard');
    }
}