<?php

namespace App\Repositories\V1\Eloquent;

use Auth;
use App\Models\Users;
use App\Repositories\V1\Interface\IUsersRepository;
use Illuminate\Support\Facades\Hash;

class UsersRepository extends BaseRepository implements IUsersRepository
{
    protected $model;

    public function __construct(Users $model)
    {
        $this->model = $model;
    }

    public function register($request)
    {

        $user = $this->model->create(['name' => $request->name, 'email' => $request->email, 'username' => $request->username, 'password' => Hash::make($request->password)]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return ['users' => $user, 'access_token' => $token, 'token_type' => 'Bearer'];
    }

    public function login($request)
    {

        $input = $request->all();

        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt(array($fieldType => $input['username'], 'password' => $input['password']))) {

            $user = $this->model->where('email', $input['username'])->orWhere('username', $input['username'])->firstOrFail();

            $token = $user->createToken('auth_token')->plainTextToken;

            return ['users' => $user, 'token' => $token];
        }
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();
    }

    public function profile()
    {
        return Auth::user()->load(['Role']);
    }
}
