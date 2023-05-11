<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;


class Tag extends Model
{
    
    use  HasFactory, Notifiable;

    protected $table = 'tags';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
		'name',
        'slug',
         
    ];
    


    public function posts()
    {
        return $this->belongsToMany(Post::class)->withTimestamps();
    }
     
}
