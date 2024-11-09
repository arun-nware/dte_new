<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\LoginResponseResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'reqDate' => 'required',
            'reqTime' => 'required',
            'userType' => 'required',
            'userName' => 'required',
            'password' => 'required',
            ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $errorData = [
                "response" => "FAILED",
                "respCode" => Response::HTTP_UNPROCESSABLE_ENTITY,
                "resDate" => date("Ymd"),
                "resTime" => date("His"),
                "errors" => $errors
            ];
            return \response($errorData);
        }

        try {
            $credentials = ['phone' => $request['userName'], 'password' => $request['password']];
            if (!$token = auth('api')->attempt($credentials)) {
                $errorData = [
                    "response" => "FAILED",
                    "respCode" => 401,
                    "resDate" => date("Ymd"),
                    "resTime" => date("His"),
                    "errors" => "Unauthorized"
                ];
                return \response($errorData);
            }

            $role = auth('api')->user()->hasRole('Operator');
            if ($role) {
                $data = [
                    "token" => $this->respondWithToken($token),
                    "user" => auth()->guard('api')->user()->toArray(),
                ];
                return new LoginResponseResource($data);
            }
            throw new \Exception('Operator is not found');

        } catch (\Exception $e) {
            return response([
                "reqDate" => $request["reqDate"],
                "reqTime" => $request["reqTime"],
                "response" => "FAILED",
                "respCode" => "401",
                "resDate" => date('Ymd'),
                "resTime" => date('His'),
            ]);
        }
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return [
            'access_token' => auth('api')->user(),
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ];
    }

}
