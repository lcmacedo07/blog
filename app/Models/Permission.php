<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{

    use SoftDeletes, HasFactory, Notifiable;

    protected $table = 'permissions';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'name',
        'description',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}