<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Interfaces\Author\SettingInterface;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;

class SettingController extends Controller {
    private $interface;

    public function __construct(SettingInterface $interface) {
        $this->interface = $interface;
    }

	public function index()
    {
        return $this->interface->index();
    }

    // public function updateProfile(UserRequest $request)
    public function updateProfile(Request $request)
    {
        return $this->interface->updateProfile($request);
    }

    // public function updatePassword(UserRequest $request)
    public function updatePassword(Request $request)
    {
        return $this->interface->updatePassword($request);
    }
     
}
