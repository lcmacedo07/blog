<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use App\Models\Category;
use App\Observers\CategoryObserver;
use App\Models\Post;
use App\Observers\PostObserver;
use App\Models\Tag;
use App\Observers\TagObserver;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        
		$this->app->bind(
			'App\Interfaces\Admin\CategoryInterface',
			'App\Repositories\Admin\CategoryRepository'
		);
        
		$this->app->bind(
			'App\Interfaces\Admin\PostInterface',
			'App\Repositories\Admin\PostRepository'
		);
		
        
		$this->app->bind(
			'App\Interfaces\Admin\TagInterface',
			'App\Repositories\Admin\TagRepository'
		);

		$this->app->bind(
            'App\Interfaces\Admin\SettingInterface',
            'App\Repositories\Admin\SettingRepository'
        );

		$this->app->bind(
            'App\Interfaces\Admin\DashboardInterface',
            'App\Repositories\Admin\DashboardRepository'
        );
        
	
		$this->app->bind(
			'App\Interfaces\Author\PostInterface',
			'App\Repositories\Author\PostRepository'
		);
	
		$this->app->bind(
            'App\Interfaces\Author\SettingInterface',
            'App\Repositories\Author\SettingRepository'
        );

		$this->app->bind(
            'App\Interfaces\Author\DashboardInterface',
            'App\Repositories\Author\DashboardRepository'
        );
		
        $this->app->bind(
            'Illuminate\Contracts\Filesystem\Factory',
            'Illuminate\Contracts\Filesystem\Factory'
        );
    }

    public function boot()
    {
        Schema::defaultStringLength(191);
        
		Category::observe(CategoryObserver::class);
		Post::observe(PostObserver::class);
		Tag::observe(TagObserver::class);
         
    }
}