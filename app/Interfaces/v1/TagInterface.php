<?php

namespace App\Interfaces\v1;

use App\Http\Requests\TagRequest;

interface TagInterface {

	public function index();
	public function show($id);
	public function details($id);
	public function comboBox();
	public function create();
	public function store(TagRequest $request);
	public function edit($id);
	public function update($id, TagRequest $request);
	public function delete($id);
	public function destroy($id);

}