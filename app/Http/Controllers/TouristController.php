<?php

namespace App\Http\Controllers;

use App\Models\Tourist;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Storage;


class TouristController extends Controller
{

    use HttpResponses;

    public function login(Request $request)
    {
        // return $request;
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // return Auth::guard('Tourist');

        if (!Auth::guard('tourist')->attempt($request->only('email', 'password'))) {
            return $this->error('', 'email or password are incorrect', 401);
        }

        $tourist = Tourist::where('email', $request->email)->first();

        $username = $tourist->firstName . ' ' . $tourist->lastName;

        return $this->success([
            'Tourist' => $tourist,
            'token' => $tourist->createToken('Login API Token of ' . $username)->plainTextToken
        ]);
    }


    public function register(Request $request)
    {

        $validated = $request->validate([
            'email' => ['required', 'string', 'max:255', 'unique:admins,email'],
            'password' => ['required', 'min:8', Password::defaults()],
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'phoneNumber' => ['required', 'max:255'],
        ]);

        $Newphotopath = '';
        if ($request->has('photo')) {

            $Newphotopath = 'Admin-' . random_int(10000, 100000) . '.' .  $request->photo->getClientOriginalExtension();
            Storage::disk('public')->put('Profils/' . $Newphotopath, file_get_contents($request->photo));
        }

        $tourist = Tourist::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'phoneNumber' => $request->phoneNumber,
            'photo' => $Newphotopath,
        ]);

        $username = $tourist->firstName . ' ' . $tourist->lastName;

        return $this->success([
            'Tourist' => $tourist,
            'token' => $tourist->createToken('Register API Token of ' . $username)->plainTextToken
        ]);
    }
    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();

        return $this->success([
            'message' => 'You have succesfully been logged out'
        ]);
    }
}
