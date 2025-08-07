<?php

namespace App\Http\Controllers\API;

use App\Enum\APIActions;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\ChurchResource;
use App\Interfaces\ChurchInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChurchAPIController extends AppBaseController
{
    private ChurchInterface $church_interface;

    public function __construct(ChurchInterface $church_interface)
    {
        $this->church_interface = $church_interface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $response = $this->church_interface->all();

            return $this->successResponse(ChurchResource::collection($response), APIActions::GET);
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
                'name' => 'required|string|min:3|max:120',
                'head_pastor' => 'required|string|min:3|max:45',
                'phone_number' => 'required|string|min:10|max:10',
                'email' => 'string',
                'location' => 'required|string',
                'address' => 'required|string',
                'mission_statement' => 'string|min:3|max:250',
                'logo' => 'string',
            ]);
            if ($validator->fails()) {
                return $this->errorResponse($validator->errors(), APIActions::VALIDATION);
            }

            $response = $this->church_interface->create($request->all());

            return $this->successResponse(new ChurchResource($response), APIActions::CREATED);
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
            $response = $this->church_interface->find($id);

            return $this->successResponse(new ChurchResource($response), APIActions::GET);
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
            $church = $this->church_interface->find($id);
            if (empty($church)) {
                return $this->errorResponse('Church not found', APIActions::VALIDATION);
            }

            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'head_pastor' => 'required|string',
                'phone_number' => 'required|string',
                'email' => 'string',
                'location' => 'required|string',
                'address' => 'required|string',
                'mission_statement' => 'string',
                'logo' => 'string',
            ]);

            if ($validator->fails()) {
                return $this->errorResponse($validator->errors(), APIActions::VALIDATION);
            }

            $response = $this->church_interface->update($id, $request->all());

            return $this->successResponse(new ChurchResource($response), APIActions::UPDATED);
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
            $response = $this->church_interface->delete($id);

            return $this->successResponse(new ChurchResource($response), APIActions::DELETED);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), APIActions::SERVER_ERROR);
        }
    }
}
