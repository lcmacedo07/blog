<?php

namespace App\Repositories\Author;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Interfaces\Author\PostInterface;
use App\Http\Controllers\v1\_ControlCommon;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class PostRepository implements PostInterface
{
    private $model, $commons;

    public function __construct(Post $model, _ControlCommon $commons) {
        $this->model = $model;
		$this->commons = $commons;
    }
    
	public function index()
	{
		// $posts = $this->model->paginate(10);
		$posts = Auth::user()->posts()->latest()->paginate(10);
		return view('author.posts.index', compact('posts'));

	}

	public function show($id)
	{
		$post = $this->model->where('id', $id)->first();
		return view('author.posts.show', compact('post'));
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
		$categories = Category::all();
        $tags = Tag::all();

		return view('author.posts.create', compact('categories', 'tags'));
	}

	public function store($request) {
		$dataForm = $request->all();

		$image = $request->file('image');

		if (isset($image)) {
			$slug = Str::slug($dataForm['title']);
			$currentDate = Carbon::now()->toDateString();
			$imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
	
			if (!Storage::disk('public')->exists('post')) {
				Storage::disk('public')->makeDirectory('post');
			}
	
			$postImage = Image::make($image);
			$postImage->resize(1600, 479);
			Storage::disk('public')->put('post/'.$imagename, $postImage->stream());
	
			if (!Storage::disk('public')->exists('post/slider')) {
				Storage::disk('public')->makeDirectory('post/slider');
			}
	
			$sliderImage = Image::make($image);
			$sliderImage->resize(1600, 479);
			Storage::disk('public')->put('post/slider/'.$imagename, $sliderImage->stream());
	
			$dataForm['image'] = $imagename;
		} else {
			$dataForm['image'] = "default.png";
		}
	
		if(isset($dataForm['title'])) {
			$slug = array('slug' => Str::slug($dataForm['title'], '-'));
			$dataForm = array_merge($dataForm, $slug);
		}

		if(isset($request->status))
        {
            $dataForm['status'] = true;
        }else {
            $dataForm['status'] = false;
        }

        $dataForm['is_approved'] = false;

		$dataForm['user_id'] = Auth::id();

		$this->model->create($dataForm);

		return redirect()->route('posts.index')->with('success', 'Post cadastrado com sucesso!');
	}

	public function edit($id) {
		$posts = $this->model->where('id', $id)->first();
		$categories = Category::all();
        $tags = Tag::all();
		return view('author.posts.edit', compact('posts','categories','tags'));
	}

	public function update($id, $request) {

		$dataForm = $request->all();

		$image = $request->file('image');

		if (isset($image)) {
			$slug = Str::slug($dataForm['title']);
			$currentDate = Carbon::now()->toDateString();
			$imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
	
			if (!Storage::disk('public')->exists('post')) {
				Storage::disk('public')->makeDirectory('post');
			}
	
			$postImage = Image::make($image);
			$postImage->resize(1600, 479);
			Storage::disk('public')->put('post/'.$imagename, $postImage->stream());
	
			if (!Storage::disk('public')->exists('post/slider')) {
				Storage::disk('public')->makeDirectory('post/slider');
			}
	
			$sliderImage = Image::make($image);
			$sliderImage->resize(1600, 479);
			Storage::disk('public')->put('post/slider/'.$imagename, $sliderImage->stream());
	
			$dataForm['image'] = $imagename;
		} else {
			$dataForm['image'] = "default.png";
		}
	
		if(isset($dataForm['title'])) {
			$slug = array('slug' => Str::slug($dataForm['title'], '-'));
			$dataForm = array_merge($dataForm, $slug);
		}

		if(isset($request->status))
        {
            $dataForm['status'] = true;
        }else {
            $dataForm['status'] = false;
        }

		$dataForm['is_approved'] = false;

		$dataForm['user_id'] = Auth::id();

		$model = $this->model->where('id', $id)->first();
		$model->update($dataForm);
		
		return redirect()->route('posts.index')->with('success', 'Post alterado com sucesso!');

	}

	public function delete($id) { 
		$model = $this->model->where('id', $id)->first();
		return $model->delete();
	}

	public function destroy($id) {
		$model = $this->model->where('id', $id)->first();

		$model->delete();
		toastr()->success('Post excluído com sucesso!', 'Sucesso', ["positionClass" => "toast-top-right"]);
		return redirect()->back();
	}
}
