<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => [], "message" => $validator->errors()->first(), 'status' => false
            ]);
        }
        $req =  $request->only("email", 'password');
        $credentials =  User::select(['nama', 'email', 'id', 'username', 'password'])->where('email', $req['email'])->first();
        $check = Hash::check($req['password'], $credentials->password);
        if ($check) {
            $token = encodeToken($req);
            return response()->json([
                'data' => $credentials, "message" => "login Successfully", 'status' => true, 'token' => $token
            ]);
        }
        return response()->json([
            'data' => [], "message" => "Login error", 'status' => false
        ]);
    }
}
