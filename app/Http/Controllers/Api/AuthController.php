<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\User\UserCreateRequest;
use App\Http\Resources\UserResource;
use App\Http\Requests\Authentication\AuthRequest;
use App\Repositories\Interfaces\UserInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends ApiController
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => [ 'login', 'register' ]]);
    }

    /**
     * @param UserCreateRequest $request
     * @param UserInterface $repository
     * @return mixed
     */
    public function register(UserCreateRequest $request, UserInterface $repository) {

        $input = $request->only([
            'name',
            'password',
            'email'
        ]);

        try {

            $user = $repository->store($input);

            if( ! $token = auth('api')->attempt([
                    'email' => $request->input('email'),
                    'password' => $request->input('password')
                ]) ) {

                return response()->json([
                    'status' => false,
                    'message' => 'Registration failed please contact administrator.'
                ]);

            }
        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => json_encode($e->getMessage())
            ], Response::HTTP_INTERNAL_SERVER_ERROR );

        }

        return UserResource::make($user)->additional([ 'token' => $token ]);
    }

    /**
     * @param AuthRequest $request
     * @return mixed
     */
    public function login(AuthRequest $request) {

        $input = $request->only([
            'email',
            'password'
        ]);

        try {

            if (! $token = auth('api')->attempt($input)) {

                return response()->json([
                    'success' => false,
                    'message' => 'Invalid Email or Password',
                ], Response::HTTP_UNAUTHORIZED );

            }

            $user = auth('api')->user();
            $user->last_login = Carbon::now()->toDateTimeString();
            $user->save();

        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => json_encode($e->getMessage())
            ], Response::HTTP_INTERNAL_SERVER_ERROR );

        }

        return UserResource::make($user)->additional([ 'token' => $token ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {

        try {

            auth()->logout();

        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], Response::HTTP_INTERNAL_SERVER_ERROR );
        }

        return response()->json([
            'success' => true,
            'message' => 'User logged out successfully'
        ]);

    }
}
