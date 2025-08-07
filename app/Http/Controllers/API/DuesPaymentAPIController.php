<?php

namespace App\Http\Controllers\API;

use App\Enum\APIActions;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\DuesPaymentResource;
use App\Interfaces\DuesPaymentInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DuesPaymentAPIController extends AppBaseController
{
    private DuesPaymentInterface $dues_payment_interface;

    public function __construct(DuesPaymentInterface $dues_payment_interface)
    {
        $this->dues_payment_interface = $dues_payment_interface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $response = $this->dues_payment_interface->all();

            return $this->successResponse(DuesPaymentResource::collection($response), APIActions::GET);
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
                'dues_id' => 'required|integer',
                'amount_paid' => 'required|integer',
                'balance' => 'required|integer',
            ]);
            if ($validator->fails()) {
                return $this->errorResponse($validator->errors(), APIActions::VALIDATION);
            }

            $response = $this->dues_payment_interface->create($request->all());

            return $this->successResponse(new DuesPaymentResource($response), APIActions::CREATED);
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
            $response = $this->dues_payment_interface->find($id);

            return $this->successResponse(new DuesPaymentResource($response), APIActions::GET);
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
            $payment = $this->dues_payment_interface->find($id);
            if (empty($payment)) {
                return $this->errorResponse('Dues payment not found', APIActions::VALIDATION);
            }

            $validator = Validator::make($request->all(), [
                'user_id' => 'required|integer',
                'member_id' => 'required|integer',
                'dues_id' => 'required|integer',
                'amount_paid' => 'required|integer',
                'balance' => 'required|integer',
            ]);
            if ($validator->fails()) {
                return $this->errorResponse($validator->errors(), APIActions::VALIDATION);
            }

            $response = $this->dues_payment_interface->update($id, $request->all());

            return $this->successResponse(new DuesPaymentResource($response), APIActions::UPDATED);
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
            $response = $this->dues_payment_interface->delete($id);

            return $this->successResponse(new DuesPaymentResource($response), APIActions::DELETED);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), APIActions::SERVER_ERROR);
        }
    }
}
