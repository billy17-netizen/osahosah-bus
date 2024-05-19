<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminAuthController extends Controller
{
    public function index()
    {
        return view('admin.auth.login');
    }
}
