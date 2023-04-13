<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Users;
use Illuminate\Support\Facades\Crypt;

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
        if (request('api_key') !== null && request('salt') !== '') {

            $api_key = request('api_key');
            $salt = request('salt');

            $user = Users::where([
                ['api_key', $api_key],
                ['password', $salt]
            ])->first();

        } else if (request('email') !== null && request('password') !== ''){
            $email = request('email');
            $password = hash('sha256', request('password'));

            $user = Users::where([
                ['email', $email],
                ['password', $password]
            ])->first();
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if ($user == null) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $token = auth('services')->login($user);
        return $this->respondWithToken($token, isset($api_key));
    }

    protected function respondWithToken($token, $api = false)
    {
        $user = auth('services')->user();

        $result = [
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => auth('services')->factory()->getTTL() * 60
        ];

        if(!$api) {
            $result['user'] = [
                'id' => $user->id,
                'name' => $user->name,
                'client_id' => $user->client_id,
                'permissions' => $user->permissions,
            ];
        }
        
        return response()->json($result);
    }
}
