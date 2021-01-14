<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Home'
        ];
        return view('admin.admin_template', $data);
    }
}
