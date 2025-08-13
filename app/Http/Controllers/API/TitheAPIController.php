<?php

namespace App\Http\Controllers\API;

use App\Enum\APIActions;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\TitheResource;
use App\Interfaces\TitheInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TitheAPIController extends AppBaseController
{
    private TitheInterface $tithe_interface;

    public function __construct(TitheInterface $tithe_interface)
    {
        $this->tithe_interface = $tithe_interface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $response = $this->tithe_interface->all();

            return $this->successResponse(TitheResource::collection($response), APIActions::GET);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), APIActions::SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|integer',
                'member_id' => 'required|integer',
                'amount_paid' => 'required|integer',
                
            ]);
            if ($validator->fails()) {
                return $this->errorResponse($validator->errors(), APIActions::VALIDATION);
            }

            $response = $this->tithe_interface->create($request->all());

            return $this->successResponse(new TitheResource($response), APIActions::CREATED);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), APIActions::SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $response = $this->tithe_interface->find($id);

            return $this->successResponse(new TitheResource($response), APIActions::GET);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), APIActions::SERVER_ERROR);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $tithe = $this->tithe_interface->find($id);
            if (empty($tithe)) {
                return $this->errorResponse('Tithe not found', APIActions::VALIDATION);
            }

            $validator = Validator::make($request->all(), [
                'user_id' => 'required|integer',
                'member_id' => 'required|integer',
                'amount_paid' => 'required|integer',
                
            ]);

            if ($validator->fails()) {
                return $this->errorResponse($validator->errors(), APIActions::VALIDATION);
            }

            $response = $this->tithe_interface->update($id, $request->all());

            return $this->successResponse(new TitheResource($response), APIActions::UPDATED);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), APIActions::SERVER_ERROR);
        } //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $response = $this->tithe_interface->delete($id);

            return $this->successResponse(new TitheResource($response), APIActions::DELETED);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), APIActions::SERVER_ERROR);
        }
    }
}
