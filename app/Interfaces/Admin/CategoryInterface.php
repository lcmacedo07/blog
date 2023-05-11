<?php

namespace App\Interfaces\Admin;

use App\Http\Requests\CategoryRequest;

interface CategoryInterface {

	public function index();
	public function show($id);
	public function details($id);
	public function comboBox();
	public function create();
	public function store(CategoryRequest $request);
	public function edit($id);
	public function update($id, CategoryRequest $request);
	public function delete($id);
	public function destroy($id);

}