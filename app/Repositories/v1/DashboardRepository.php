<?php

namespace App\Repositories\v1;

use App\Models\Post;
use App\Interfaces\v1\DashboardInterface;
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
        return view('admin.dashboard');
    }
}