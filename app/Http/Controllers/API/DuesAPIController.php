<?php

namespace App\Http\Controllers\API;

use App\Enum\APIActions;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\DuesResource;
use App\Interfaces\DuesInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DuesAPIController extends AppBaseController
{
    private DuesInterface $dues_interface;

    public function __construct(DuesInterface $dues_interface)
    {
        $this->dues_interface = $dues_interface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $response = $this->dues_interface->all();
            return $this->successResponse(DuesResource::collection($response), APIActions::GET);
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
                'amount' => 'required|decimal:2',
                'year' => 'required|integer',
                'status' => 'string'
            ]);
            if ($validator->fails()) {
                return $this->errorResponse($validator->errors(), APIActions::VALIDATION);
            }

            $response = $this->dues_interface->create($request->all());
            return $this->successResponse(new DuesResource($response), APIActions::CREATED);
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
            $response = $this->dues_interface->find($id);
            return $this->successResponse(new DuesResource($response), APIActions::GET);
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
            $dues = $this->dues_interface->find($id);
            if (empty($dues)) {
                return $this->errorResponse('Dues not found', APIActions::VALIDATION);
            }

            $validator = Validator::make($request->all(), [
                'amount' => 'required|decimal:2',
                'year' => 'required|integer',
                'status' => 'string'
            ]);

            if ($validator->fails()) {
                return $this->errorResponse($validator->errors(), APIActions::VALIDATION);
            }

            $response = $this->dues_interface->update($id, $request->all());
            return $this->successResponse(new DuesResource($response), APIActions::UPDATED);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), APIActions::SERVER_ERROR);
        } 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         try {
            $response = $this->dues_interface->delete($id);
            return $this->successResponse(new DuesResource($response), APIActions::DELETED);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), APIActions::SERVER_ERROR);
        }
    }
}
