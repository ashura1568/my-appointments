<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use App\Http\Traits\ValidateAndCreatePatient;

use Auth;
use JwtAuth;
use App\Models\User;

class AuthController extends Controller
{
    use ValidateAndCreatePatient;
        // Login user and return JWT token
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        /*if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);*/
        //return "hola";

        /*if (Auth::guard('api')->attempt($credentials)) {
		    $user = Auth::guard('api')->user();
		    $jwt = JwtAuth::generateToken($user);
		    $success = true;
		    
		    // Return successfull sign in response with the generated jwt.
		    return compact('success', 'user', 'jwt');
		} else {
		    // Return response for failed attempt.
			$success = false;
			$message = 'Invalid credentials';
			return compact('success', 'message');
		}*/

        if (Auth::guard('api')->attempt($credentials)) {
		    $user = Auth::guard('api')->user();
		    $jwt = auth('api')->attempt($credentials);
		    $success = true;
		    
		    // Return successfull sign in response with the generated jwt.
		    return compact('success', 'user', 'jwt');
            //return compact('success', 'user');
		} else {
		    // Return response for failed attempt.
			$success = false;
			$message = 'Invalid credentials';
			return compact('success', 'message');
		}
    }

        // Logout user (invalidate token)
    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
    // Register new user
    public function register(Request $request)
    {
        /*$validator = Validator::make($request->all(), [
            'name'       => 'required|string|max:255',
            'email'      => 'required|string|email|max:255|unique:users',
            'password'   => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);*/

        //$credentials = $request->only('email', 'password');

        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        Auth::guard('api')->login($user);
        //$jwt = auth('api')->attempt($credentials);
        //$jwt = JwAuth::generateToken($user);
        //$success = true;

        //return compact('sucess','user','jwt');
        return compact('user');
    }

    // Get user profile
    public function profile()
    {
        return response()->json(auth('api')->user());
    }



    // Refresh JWT token
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    // Return token response structure
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth('api')->factory()->getTTL() * 60,
        ]);
    }
}
