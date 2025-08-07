<?php

namespace App\Http\Controllers;

use App\Enum\APIActions;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Server(url="/api")
 * @OA\Info(
 *   title="Rent for Me Api",
 *   version="1.0.0",
 *   description="Rent for Me Api Documentation",
 *   @OA\Contact(
 *          name="Nyarko Isaac Kwadwo",
 *          url="https://arnsoninnovate.com",
 *          email="nyarkorep@gmail.com",
 *   )
 * )
 *
 * This class should be parent class for other API controllers
 * Class AppBaseController
 */
class AppBaseController extends Controller
{
    public function successResponse($data, $actionType)
    {
        switch ($actionType) {
            case APIActions::GET:
                return response()->json([
                    'data' => $data,
                    'message' => 'Data retrieved successful'
                ], 200);
            case APIActions::CREATED:
                return response()->json([
                    'data' => $data,
                    'message' => 'Data created successful'
                ], 201);
            case APIActions::UPDATED:
                return response()->json([
                    'data' => $data,
                    'message' => 'Data updated successful'
                ], 201);
            case APIActions::DELETED:
                return response()->json([
                    'data' => $data,
                    'message' => 'Data deleted successful'
                ], 204);
            default:
                return response()->json([
                    'data' => $data,
                    'message' => 'Unknown status code'
                ], 418);
        }
    }

    public function errorResponse($data, $actionType)
    {
        switch ($actionType) {
            case APIActions::VALIDATION:
                return response()->json([
                    'error' => $data
                ], 422);
            default:
                return response()->json([
                    'error' => $data
                ], 500);
        }
    }
}
