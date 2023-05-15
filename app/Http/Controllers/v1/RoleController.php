<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Interfaces\v1\RoleInterface;
use App\Http\Requests\RoleRequest;
use App\Http\Controllers\v1\_ControlCommon;
use App\Http\Requests\PermissionRoleRequest;

class RoleController extends Controller
{
	private $interface, $commons, $gate;

	public function __construct(RoleInterface $interface, _ControlCommon $commons)
	{
		$this->interface = $interface;
		$this->commons = $commons;
		$this->gate = 'roles';
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

	public function comboBox()
	{
		return $this->interface->comboBox();
	}

	public function store(RoleRequest $request)
	{
		$this->commons->userAuthorization($this->gate);
		return $this->interface->store($request);
	}

	public function storePermissions(PermissionRoleRequest $request,)
	{
		$this->commons->userAuthorization($this->gate);
		return $this->interface->storePermissions($request);
	}

	public function deletePermissions($uuid)
	{
		$this->commons->userAuthorization($this->gate);
		return $this->interface->deletePermissions($uuid);
	}


	public function update($uuid, RoleRequest $request)
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