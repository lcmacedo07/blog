<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;


class Role extends Model
{
    
    use  HasFactory, Notifiable;

    protected $table = 'roles';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
		'name',
		'slug'
    ];
    

    public function users()
    {
        return $this->hasMany(User::class);
    }
     
}
