<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginForm($userType)
    {
        session(['selectedUserType' => $userType]);
        return view('login');
    }
}
