<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Storage;


class AdminController extends Controller
{

    use HttpResponses;

    public function login(Request $request)
    {
        // return $request;
        $validated = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:8'
        ]);
        
        // return Auth::guard('admin');
        if(Auth::guard('admin')->attempt($request->only('email','password'))) {
            return $this->error('', 'email or password are incorrect', 401);
        }

        $admin = Admin::where('email', $request->email)->first();

        return $this->success([
            'Admin' => $admin,
            'token' => $admin->createToken('API Token of ' . $admin->name)->plainTextToken
        ]);
    }


    public function register(Request $request)
    {

        $validated = $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'unique:admins,email'],
            'password' => ['required', 'min:8', Password::defaults()]
        ]);

        $Newphotopath = '';
        if ($request->has('photo')) {

            $Newphotopath = 'Admin-' . random_int(10000, 100000) . '.' .  $request->photo->getClientOriginalExtension();
            Storage::disk('public')->put('Profils/' . $Newphotopath, file_get_contents($request->photo));
        }

        $admin = Admin::create([
            'username' => $request->username,
            'email' => $request->email,
            'photo' => $Newphotopath,
            'password' => Hash::make($request->password)
        ]);

        return $this->success([
            'Admin' => $admin,
            'token' => $admin->createToken('API Token of ' . $admin->name)->plainTextToken
        ]);
    }
    public function logout()
    {
        Auth::Admin()->currentAccessToken()->delete();


        return $this->success([
            'message' =>  'you logged out'
        ]);
    }
}
