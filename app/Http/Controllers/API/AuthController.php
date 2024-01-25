<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\User;

class AuthController extends BaseController
{

    public function register(request $request)
    {
        try {
            $validator = Validator::make($request->all() , [
                'name'=> 'required|string',
                'email'=> 'required|email|unique:users',
                'password'=> 'required|string|min:4',

            ]);
            if($validator->fails()){
                return $this->sendError($validator->errors(), "Please Validate Error", 400);
            }

            $input = $request->all();
            $input['password'] = Hash::make($input['password']);

            $user = User::create($input);
            
            return $this->sendResponse($user, "User is Registered Successfully");

        } catch (\Exception $error) {
            return $this->sendError($error, "server error", 500);
        }
    }

    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|string|min:4',
            ]);

            if ($validator->fails()) {
                return $this->sendError($validator->errors(), "Please Validate Error", 400);
            }

            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {

                return $this->sendError(['error' => 'Invalid Credentials'], 'Please check your email and password', 401);
            }
            $token = $user->createToken('api-token')->plainTextToken;

            return $this->sendResponse($user, "User login successfully", ["token" => $token]);

        } catch (\Exception $error) {
            return $this->sendError($error, "server error", 500);
        }
    }


}
