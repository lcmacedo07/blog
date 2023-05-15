<?php

namespace App\Repositories\v1;

use App\Models\User;
use App\Interfaces\v1\SettingInterface;
use App\Http\Controllers\v1\_ControlCommon;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SettingRepository implements SettingInterface
{
    private $model, $commons;

    public function __construct(User $model, _ControlCommon $commons) {
        $this->model = $model;
		$this->commons = $commons;
    }
    
	public function index()
	{
		return view('admin.settings');
	}

	public function updateProfile(Request $request) {

		$dataForm = $request->all();

		$validator = Validator::make($dataForm,[
            'name' => 'required',
            'email' => 'required|email',
            'image' => 'required|image',
        ]);

		if ($validator->fails()) {
            throw new \Exception('Os dados não são válidos: ' . implode(', ', $validator->errors()->all()));
        }

		$image = $request->file('image');
	
		if (isset($image)) {
			$slug = Str::slug($dataForm['name']);
			$currentDate = Carbon::now()->toDateString();
			$imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
	
			if (!Storage::disk('public')->exists('profile')) {
				Storage::disk('public')->makeDirectory('profile');
			}
	
			$profileImage = Image::make($image);
			$profileImage->resize(1600, 479);
			Storage::disk('public')->put('profile/'.$imagename, $profileImage->stream());
	
			if (!Storage::disk('public')->exists('profile/slider')) {
				Storage::disk('public')->makeDirectory('profile/slider');
			}
	
			$sliderImage = Image::make($image);
			$sliderImage->resize(1600, 479);
			Storage::disk('public')->put('profile/slider/'.$imagename, $sliderImage->stream());
	
			$dataForm['image'] = $imagename;
		} else {
			$dataForm['image'] = "default.png";
		}
	
		if (isset($dataForm['name'])) {
			$slug = ['slug' => Str::slug($dataForm['name'], '-')];
			$dataForm = array_merge($dataForm, $slug);
		}
	
		$model = $this->model->where('id', Auth::id())->first();
		$model->update($dataForm);
	
		return redirect()->route('settings')->with('success', 'Perfil atualizado com sucesso!');
	}

	public function updatePassword(Request $request) {
		$dataForm = $request->all();

		$validator = Validator::make($dataForm,[
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);

		if ($validator->fails()) {
            throw new \Exception('Os dados não são válidos: ' . implode(', ', $validator->errors()->all()));
        }

		$hashedPassword = Auth::user()->password;

		if (Hash::check($request->old_password,$hashedPassword))
        {
            if (!Hash::check($request->password,$hashedPassword))
            {
                $user = User::find(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();
				Session::flash('success', 'Senha mudada com sucesso!');
                Auth::logout();
                return redirect()->back();
            } else {
				Session::flash('error', 'A nova senha não pode ser igual à senha antiga.');
                return redirect()->back();
            }
        } else {
			Session::flash('error', 'A senha atual não corresponde.');
            return redirect()->back();
        }

		$model = $this->model->where('id', Auth::id())->first();
		$model->update($dataForm);
	
		return redirect()->route('settings')->with('success', 'Perfil atualizado com sucesso!');
	}

	public function updateSocialnetwork(Request $request) {

		$dataForm = $request->all();

		// $validator = Validator::make($dataForm,[
        //     'name' => 'required',
        //     'email' => 'required|email',
        //     'image' => 'required|image',
        // ]);

		// if ($validator->fails()) {
        //     throw new \Exception('Os dados não são válidos: ' . implode(', ', $validator->errors()->all()));
        // }

		// $image = $request->file('image');
	
		// if (isset($image)) {
		// 	$slug = Str::slug($dataForm['name']);
		// 	$currentDate = Carbon::now()->toDateString();
		// 	$imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
	
		// 	if (!Storage::disk('public')->exists('profile')) {
		// 		Storage::disk('public')->makeDirectory('profile');
		// 	}
	
		// 	$profileImage = Image::make($image);
		// 	$profileImage->resize(1600, 479);
		// 	Storage::disk('public')->put('profile/'.$imagename, $profileImage->stream());
	
		// 	if (!Storage::disk('public')->exists('profile/slider')) {
		// 		Storage::disk('public')->makeDirectory('profile/slider');
		// 	}
	
		// 	$sliderImage = Image::make($image);
		// 	$sliderImage->resize(1600, 479);
		// 	Storage::disk('public')->put('profile/slider/'.$imagename, $sliderImage->stream());
	
		// 	$dataForm['image'] = $imagename;
		// } else {
		// 	$dataForm['image'] = "default.png";
		// }
	
		// if (isset($dataForm['name'])) {
		// 	$slug = ['slug' => Str::slug($dataForm['name'], '-')];
		// 	$dataForm = array_merge($dataForm, $slug);
		// }
	
		$model = $this->model->where('id', Auth::id())->first();
		$model->update($dataForm);
	
		return redirect()->route('settings')->with('success', 'Perfil atualizado com sucesso!');
	}
}
