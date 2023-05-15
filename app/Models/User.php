<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    
    use  HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
		'role_id',
		'name',
        'username',
        'email',
        'password',
        'image',
        'about'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withPivot('id');
    }

    public function permissions()
    {
        return $this->hasManyThrough(Permission::class, Role::class);
    }
    
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function favorite_posts()
    {
        return $this->belongsToMany(Post::class)->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function scopeAuthors($query)
    {
        return $query->where('role_id',2);
    }
}
