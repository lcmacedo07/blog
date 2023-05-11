<?php

namespace App\Interfaces\Admin;

use App\Http\Requests\PostRequest;

interface PostInterface {

	public function index();
	public function show($id);
	public function details($id);
	public function comboBox();
	public function create();
	public function store(PostRequest $request);
	public function edit($id);
	public function update($id, PostRequest $request);
	public function delete($id);
	public function destroy($id);
	public function pending();
	public function approval($id);

}