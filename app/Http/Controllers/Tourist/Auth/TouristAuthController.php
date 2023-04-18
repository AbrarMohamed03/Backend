<?php

namespace App\Http\Controllers\Tourist\Auth;

use App\Http\Controllers\Controller;
use App\Models\Tourist;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class TouristAuthController extends Controller
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

        if (!Auth::guard('tourist')->attempt($request->only('email', 'password'))) {
            return response()->json([
                'status' => False,
                'message' => 'Email or Password are incorrect',
            ], 401);
        }

        $tourist = Tourist::where('email', $request->email)->first();

        return response()->json([
            'status' => true,
            'message' => 'You loged in successfully',
            'token' => $tourist->createToken('Login API Token of ' . $tourist->lastName)->plainTextToken,
            'tourist' => $tourist
        ], 200);
    }


    public function register(Request $request)
    {
        // return $request;
        $validated = $request->validate([
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'phoneNumber' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'unique:tourists,email'],
            'password' => ['required', 'min:8']
        ]);

        $photopath = '';
        if ($request->has('photo')) {

            $photo = $request->file('photo');
            $photopath = 'Tour-' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('public/profile', $photopath);
        }

        $tourist = Tourist::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'phoneNumber' => $request->phoneNumber,
            'email' => $request->email,
            'photo' => $photopath,
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Your registration succesfully Done, A Admin will contact you in this next 24h.',
            'token' => $tourist->createToken('Register API Token of ' . $request->lastName)->plainTextToken,
            'tourist' => $tourist
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
        $updatedtourist = Tourist::find($request->id);

        if ($request->has('photo')) {
            $photo = $request->file('photo');
            $photopath = 'Tour-' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('public/profile', $photopath);

            $updatedtourist->update([
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'phoneNumber' => $request->phoneNumber,
                'photo' => $photopath,
            ]);
        } else {
            $updatedtourist->update([
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'phoneNumber' => $request->phoneNumber,
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Your Account Info updated successfully',
            'updatedtourist' => $updatedtourist
        ], 200);
    }

    public function updatePassword(Request $request)
    {
        $updatedtourist = Tourist::find($request->id);
        $newPassword = $request->Newpassword;
        $oldPassword = $request->Oldpassword;

        // Compare old password with the one in database
        if (!Hash::check($oldPassword, $updatedtourist->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Old password does not match the one in our records',
            ], 400);
        }

        // Update password
        $updatedtourist->update([
            'password' => Hash::make($newPassword),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Your Password is updated successfully',
            'updatedtourist' => $updatedtourist,
        ], 200);
    }

    public function resetPassword(Request $request)
    {
    }
}
