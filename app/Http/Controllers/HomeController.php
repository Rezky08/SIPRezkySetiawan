<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Home'
        ];
        $user = Auth::user();
        if ($user->role->name == "admin") {
            return view('admin.admin_template', $data);
        } else {
            return view('user.user_template', $data);
        }
    }
}
