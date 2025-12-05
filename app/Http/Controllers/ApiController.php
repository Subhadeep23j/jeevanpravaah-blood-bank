<?php

namespace App\Http\Controllers;

use App\Models\User;
// use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    //
    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        // $data = User::where('email', $username)->where('password', $password)->first();
        try {

            Auth::attempt(['email' => $username, 'password' => $password]);
            $data = Auth::user();
            if ($data) {
                $token = $data->createToken('API Token');
                $data->api_token = $token->plainTextToken;
                return response()->json(['status' => true, 'data' =>  $data]);
            }

            return response()->json(['status' => false, 'message' => 'Invalid credentials']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    public function getAllData()
    {
        $user = Auth::guard('api')->user();

    if (!$user) {
        return response()->json(['status' => false, 'message' => 'Unauthorized'], 401);
    }
    
        $data = User::all();
        return response()->json(['status' => true, 'data' =>  $data]);
    }
}
