<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Infusionsoft\InfusionsoftRequest;
use App\Http\Resources\InfusionsoftAccountLogCollection;
use App\Http\Resources\InfusionsoftCollection;
use App\Repositories\Interfaces\InfusionsoftInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InfusionsoftAccountController extends ApiController
{
    public function __construct(InfusionsoftInterface $repository) {
        $this->repository = $repository;
    }

    /**
     * @return InfusionsoftCollection
     */
    public function index()
    {
        return InfusionsoftCollection::make($this->repository->collection());
    }

    public function create(InfusionsoftRequest $request)
    {

    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {

        try {
            $account = $this->repository->find($id);

            if($account) {
                $account->delete();
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Successfully Deleted Account'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    /**
     * @param Request $request
     * @param $app
     * @return InfusionsoftAccountLogCollection|\Illuminate\Http\JsonResponse
     */
    public function accountLogs(Request $request, $app)
    {
        try {
            $account = $this->repository
                        ->findBy(['app_name' => $app])
                            ->first();

            if(!$account) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Account not found'
                ], Response::HTTP_NOT_FOUND);
            }

            $data = $account
                ->logs()
                ->orderBy('created_at', 'DESC')
                ->get();

            \Log::debug(json_encode($data));
            return InfusionsoftAccountLogCollection::make($data);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
