<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Auth;

class AuthAPIController extends AppBaseController
{

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (request(['remember_token'])) {
            Auth::factory()->setTTL(43200);
        } else {
            Auth::factory()->setTTL(180);
        }

        if (!$token = Auth::attempt($credentials)) {
            return $this->errorResponse("Unauthorized Account", 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAuthUser()
    {
        return response()->json(Auth::user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::logout();
        return $this->successResponse([], "Successfully logged out", 200);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(Auth::refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        $user = Auth::user();
        if ($user->verified === 0) {
            return $this->errorResponse("Account has not been verified", 402);
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            // 'user' => new AuthResource($user),
            'permissions' => $user->getAllPermissions()->pluck('name'),
        ]);
    }
}
