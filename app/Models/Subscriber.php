<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;


class Category extends Model
{
    
    use  HasFactory, Notifiable;

    protected $table = 'subscribers';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
		'email',
    ];
     


    public function posts()
    {
        return $this->belongsToMany(Post::class)->withTimestamps();
    }
     
}
