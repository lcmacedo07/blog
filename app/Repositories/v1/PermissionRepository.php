<?php

namespace App\Repositories\v1;

use App\Models\Permission;
use App\Interfaces\v1\PermissionInterface;
use App\Http\Controllers\v1\_ControlCommon;

class PermissionRepository implements PermissionInterface
{
	private $model, $commons;

	public function __construct(Permission $model, _ControlCommon $commons)
	{
		$this->model = $model;
		$this->commons = $commons;
	}

	public function index()
	{
		$dateFilter = $this->commons->dateFilters();
		$registersPerPage = $this->commons->registersPerPage();
		$fieldsToSelect = $this->commons->fieldsToSelect('id,uuid,name,description');
		$sortByField = $this->commons->sortByField();
		$data = $this->model->select($fieldsToSelect)->whereBetween('created_at', [$dateFilter['dts'], $dateFilter['dtf']]);

		if (isset($_GET['q'])) {
			$fieldsToSearch = isset($_GET['q']) ? $this->commons->keywordsToSearch('name,description') : '';
			$data->whereRaw("($fieldsToSearch)");
		}

		return $data->orderByRaw($sortByField)->paginate($registersPerPage);
	}

	public function show($uuid)
	{
		$model = $this->model->where('uuid', $uuid)->first();
		$this->commons->insertLog($model->id, 'permissions', 'R');
		return $model;
	}

	public function details($uuid)
	{
		return $this->model->where('uuid', $uuid)->first()
			->makeHidden(['created_at', 'updated_at', 'deleted_at']);
	}

	public function comboBox()
	{
		return $this->model->select('id', 'name')->orderBy('name')->get();
	}

	public function store($request)
	{
		$dataForm = $request->all();
		return $this->model->create($dataForm);
	}

	public function update($uuid, $request)
	{
		$dataForm = $request->all();
		unset($dataForm['created_at'], $dataForm['updated_at'], $dataForm['deleted_at']);
		return $this->model->where('uuid', $uuid)->update($dataForm);
	}

	public function delete($uuid)
	{
		$model = $this->model->where('uuid', $uuid)->first();
		return $model->delete();
	}

	public function trash()
	{
		$model = $this->model->onlyTrashed()->get();
	}

	public function restore($uuid)
	{
		return $model = $this->model->withTrashed()->where('uuid', $uuid)->restore();
	}
}