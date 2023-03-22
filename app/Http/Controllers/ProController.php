<?php

namespace App\Http\Controllers;

use App\Models\Pro;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Storage;
class ProController extends Controller
{

    use HttpResponses;

    public function login(Request $request)
    {
        // return $request;
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        // return Auth::guard('pro');
        
    if(!Auth::guard('pro')->attempt($request->only('email','password'))) {
        return $this->error('', 'email or password are incorrect', 401);
    }

    $pro = Pro::where('email', $request->email)->first();

    $username = $pro->firstName . ' ' . $pro->lastName;

        return $this->success([
            'Tourist' => $pro,
            'token' => $pro->createToken('Login API Token of ' . $username)->plainTextToken
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
            'CIN' => ['required', 'string', 'max:255'],
        ]);

        $Newphotopath = '';
        if ($request->has('photo')) {

            $Newphotopath = 'Pro-' . random_int(10000, 100000) . '.' .  $request->photo->getClientOriginalExtension();
            Storage::disk('public')->put('Profils/' . $Newphotopath, file_get_contents($request->photo));
        }

        $pro = Pro::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'phoneNumber' => $request->phoneNumber,
            'CIN' => $request->CIN,
            'photo' => $Newphotopath,
        ]);

        $username = $pro->firstName . ' ' . $pro->lastName;

        return $this->success([
            'Tourist' => $pro,
            'token' => $pro->createToken('Register API Token of ' . $username)->plainTextToken
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
