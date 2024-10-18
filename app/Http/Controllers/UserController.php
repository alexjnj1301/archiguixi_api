<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // create a new user
        public function register(Request $request){
            try {
                $request->validate([
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required|min:6'
                ], [
                    'name.required' => 'Le champ prénom est requis.',
                    'email.required' => 'Le champ email est requis.',
                    'email.email' => 'L\'adresse email doit être valide.',
                    'email.unique' => 'L\'adresse email est déjà utilisée.',
                    'password.required' => 'Le mot de passe est requis.',
                    'password.min' => 'Le mot de passe doit contenir au moins 6 caractères.'
                ]);

                $user = User::create([
                    'name' => $request->name,
                    'email'=> $request->email,
                    'password' => bcrypt($request->password)
                ]);

                $token = $user->createToken('auth_token', ['expires_in' => 7200])->plainTextToken;

                return response()->json([
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email
                    ]
                ]);

            } catch (ValidationException $e) {
                return response()->json(['errors' => $e->validator->errors()], 422);
            }
        }

        // user login
        public function login(Request $request)
        {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ], [
                'email.required' => 'Le champ email est requis.',
                'email.email' => 'L\'adresse email doit être valide.',
                'password.required' => 'Le mot de passe est requis.'
            ]);

            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $token = $user->createToken('auth_token', ['expires_in' => 7200])->plainTextToken;

                return response()->json([
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                    ]
                ]);

            } else {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }
        }
}
