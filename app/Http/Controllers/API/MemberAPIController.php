<?php

namespace App\Http\Controllers\API;

use App\Enum\APIActions;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\MemberResource;
use App\Interfaces\MemberInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MemberAPIController extends AppBaseController
{
    private MemberInterface $member_interface;

    public function __construct(MemberInterface $member_interface)
    {
        $this->member_interface = $member_interface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $response = $this->member_interface->all();

            return $this->successResponse(MemberResource::collection($response), APIActions::GET);
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
                'first_name' => 'required|string|min:3|max:45',
                'last_name' => 'required|string|min:3|max:45',
                'middle_name' => 'string|min:3|max:25',
                'phone_number' => 'required|string|min:10|max:10',
                'home_town' => 'required|string',
                'place_of_stay' => 'required|string',
                'parent_status' => 'boolean',
                'parent_name' => 'string|min:3|max:25',
                'parent_number' => 'string',
                'marriage_status' => 'string|min:3|max:25',
                'spouse_name' => 'string|min:3|max:25',
                'spouse_number' => 'string',
                'number_of_children' => 'integer',
                'position' => 'string',
            ]);
            if ($validator->fails()) {
                return $this->errorResponse($validator->errors(), APIActions::VALIDATION);
            }

            $response = $this->member_interface->create($request->all());

            return $this->successResponse(new MemberResource($response), APIActions::CREATED);
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
            $response = $this->member_interface->find($id);

            return $this->successResponse(new MemberResource($response), APIActions::GET);
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
            $dues = $this->member_interface->find($id);
            if (empty($dues)) {
                return $this->errorResponse('Member not found', APIActions::VALIDATION);
            }

            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string|min:3|max:25',
                'last_name' => 'required|string|min:3|max:25',
                'middle_name' => 'string|min:3|max:25',
                'phone_number' => 'required|string|min:10|max:10',
                'home_town' => 'required|string',
                'place of stay' => 'required|string',
                'parent_status' => 'boolean|required',
                'parent_name' => 'string|min:3|max:25',
                'parent_number' => 'string',
                'marriage_status' => 'string|min:3|max:25',
                'spouse_name' => 'string|min:3|max:25',
                'spouse_number' => 'string',
                'number_of_children' => 'integer',
                'position' => 'string',
            ]);
            if ($validator->fails()) {
                return $this->errorResponse($validator->errors(), APIActions::VALIDATION);
            }

            $response = $this->member_interface->update($id, $request->all());

            return $this->successResponse(new MemberResource($response), APIActions::UPDATED);
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
            $response = $this->member_interface->delete($id);

            return $this->successResponse(new MemberResource($response), APIActions::DELETED);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), APIActions::SERVER_ERROR);
        }
    }
}
