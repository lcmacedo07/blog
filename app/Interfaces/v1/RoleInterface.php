<?php

namespace App\Interfaces\v1;

use App\Http\Requests\PermissionRoleRequest;
use App\Http\Requests\RoleRequest;

interface RoleInterface
{

    public function index();
    public function show($uuid);
    public function details($uuid);
    public function comboBox();
    public function store(RoleRequest $request);
    public function update($uuid, RoleRequest $request);
    public function delete($uuid);
    public function trash();
    public function restore($uuid);

    public function storePermissions(PermissionRoleRequest $request);
    public function deletePermissions($uuid);
}