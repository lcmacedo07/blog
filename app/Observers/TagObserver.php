<?php

namespace App\Observers;

use App\Models\Tag;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class TagObserver
{
    
	public function creating(Tag $model) {
		// $model->uuid = Str::uuid();
	}
	public function created(Tag $model)
    {
        Cache::forget('categories');
    }
    public function updating(Tag $model)
    {
        // $model['password'] = Hash::make($model['password']);
    }
    public function updated(Tag $model)
    {
        Cache::forget('categories');
    }
    public function deleted(Tag $model)
    {
        Cache::forget('categories');
    }
    public function restored(Tag $model)
    {
        Cache::forget('categories');
    }
    public function forceDeleted(Tag $model)
    {
        Cache::forget('categories');
    }
}
