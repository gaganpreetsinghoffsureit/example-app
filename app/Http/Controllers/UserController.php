<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Mail\ForgotPasswordOtpMail;
use App\Mail\SignUpOtpMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class UserController extends Controller
{
    public function login(Request $request)
    {
        $request = (object)$request->validate([
            "email_or_username" => ['required'],
            "password" => ['required'],
        ]);

        $user = User::where([["email", '=', $request->email_or_username]])->orWhere([["username", '=', $request->email_or_username]])->first();
        if ($user instanceof User) {
            if (Hash::check($request->password, $user->password)) {
                $user->token = $user->createToken('AccessToken')->accessToken;
                return ResponseHelper::success(__("messages.login-success"), $user);
            } else
                return ResponseHelper::error(__("messages.login-error"), null);
        } else {
            return ResponseHelper::error(__("messages.login-error"), null);
        }
    }


    public function forgotPassword(Request $request)
    {
        $request = (object)$request->validate([
            "email" => ['required', "exists:users", "email"],
        ]);

        $user = new User();
        $user = User::where([["email", "=", $request->email]])->first();
        $user->setRememberToken(rand(1000, 9999));
        $user->email_verified_at = null;
        $user->saveOrFail();
        $user->token = $user->createToken('AccessToken')->accessToken;

        if (Mail::to($user->email)->send(new ForgotPasswordOtpMail($user))) {
            return ResponseHelper::success(__("messages.forgot-password-mail-success"), $user);
        } else
            return ResponseHelper::error(__("messages.forgot-password-mail-error"), null);
    }



    public function signIn(Request $request)
    {
        $request = $request->validate([
            "email" => ['required', "unique:users", "email"],
        ]);

        $user = new User();
        $user->fill($request);
        $user->setRememberToken(rand(1000, 9999));
        $user->saveOrFail();
        $user->token = $user->createToken('AccessToken')->accessToken;

        if (Mail::to($user->email)->send(new SignUpOtpMail($user))) {
            return ResponseHelper::success(__("messages.send-sign-up-mail-success"), $user);
        } else
            return ResponseHelper::error(__("messages.send-sign-up-mail-error"), null);
    }

    public function otpVerification(Request $request)
    {
        $request = (object)$request->validate([
            "otp" => ["required", "numeric", "min:1000", "max:9999"],
        ]);

        $user = User::where("email", Auth::user()->email)->first();
        if ($user->getRememberToken() == $request->otp) {
            $user->email_verified_at = Carbon::now();
            $user->setRememberToken(null);
            $user->saveOrFail();
            return ResponseHelper::success(__("messages.otp-verified-success"), $user);
        } else {
            return ResponseHelper::error(__("messages.otp-not-match"), null);
        }
    }
    public function editProfile(Request $request)
    {
        $request = $request->validate([
            "username" => ["required", "string", "min:3", "max:255", "unique:users,username," . Auth::user()->id],
        ]);

        $user = User::find(Auth::user()->id);
        $user->fill($request);
        $user->saveOrFail();
        return ResponseHelper::success(__("messages.profile-updated-success"), $user);
    }
    public function editPassword(Request $request)
    {
        $request = (object)$request->validate([
            'password' => 'required|string|min:8',
            'confirm_password' => 'required|string|same:password',
        ]);
        $user = User::find(Auth::user()->id);
        $user->password = $request->password;
        $user->saveOrFail();
        return ResponseHelper::success(__("messages.password-updated-success"), $user);
    }
}
