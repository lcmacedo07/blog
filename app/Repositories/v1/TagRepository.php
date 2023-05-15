<?php

namespace App\Repositories\v1;

use App\Models\Tag;
use App\Interfaces\v1\TagInterface;
use App\Http\Controllers\v1\_ControlCommon;
use Illuminate\Support\Str;

class TagRepository implements TagInterface
{
    private $model, $commons;

    public function __construct(Tag $model, _ControlCommon $commons) {
        $this->model = $model;
		$this->commons = $commons;
    }
    
	public function index()
	{
		$tags = $this->model->paginate(10);
		return view('admin.tags.index', compact('tags'));

	}

	public function show($id)
	{
		$tags = $this->model->where('id', $id)->first();
		$this->commons->insertLog($tags->id, 'tags', 'R');
		return view('admin.tags.show', compact('tags'));
	}

	public function details($id)
	{
		return $this->model->where('id', $id)->first()->makeHidden(['created_at','updated_at','deleted_at']);
	}

	public function comboBox()
	{
		return $this->model->select('id','name')->orderBy('name')->get();
	}

	public function create() {
		return view('admin.tags.create');
	}

	public function store($request) {

		$dataForm = $request->all();
        $slug = Str::slug($dataForm['name']);

		if(isset($dataForm['name'])) {
			$slug = array('slug' => Str::slug($dataForm['name'], '-'));
			$dataForm = array_merge($dataForm, $slug);
		}

		$this->model->create($dataForm);

		return redirect()->route('tags.index')->with('success', 'Tag cadastrada com sucesso!');
	}

	public function edit($id) {
		$tags = $this->model->where('id', $id)->first();
		return view('admin.tags.edit', compact('tags'));
	}

	public function update($id, $request) {
		$dataForm = $request->all();

        $slug = Str::slug($dataForm['name']);

		if(isset($dataForm['name'])) {
			$slug = array('slug' => Str::slug($dataForm['name'], '-'));
			$dataForm = array_merge($dataForm, $slug);
		}

		$model = $this->model->where('id', $id)->first();
		$model->update($dataForm);

		return redirect()->route('tags.index')->with('success', 'Tag alterado com sucesso!');

	}

	public function delete($id) { 
		$model = $this->model->where('id', $id)->first();
		return $model->delete();
	}

	public function destroy($id) {
		$model = $this->model->where('id', $id)->first();

		$model->delete();
		toastr()->success('Tag excluída com sucesso!', 'Sucesso', ["positionClass" => "toast-top-right"]);
		return redirect()->back();
	}
}
