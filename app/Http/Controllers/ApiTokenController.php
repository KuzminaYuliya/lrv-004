<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApiTokenRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ApiTokenController extends Controller
{
    public function createToken(ApiTokenRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'The provided credentials are incorrect'], 401);
        }
        $token = $user->createToken($request->device_name);
        return ['token' => $token->plainTextToken];
    }
}
