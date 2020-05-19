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

    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function collection(Request $request)
    {
        return UserResource::collection($this->repository->collection());
    }

    /**
     * @param Request $request
     * @param $id
     * @return UserResource|\Illuminate\Http\JsonResponse
     */
    public function get(Request $request, $id)
    {
        $user = $this->repository->find($id);

        if(!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User Not Found'
            ], Response::HTTP_NOT_FOUND );
        }

        return UserResource::make($user);
    }

    /**
     * @param Request $request
     * @param $id
     * @return UserResource|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $user = $this->repository->find($id);

        if(!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User Not Found'
            ], Response::HTTP_NOT_FOUND );
        }

        $input = $request->only([
           'name',
           'email',
           'password'
        ]);

        $updated_user = $this->repository->update($id, $input);

        return UserResource::make($updated_user);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request, $id)
    {
        $user = $this->repository->find($id);

        if(!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User Not Found'
            ], Response::HTTP_NOT_FOUND );
        }

        $this->repository->delete($id);

        return response()->json([
            'status' => true,
            'message' => 'User Deleted'
        ], Response::HTTP_OK );
    }

}
