<?php

namespace App\Http\Controllers\API;

use App\Enum\APIActions;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\UserResource;
use App\Interfaces\UserInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserAPIController extends AppBaseController
{
    private UserInterface $user_interface;

    public function __construct(UserInterface $user_interface)
    {
        $this->user_interface = $user_interface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $response = $this->user_interface->all();
            return $this->successResponse(UserResource::collection($response), APIActions::GET);
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
                'first_name' => 'required|string|min:3|max:25',
                'last_name' => 'required|string|min:3|max:25',
                'middle_name'=> 'string|min:3|max:25',
                'phone_number' => 'string|min:10|max:10',
                'email' => 'required|string',
                'password' => 'required|min:8'
            ]);
            if ($validator->fails()) {
                return $this->errorResponse($validator->errors(), APIActions::VALIDATION);
            }

            $response = $this->user_interface->create($request->all());
            return $this->successResponse(new UserResource($response), APIActions::CREATED);
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
            $response = $this->user_interface->find($id);
            return $this->successResponse(new UserResource($response), APIActions::GET);
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
            $user = $this->user_interface->find($id);
            if (empty($user)) {
                return $this->errorResponse('User not found', APIActions::VALIDATION);
            }

             $validator = Validator::make($request->all(), [
                'first_name' => 'required|string|min:3|max:25',
                'last_name' => 'required|string|min:3|max:25',
                'middle_name'=> 'string|min:3|max:25',
                'phone_number' => 'string|min:10|max:10',
                'email' => 'required|string',
                'password' => 'required|min:8'
            ]);
            if ($validator->fails()) {
                return $this->errorResponse($validator->errors(), APIActions::VALIDATION);
            }

            $response = $this->user_interface->update($id, $request->all());
            return $this->successResponse(new UserResource($response), APIActions::UPDATED);
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
            $response = $this->user_interface->delete($id);
            return $this->successResponse(new UserResource($response), APIActions::DELETED);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), APIActions::SERVER_ERROR);
        }
    }
}
