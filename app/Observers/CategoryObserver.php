<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class CategoryObserver
{
    
	public function creating(Category $model) {
		// $model->uuid = Str::uuid();
	}
	public function created(Category $model)
    {
        Cache::forget('categories');
    }
    public function updating(Category $model)
    {
        // $model['password'] = Hash::make($model['password']);
    }
    public function updated(Category $model)
    {
        Cache::forget('categories');
    }
    public function deleted(Category $model)
    {
        Cache::forget('categories');
    }
    public function restored(Category $model)
    {
        Cache::forget('categories');
    }
    public function forceDeleted(Category $model)
    {
        Cache::forget('categories');
    }
}
