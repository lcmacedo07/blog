<?php

namespace App\Interfaces\Author;

use App\Http\Requests\PostRequest;

interface PostInterface {

	public function index();
	public function show($id);
	public function details($id);
	public function create();
	public function store(PostRequest $request);
	public function edit($id);
	public function update($id, PostRequest $request);
	public function delete($id);
	public function destroy($id);
}