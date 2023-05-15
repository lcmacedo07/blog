<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Organ;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    public function login(Request $request)
    {

        $email = $request['email'];
        $password = $request['password'];

        if (!Auth::attempt(['email' => $email, 'password' => $password])) {
            return response([
                'error' => 'Credenciais invalidas'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();
        $token = $user->createToken($request->device_name)->plainTextToken;
        $cookie = cookie('jwt', $token, 60 * 24);
        $permissions = $this->permissionsUser();



        $organ = Organ::where('id', $user->organ_id)->first();
        $name = $organ->name;
        $sigla = $organ->sigla;
        $nameOrgan = '';


        if ($organ->parent_id != null) {
            $parent_id = $organ->parent_id;
            while ($parent_id != null) {
                $nameOrgan = ">> $organ->sigla $nameOrgan";
                $organ = Organ::where('id', $organ->parent_id)->first();
                $parent_id = $organ->parent_id;
            }
            $nameOrgan = "$organ->sigla $nameOrgan";
        } else {
            $nameOrgan = "$sigla >> $name";
        }




        return response([
            'token' => $token,
            'user' => $user,
            'organ' => ['name' => $nameOrgan],
            'permissions' => $permissions
        ])->withCookie($cookie);
    }

    public function user()
    {
        $permissions = $this->permissionsUser();
        $user =  Auth::user()->where('users.id', Auth::user()->id)->select('users.id', 'users.email')->get();
        $user = ['user' => $user, 'permissions' => $permissions];
        return $user;
    }

    public function permissionsUser()
    {
        $dataUser = User::with('roles')->select('id')->find(Auth::user()->id);
        $roles = Arr::pluck($dataUser->roles, 'id');
        $permissionsUser = Role::with('permissions')->whereIn('id', $roles)->select('id')->get();
        $permissionsUser = Arr::pluck($permissionsUser, 'permissions');
        $permissionsUser = Arr::collapse($permissionsUser);
        $permissionsUser = Arr::pluck($permissionsUser, 'name');
        return $permissionsUser;
    }

    public function logout()
    {
        Auth::logout();
        $cookie = Cookie::forget('jwt');
        return response(['message' => 'success'])->withCookie($cookie);
    }
}