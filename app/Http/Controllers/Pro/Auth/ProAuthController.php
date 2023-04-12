<?php

namespace App\Http\Controllers\Pro\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pro;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ProAuthController extends Controller
{

    use HttpResponses;

    public function login(Request $request)
    {
        // return $request;
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // return Auth::guard('Pro');

        if (!Auth::guard('pro')->attempt($request->only('email', 'password'))) {
            return response()->json([
                'status' => False,
                'message' => 'Email or Password are incorrect',
            ], 401);
        }

        $pro = Pro::where('email', $request->email)->first();

        return response()->json([
            'status' => true,
            'message' => 'You loged in successfully',
            'token' => $pro->createToken('Login API Token of ' . $pro->lastName)->plainTextToken,
            'Pro' => $pro
        ], 200);
    }


    public function register(Request $request)
    {
        // return $request;
        $validated = $request->validate([
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'phoneNumber' => ['required', 'string', 'max:255'],
            'CIN' => ['required', 'string', 'max:255'],
            'CIN_photo' => ['required'],
            'email' => ['required', 'string', 'max:255', 'unique:pros,email'],
            'password' => ['required', 'min:8']
        ]);

        $photopath = '';
        if ($request->has('photo')) {

            $photo = $request->file('photo');
            $photopath = 'Pro-' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('public/profile', $photopath);
        }
        if ($request->has('CIN_photo')) {

            $CINphoto = $request->file('CIN_photo');
            $CINphotopath = 'ProCIN-' . uniqid() . '.' . $CINphoto->getClientOriginalExtension();
            $CINphoto->storeAs('public/CIN', $CINphotopath);
        }

        $pro = Pro::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'phoneNumber' => $request->phoneNumber,
            'CIN' => $request->CIN,
            'CIN_photo' => $CINphotopath,
            'email' => $request->email,
            'photo' => $photopath,
            'verified' => False,
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Your registration succesfully Done, A Admin will contact you in this next 24h.',
            'token' => $pro->createToken('Register API Token of ' . $request->lastName)->plainTextToken,
            'Pro' => $pro
        ], 200);
    }
    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();

        return response()->json([
            'status' => true,
            'message' => 'You have been succesfully logged out',
        ], 200);
    }


    public function updateProfile(Request $request)
    {
        $updatedPro = Pro::find($request->id);

        if ($request->has('photo')) {
            $photo = $request->file('photo');
            $photopath = 'Pro-' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('public/profile', $photopath);

            $updatedPro->update([
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'phoneNumber' => $request->phoneNumber,
                'photo' => $photopath,
            ]);
        } else {
            $updatedPro->update([
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'phoneNumber' => $request->phoneNumber,
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Your Account Info updated successfully',
            'updatedPro' => $updatedPro
        ], 200);
    }

    public function updatePassword(Request $request)
    {
        $updatedPro = Pro::find($request->id);
        $newPassword = $request->Newpassword;
        $oldPassword = $request->Oldpassword;

        // Compare old password with the one in database
        if (!Hash::check($oldPassword, $updatedPro->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Old password does not match the one in our records',
            ], 400);
        }

        // Update password
        $updatedPro->update([
            'password' => Hash::make($newPassword),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Your Password is updated successfully',
            'updatedPro' => $updatedPro,
        ], 200);
    }

    public function resetPassword(Request $request)
    {
    }
}
