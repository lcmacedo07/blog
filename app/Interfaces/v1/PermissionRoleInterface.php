<?php

namespace App\Interfaces\v1;

use App\Http\Requests\PermissionRoleRequest;

interface PermissionRoleInterface
{

	public function index();
	public function show($uuid);
	public function details($uuid);
	public function store(PermissionRoleRequest $request);
	public function update($uuid, PermissionRoleRequest $request);
	public function delete($uuid);
	public function trash();
	public function restore($uuid);
}