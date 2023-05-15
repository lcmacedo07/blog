<?php

namespace App\Interfaces\v1;

use App\Http\Requests\RoleUserRequest;

interface RoleUserInterface
{

	public function index();
	public function show($uuid);
	public function details($uuid);
	public function store(RoleUserRequest $request);
	public function update($uuid, RoleUserRequest $request);
	public function delete($uuid);
	public function trash();
	public function restore($uuid);
}