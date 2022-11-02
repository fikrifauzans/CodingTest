<?php

namespace App\Http\Controllers\V1;

use App\Repositories\V1\Interface\IUsersRepository;
use Illuminate\Http\Request;
use App\Services\Helper\Helper;
use App\Services\Handler\JsonResponse as JsonCustomResponse;
use App\Services\Validator\CustomValidator;
use Illuminate\Support\Facades\Hash;

// use App\User;

class UsersController extends Controller
{
    /**
     * Retrieve the user for the given ID.
     *
     * @param  int  $id
     * @return Response
     */

    protected $repository;
    protected $validator;
    protected $response;
    protected $relations = ['Role', 'Supervisor'];

    public function __construct(IUsersRepository $repository, CustomValidator $validator, JsonCustomResponse $response)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->response = $response;
    }

    public function index(Request $request, $language)
    {
        $relations = $request->relations ? Helper::getRelations($request) : $this->relations;

        return $this->response->choseLang($language)->modeMessage('index', $this->repository->getTableName())->success($this->repository->get($request, $relations));
    }

    public function show($language, $id)
    {

        return $this->response->choseLang($language)->modeMessage('show', $this->repository->getTableName())->success($this->repository->findId($id, false));
    }

    public function store(Request $request, $language)
    {
        if ($request->password) $request->merge(['password' => Hash::make($request->password)]);

        $validated = $this->validator->validate($request, $language, $this->repository->getTableName());

        if ($validated->fails()) return response()->json(['errors' => $validated->errors()], 422);

        else return $this->response->choseLang($language)->modeMessage('create', $this->repository->getTableName())->success($this->repository->updateOrCreate(null, $request->all()));
    }

    public function update(Request $request,  $language, $id)
    {
        if ($request->password) $request->merge(['password' => Hash::make($request->password)]);

        // $validated = $this->validator->validate($request, $language, $this->repository->getTableName());

        // if ($validated->fails()) return response()->json(['errors' => $validated->errors()], 422);

        return $this->response->choseLang($language)->modeMessage('update', $this->repository->getTableName())->success($this->repository->updateOrCreate($id, $request->all()));
    }

    public function destroy($language, $id)
    {
        if ($this->repository->destroy($id)) return $this->response->choseLang($language)->modeMessage('delete', $this->repository->getTableName())->success([]);
    }

    public function force($language, $id)
    {
        if ($this->repository->destroy($id, true)) return $this->response->choseLang($language)->modeMessage('force', $this->repository->getTableName())->success([]);
    }

    public function restore($id, $language)
    {
        if ($this->repository->restore($id)) return  $this->response->choseLang($language)->modeMessage('restore', $this->repository->getTableName())->success($this->repository->findId($id, false));
    }
}
