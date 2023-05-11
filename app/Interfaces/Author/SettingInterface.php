<?php

namespace App\Interfaces\Author;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;


interface SettingInterface {

	public function index();
	public function updateProfile(Request $request);
	// public function updateProfile(UserRequest $request);
	// public function updatePassword(UserRequest $request);
	public function updatePassword(Request $request);

}