<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;


class RoleUser extends Model
{
    public $timestamps = false;
    use  HasFactory, Notifiable;

    protected $table = 'role_user';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'role_id',
        'user_id',
    ];
}