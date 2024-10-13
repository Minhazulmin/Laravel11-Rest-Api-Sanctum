<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller {
    public function register( RegisterUserRequest $request ) {
        $validatedData = $request->validated();
        $user          = User::create( $validatedData );
        $token         = $user->createToken( $user->name );
        return response()->json( [
            'success' => true,
            'user'    => $user,
            'token'   => $token->plainTextToken,
        ], 200 );
    }

    public function login( LoginUserRequest $request ) {

        $request->validated();
        $user = User::where( 'email', $request->email )->first();

        // Check if user is exist or not
        if ( !$user || !Hash::check( $request->password, $user->password ) ) {
            return response()->json( [
                'success' => true,
                'message' => 'The provided password is incorrect',
            ], 401 );
        }

        $token = $user->createToken( $user->name );
        return response()->json( [
            'success' => true,
            'user'    => $user,
            'token'   => $token->plainTextToken,
        ], 200 );

        return 'login';
    }

    public function logout( Request $request ) {
        $request->user()->tokens()->delete();
        return response()->json( [
            'success' => true,
            'message' => 'Logged out successfully',
        ], 200 );
    }
}