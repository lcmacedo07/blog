<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Interfaces\v1\PermissionInterface;
use App\Http\Requests\PermissionRequest;
use App\Http\Controllers\v1\_ControlCommon;

class PermissionController extends Controller
{
	private $interface, $commons, $gate;

	public function __construct(PermissionInterface $interface, _ControlCommon $commons)
	{
		$this->interface = $interface;
		$this->commons = $commons;
		$this->gate = 'permissions';
	}

	public function index()
	{
		$this->commons->userAuthorization("$this->gate");
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

	public function store(PermissionRequest $request)
	{
		$this->commons->userAuthorization($this->gate);
		return $this->interface->store($request);
	}

	public function update($uuid, PermissionRequest $request)
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