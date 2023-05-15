<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;


class Category extends Model
{
    
    use  HasFactory, Notifiable;

    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
		'name',
        'slug',
        // 'image',
         
    ];
     
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'category_post')->withTimestamps();
    }


}
