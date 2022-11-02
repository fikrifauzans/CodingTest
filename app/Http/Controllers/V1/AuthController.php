<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\V1\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Services\Handler\JsonResponse as JsonCustomResponse;
use App\Services\Validator\CustomValidator;
use App\Repositories\V1\Interface\IUsersRepository;

class AuthController extends Controller
{

    public function __construct(IUsersRepository $repository, CustomValidator $validator, JsonCustomResponse $response)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->response = $response;
    }

    public function register(Request $request, $language)
    {

        $validated = $this->validator->validate($request, $language, $this->repository->getTableName());

        if ($validated->fails()) return response()->json(['errors' => $validated->errors()], 422);

        else return $this->response->choseLang($language)->modeMessage('create', $this->repository->getTableName())->success($this->repository->register($request));
    }

    public function login(Request $request, $language)
    {
        $input = $request->all();

        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (!Auth::attempt(array($fieldType => $input['username'], 'password' => $input['password']))) {

            return response()->json(["Message" => 'Login Failed'], 401);
        } else return $this->response->choseLang($language)->modeMessage('login', $this->repository->getTableName())->success($this->repository->login($request));
    }

    // method for user logout and delete token
    public function logout($language)
    {
        return $this->response->choseLang($language)->modeMessage('logout', $this->repository->getTableName())->success($this->repository->logout());
    }

    public function check()
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'unauthorized'], 401);
        } else {
            return response()->json(['message' => 'authorization'], 200);
        }
    }

    public function profile($language)
    {
        return $this->response->choseLang($language)->modeMessage('me', $this->repository->getTableName())->success($this->repository->profile());
    }
}
