<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Users;

class LoginController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    
    public function __construct()
    {
        // $this->middleware('auth:api', ['except' => ['login']]);
        
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {

        $password = hash('sha256',request('password'));
        $email = request('email');

        $credentials = request(['email', 'password']);
        $user = Users::where([
            ['email', $email],
            ['password', $password]
        ])->first();
        if ($user == null) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $token = auth('services')->login($user);
        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        $user = auth('services')->user();
        return response()->json([
            'user'=> [
                'id' => $user->id,
                'name' => $user->name,
                'client_id' => $user->client_id,
            ],
            'client_id'=> $user->client_id,
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => auth('services')->factory()->getTTL() * 60
        ]);
    }
}
