<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('admin.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $token = Str::random(64);
        
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now()
        ]);

        Mail::send('admin.email.reset-password', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password Notification');
        });

        return back()->with('status', 'We have emailed your password reset link!');
    }

    public function showResetForm($token)
    {
        $reset = DB::table('password_reset_tokens')
            ->where('token', $token)
            ->first();

        if (!$reset) {
            return redirect()->route('admin.password.request')
                ->with('error', 'Invalid password reset token.');
        }

        return view('admin.reset-password', ['token' => $token, 'email' => $reset->email]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $reset = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$reset) {
            return back()->with('error', 'Invalid password reset token.');
        }

        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->delete();

        return redirect()->route('admin.login')
            ->with('status', 'Your password has been reset successfully!');
    }
} 