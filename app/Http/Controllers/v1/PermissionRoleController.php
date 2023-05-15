<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Interfaces\v1\PermissionRoleInterface;
use App\Http\Requests\PermissionRoleRequest;
use App\Http\Controllers\v1\_ControlCommon;

class PermissionRoleController extends Controller
{
	private $interface, $commons, $gate;

	public function __construct(PermissionRoleInterface $interface, _ControlCommon $commons)
	{
		$this->interface = $interface;
		$this->commons = $commons;
		$this->gate = 'permission_role';
	}

	public function index()
	{
		$this->commons->userAuthorization($this->gate);
		return $this->interface->index();
	}

	public function show($uuid)
	{
		$this->commons->userAuthorization($this->gate);
		return $this->interface->show($uuid);
	}

	public function details($uuid)
	{
		$this->commons->userAuthorization($this->gate);
		return $this->interface->details($uuid);
	}

	public function store(PermissionRoleRequest $request)
	{
		$this->commons->userAuthorization($this->gate);
		return $this->interface->store($request);
	}

	public function update($uuid, PermissionRoleRequest $request)
	{
		$this->commons->userAuthorization($this->gate);
		return $this->interface->update($uuid, $request);
	}

	public function delete($uuid)
	{
		$this->commons->userAuthorization($this->gate);
		return $this->interface->delete($uuid);
	}

	public function trash()
	{
		$this->commons->userAuthorization($this->gate);
		return $this->interface->trash();
	}

	public function restore($uuid)
	{
		$this->commons->userAuthorization($this->gate);
		return $this->interface->restore($uuid);
	}
}