<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{

    public function editProfile(Request $request)
    {
        try {
            $auth = $request->bearerToken();
            $auth =  userPrincipal($auth);
            $user = User::find($auth->id);

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email,' . $user->id,
                'password' => 'min:8',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'data' => [], "message" => $validator->errors()->first(), 'status' => false
                ]);
            }
            $user->nama = $request->input('name');
            $user->email = $request->input('email');

            if ($request->filled('password')) {
                $user->password = Hash::make($request->input('password'));
            }
            $user->save();
            return response()->json(['data' => $user, 'message' => 'Profile updated successfully', "status" => true]);
        } catch (Exception $e) {
            Log::error("CustomException: " . $e->getMessage());
            return $e->getMessage();
        }
    }
}
