<?php

namespace App\Interfaces\v1;

use App\Http\Requests\PermissionRequest;

interface PermissionInterface
{

	public function index();
	public function show($uuid);
	public function details($uuid);
	public function comboBox();
	public function store(PermissionRequest $request);
	public function update($uuid, PermissionRequest $request);
	public function delete($uuid);
	public function trash();
	public function restore($uuid);
}