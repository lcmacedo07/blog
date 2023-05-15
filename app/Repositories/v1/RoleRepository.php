<?php

namespace App\Repositories\v1;

use App\Models\Role;
use App\Models\PermissionRole;
use App\Interfaces\v1\RoleInterface;
use App\Http\Controllers\v1\_ControlCommon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoleRepository implements RoleInterface
{
    private $model, $commons;

    public function __construct(Role $model, _ControlCommon $commons)
    {
        $this->model = $model;
        $this->commons = $commons;
    }

    public function index()
    {
        $dateFilter = $this->commons->dateFilters();
        $registersPerPage = $this->commons->registersPerPage();
        $fieldsToSelect = $this->commons->fieldsToSelect('roles.id,roles.uuid,roles.name,roles.description');
        $sortByField = $this->commons->sortByField();
        $data = $this->model->select($fieldsToSelect)
            ->with('permissions:permissions.id as permission_id,permissions.name as permission')
            ->whereBetween('roles.created_at', [$dateFilter['dts'], $dateFilter['dtf']]);

        if (isset($_GET['q'])) {
            $fieldsToSearch = isset($_GET['q']) ? $this->commons->keywordsToSearch('roles.name,roles.description') : '';
            $data->whereRaw("($fieldsToSearch)");
        }

        return $data->orderByRaw($sortByField)->paginate($registersPerPage);
    }

    public function show($uuid)
    {
        $model = $this->model->where('uuid', $uuid)->first();
        $this->commons->insertLog($model->id, 'roles', 'R');
        return $model;
    }

    public function details($uuid)
    {
        return $this->model->where('uuid', $uuid)->first()->makeHidden(['created_at', 'updated_at', 'deleted_at']);
    }

    public function comboBox()
    {
        return $this->model->select('id', 'name')->orderBy('name')->get();
    }

    public function store($request)
    {
        return $this->model->create($request->all());
    }

    public function update($uuid, $request)
    {
        $model = $this->model->where('uuid', $uuid)->first();
        return $model->update($request->all());
    }

    public function delete($uuid)
    {
        $model = $this->model->where('uuid', $uuid)->first();
        return $model->delete();
    }

    public function trash()
    {
        return $this->model->onlyTrashed()->get();
    }

    public function restore($uuid)
    {
        return $model = $this->model->withTrashed()->where('uuid', $uuid)->restore();
    }

    public function storePermissions($request)
    {
        $create = DB::table('permission_role')
            ->insert([
                'permission_id' => $request->permission_id,
                'role_id' => $request->role_id,
                'uuid' => Str::uuid()
            ]);
        if ($create == true) {
            return response('Inserido', 201)->header('Content-Type', 'text/plain');
        }
    }

    public function deletePermissions($uuid)
    {
        $delete = PermissionRole::where('id', $uuid)->delete();
        if ($delete == true) {
            return response('Excluido', 200)->header('Content-Type', 'text/plain');
        }
    }
}