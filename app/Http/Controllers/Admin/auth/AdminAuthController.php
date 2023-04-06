<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
// use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\PasswordResetMail;
use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Events\PasswordReset;

class AdminAuthController extends Controller
{

    use HttpResponses;

    public function login(Request $request)
    {
        // return $request;
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // return Auth::guard('admin');

        if (!Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            return $this->error('', 'email or password are incorrect', 401);
        }

        $admin = Admin::where('email', $request->email)->first();

        $username =  $admin->username;
        return $this->success([
            'Admin' => $admin,
            'token' => $admin->createToken('Login API Token of ' . $username)->plainTextToken
        ]);
    }


    public function register(Request $request)
    {
        // return $request;
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'unique:admins,email'],
            'password' => ['required', 'min:8']
        ]);

        $photopath = '';
        if ($request->has('photo')) {

            $photo = $request->file('photo');
            $photopath = 'Admin-' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('public/profile', $photopath);
        }

        $admin = Admin::create([
            'username' => $request->username,
            'email' => $request->email,
            'photo' => $photopath,
            'password' => Hash::make($request->password)
        ]);

        $username =  $admin->username;
        return $this->success([
            'Admin' => $admin,
            'token' => $admin->createToken('Register API Token of ' . $username)->plainTextToken
        ]);
    }
    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();

        return $this->success([
            'message' => 'You have succesfully been logged out'
        ]);
    }


    public function updateProfile(Request $request)
    {
        $updatedAdmin = Admin::find($request->id);

        if ($request->has('photo')) {
            $photo = $request->file('photo');
            $photopath = 'Admin-' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('public/profile', $photopath);

            $updatedAdmin->update([
                'username' => $request->username,
                'photo' => $photopath,
            ]);
        } else {
            $updatedAdmin->update([
                'username' => $request->username,
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Admin has been update successfully',
            'updatedAdmin' => $updatedAdmin
        ], 200);
    }

    public function updatePassword(Request $request)
    {
        $updatedAdmin = Admin::find($request->id);
        $newPassword = $request->Newpassword;
        $oldPassword = $request->Oldpassword;

        // Compare old password with the one in database
        if (!Hash::check($oldPassword, $updatedAdmin->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Old password does not match the one in our records',
            ], 400);
        }

        // Update password
        $updatedAdmin->update([
            'password' => Hash::make($newPassword),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Admin password has been updated successfully',
            'updatedAdmin' => $updatedAdmin,
        ], 200);
    }

    public function resetPassword(Request $request)
    {
        // $validated = $request->validate([
        //     'email' => 'required|email|exists:admins,email',
        // ]);

        // $admin = Admin::where('email', $request->email)->first();

        // // Generate a new password
        // $newPassword = Str::random(10);

        // // Update admin's password
        // $admin->update([
        //     'password' => Hash::make($newPassword),
        // ]);

        // // Send the new password to the admin's email
        // Mail::to($admin->email)->send(new PasswordResetMail($newPassword, $admin->email));

        // return response()->json([
        //     'message' => 'A new password has been sent to your email address.',
        // ]);



        // $request->validate(['email' => 'required|email']);

        // if (!$request->has('email')) {
        //     return response()->json(['message' => 'Please provide your email address.'], 422);
        // }

        // $status = Password::sendResetLink(
        //     $request->only('email')
        // );
        

        // if ($status === Password::RESET_LINK_SENT) {
        //     return response()->json(['message' => __($status)], 200);
        // } else {
        //     throw ValidationException::withMessages([
        //         'email' => __($status)
        //     ]);
        // }
    }
}
