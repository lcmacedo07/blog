<?php

namespace App\Interfaces\v1;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;


interface SettingInterface {

	public function index();
	public function updateProfile(Request $request);
	public function updatePassword(Request $request);

}