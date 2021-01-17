<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{

    public function registerForm()
    {
        $data = [
            'title' => 'Register'
        ];
        return view('register', $data);
    }
    public function registerProcess(Request $request)
    {
        $rules = [
            'name' => ['required', 'filled'],
            'username' => ['required', 'filled', 'unique:users,username'],
            'email' => ['required', 'filled', 'unique:users,email'],
            'password' => ['required', 'filled', 'min:8', 'max:12', 'regex:/(?=.*[\w])(?=.*[\d]).{8,12}/', 'confirmed'],
        ];
        $message = [
            'password.regex' => "Password must contain letter and number"
        ];
        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        // register only for user

        try {
            $role_user = Role::where('name', 'user')->first();
            $data = [
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => $role_user->id
            ];
            $user = new User($data);
            $user->save();

            $response = [
                'success' => 'Success create account'
            ];
            return redirect()->back()->with($response)->withInput();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            $response = [
                'error' => 'Server Error 500'
            ];
            return redirect()->back()->with($response)->withInput();
        }
    }
}
