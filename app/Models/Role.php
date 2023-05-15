<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{

	use SoftDeletes, HasFactory, Notifiable;

	protected $table = 'roles';
	protected $primaryKey = 'id';
	protected $fillable = [
		'id',
		'name',
		'description',
	];

	public function users()
	{
		return $this->belongsToMany(User::class)->withPivot('id');
	}

	public function permissions()
	{
		return $this->belongsToMany(Permission::class)->withPivot('id');
	}
}