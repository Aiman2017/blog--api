<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AccessTokenController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required',
                'device_name' => 'nullable',
            ]);

        $user = User::query()->where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            $deviceName = $request->post('device_name', $request->userAgent());
            $token = $user->createToken($deviceName);

            return response()->json([
                'token' => $token->plainTextToken,
                'user' => $user,
                'device_name' => $deviceName,
                'message' => 'Access token created successfully.',
            ], Response::HTTP_CREATED);
        }
        return response()->json([
            'message' => 'Access token not created.',

        ], Response::HTTP_UNAUTHORIZED);
    }
}


