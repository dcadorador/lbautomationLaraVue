<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\UserResource;
use App\Repositories\Interfaces\UserInterface;
use App\Http\Requests\User\UserCreateRequest;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Response;

class UserController extends ApiController
{
    public function __construct(UserInterface $repository) {
        $this->repository = $repository;
    }

    /**
     * @param UserCreateRequest $request
     * @return mixed
     */
    public function create(UserCreateRequest $request) {

        $input = $request->only([
            'name',
            'password',
            'email'
        ]);

        try {
            // this is not used for registration, only for the creation of users
            $user = $this->repository->store($input);

        } catch (\Exception $e) {

            return response()->json([
               'status' => false,
               'message' => json_encode($e->getMessage())
            ], Response::HTTP_INTERNAL_SERVER_ERROR );

        }

        return UserResource::make($user);
    }
}
