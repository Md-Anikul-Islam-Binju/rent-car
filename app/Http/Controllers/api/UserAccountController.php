<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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


    public function sendToken(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'Email not found'], 404);
        }

        $token = Str::random(60);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => $token,
                'created_at' => now(),
            ]
        );

        // send email
        Mail::raw("Your password reset token is: $token", function ($msg) use ($request) {
            $msg->to($request->email)
                ->subject('Password Reset Token');
        });

        return response()->json(['message' => 'Reset token sent to email']);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'token'    => 'required',
            'password' => 'required|min:6',
        ]);

        $tokenRecord = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$tokenRecord || $tokenRecord->token !== $request->token) {
            return response()->json(['message' => 'Invalid token'], 400);
        }

        // update password
        User::where('email', $request->email)->update([
            'password' => Hash::make($request->password)
        ]);

        // delete token after successful reset
        DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->delete();

        return response()->json(['message' => 'Password reset successful']);
    }


}
