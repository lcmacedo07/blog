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
use App\Models\Role;
use App\Observers\RoleObserver;
use App\Models\RoleUser;
use App\Observers\RoleUserObserver;
use App\Models\Permission;
use App\Observers\PermissionObserver;
use App\Models\PermissionRole;
use App\Observers\PermissionRoleObserver;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        
		$this->app->bind(
			'App\Interfaces\v1\CategoryInterface',
			'App\Repositories\v1\CategoryRepository'
		);
        
		$this->app->bind(
			'App\Interfaces\v1\PostInterface',
			'App\Repositories\v1\PostRepository'
		);
		
        
		$this->app->bind(
			'App\Interfaces\v1\TagInterface',
			'App\Repositories\v1\TagRepository'
		);

		$this->app->bind(
            'App\Interfaces\v1\SettingInterface',
            'App\Repositories\v1\SettingRepository'
        );

		$this->app->bind(
            'App\Interfaces\v1\DashboardInterface',
            'App\Repositories\v1\DashboardRepository'
        );

		$this->app->bind(
            'App\Interfaces\v1\RoleInterface',
            'App\Repositories\v1\RoleRepository'
        );

		$this->app->bind(
            'App\Interfaces\v1\RoleUserInterface',
            'App\Repositories\v1\RoleUserRepository'
        );

		$this->app->bind(
            'App\Interfaces\v1\PermissionInterface',
            'App\Repositories\v1\PermissionRepository'
        );

		$this->app->bind(
            'App\Interfaces\v1\PermissionRoleInterface',
            'App\Repositories\v1\PermissionRoleRepository'
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