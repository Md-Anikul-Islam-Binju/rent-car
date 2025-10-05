<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserAccountController extends Controller
{
    public function storeUser(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:15',

        ]);

        // Create a new user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'] ?? null,
            'password' => bcrypt($request->input('password', 'defaultpassword')), // Set a default password or handle password input securely
            'role' => 'user', // Default role
        ]);

        // Return a success response
        return response()->json(['message' => 'User account created successfully', 'user' => $user], 201);

    }
}
