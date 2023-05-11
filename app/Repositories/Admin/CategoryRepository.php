<?php

namespace App\Repositories\Admin;

use App\Models\Category;
use App\Interfaces\Admin\CategoryInterface;
use App\Http\Controllers\v1\_ControlCommon;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class CategoryRepository implements CategoryInterface
{
    private $model, $commons;

    public function __construct(Category $model, _ControlCommon $commons) {
        $this->model = $model;
		$this->commons = $commons;
    }
    
	public function index()
	{
		$categories = $this->model->paginate(10);
		return view('admin.categories.index', compact('categories'));

	}

	public function show($id)
	{
		$categories = $this->model->where('id', $id)->first();
		$this->commons->insertLog($categories->id, 'categories', 'R');
		return view('admin.categories.show', compact('categories'));
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
		return view('admin.categories.create');
	}

	public function store($request) {
		$dataForm = $request->all();
	
		$image = $request->file('image');
	
		if (isset($image)) {
			$slug = Str::slug($dataForm['name']);
			$currentDate = Carbon::now()->toDateString();
			$imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
	
			if (!Storage::disk('public')->exists('category')) {
				Storage::disk('public')->makeDirectory('category');
			}
	
			$categoryImage = Image::make($image);
			$categoryImage->resize(1600, 479);
			Storage::disk('public')->put('category/'.$imagename, $categoryImage->stream());
	
			if (!Storage::disk('public')->exists('category/slider')) {
				Storage::disk('public')->makeDirectory('category/slider');
			}
	
			$sliderImage = Image::make($image);
			$sliderImage->resize(1600, 479);
			Storage::disk('public')->put('category/slider/'.$imagename, $sliderImage->stream());
	
			$dataForm['image'] = $imagename;
		} else {
			$dataForm['image'] = "default.png";
		}
	
		if (isset($dataForm['name'])) {
			$slug = ['slug' => Str::slug($dataForm['name'], '-')];
			$dataForm = array_merge($dataForm, $slug);
		}
	
		$this->model->create($dataForm);
	
		return redirect()->route('categories.index')->with('success', 'Categoria cadastrada com sucesso!');
	}

	public function edit($id) {
		$categories = $this->model->where('id', $id)->first();
		return view('admin.categories.edit', compact('categories'));
	}

	public function update($id, $request) {
		$dataForm = $request->all();
	
		$image = $request->file('image');
	
		if (isset($image)) {
			$slug = Str::slug($dataForm['name']);
			$currentDate = Carbon::now()->toDateString();
			$imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
	
			if (!Storage::disk('public')->exists('category')) {
				Storage::disk('public')->makeDirectory('category');
			}
	
			$categoryImage = Image::make($image);
			$categoryImage->resize(1600, 479);
			Storage::disk('public')->put('category/'.$imagename, $categoryImage->stream());
	
			if (!Storage::disk('public')->exists('category/slider')) {
				Storage::disk('public')->makeDirectory('category/slider');
			}
	
			$sliderImage = Image::make($image);
			$sliderImage->resize(1600, 479);
			Storage::disk('public')->put('category/slider/'.$imagename, $sliderImage->stream());
	
			$dataForm['image'] = $imagename;
		} else {
			$dataForm['image'] = "default.png";
		}
	
		if (isset($dataForm['name'])) {
			$slug = ['slug' => Str::slug($dataForm['name'], '-')];
			$dataForm = array_merge($dataForm, $slug);
		}
	
		$model = $this->model->where('id', $id)->first();
		$model->update($dataForm);

		return redirect()->route('categories.index')->with('success', 'Categoria alterado com sucesso!');

	}

	public function delete($id) { 
		$model = $this->model->where('id', $id)->first();
		return $model->delete();
	}

	public function destroy($id) {
		$model = $this->model->where('id', $id)->first();

		$model->delete();
		toastr()->success('Categoria excluída com sucesso!', 'Sucesso', ["positionClass" => "toast-top-right"]);
		return redirect()->back();
	}
}
