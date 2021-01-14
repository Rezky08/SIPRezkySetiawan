<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function loginForm()
    {
        $data = [
            'title' => 'Login'
        ];
        return view('login', $data);
    }
    public function loginProcess(Request $request)
    {
        $rules = [
            'username' => ['required', 'filled'],
            'password' => ['required', 'filled']
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        $status = Auth::attempt(['username' => $request->username, 'password' => $request->password]);

        // redirect back if false
        if (!$status) {
            $errors = [
                'username' => 'username or password invalid'
            ];
            return redirect()->back()->withErrors($errors)->withInput();
        }

        $user = Auth::user();
        $role = $user->role;

        // redirect after login by role name
        switch (strtolower($role->name)) {
            case 'admin':
                return redirect(RouteServiceProvider::ADMIN_HOME);
                break;
            case 'user':
                return redirect(RouteServiceProvider::USER_HOME);
                break;

            default:
                return redirect(RouteServiceProvider::HOME);
                break;
        }
    }
    public function logout()
    {
        $user = Auth::user();
        Auth::logout($user);
        return redirect('/login');
    }
}
