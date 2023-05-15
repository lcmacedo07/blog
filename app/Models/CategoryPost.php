<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;


class CategoryPost extends Model
{
    
    use  HasFactory, Notifiable;

    protected $table = 'category_post';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
		'post_id',
        'category_id'
         
    ];
     
}
