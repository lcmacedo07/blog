<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class PostObserver
{
    
	public function creating(Post $model) {
		// $model->uuid = Str::uuid();
	}
	public function created(Post $model)
    {
        Cache::forget('categories');
    }
    public function updating(Post $model)
    {
        // $model['password'] = Hash::make($model['password']);
    }
    public function updated(Post $model)
    {
        Cache::forget('categories');
    }
    public function deleted(Post $model)
    {
        Cache::forget('categories');
    }
    public function restored(Post $model)
    {
        Cache::forget('categories');
    }
    public function forceDeleted(Post $model)
    {
        Cache::forget('categories');
    }
}
