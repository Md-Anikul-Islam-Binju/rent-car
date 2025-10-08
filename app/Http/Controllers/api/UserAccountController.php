<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserAccountController extends Controller
{
    public function login(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'email' => 'required|email|exists:users',
            'password' => 'required'

        ]);
        if($validate->fails()){
            return response()->json([
                'errors' => $validate->errors()
            ],422);
        }

        $reqData = request()->only('email','password');
        if(Auth::attempt($reqData)){
            $user = Auth::user();
            $data['token'] = $user->createToken('userToken')->plainTextToken;
            $data['user'] = $user;
            return response()->json($data,200);
        }else{
            $data['loginField'] = 'Email Or Password Incorrect';
            return response()->json([
                'errors' => $data
            ],401);
        }
    }


}
