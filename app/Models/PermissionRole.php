<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;


class PermissionRole extends Model
{
    public $timestamps = false;
    use  HasFactory, Notifiable;

    protected $table = 'permission_role';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'permission_id',
        'role_id',
    ];
}