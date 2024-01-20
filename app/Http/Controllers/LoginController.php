<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class LoginController extends Controller
{
    public function showLoginForm($userType)
    {
        session(['selectedUserType' => $userType]);
        return view('login');
    }



    public function authenticate(Request $request)
{
    $userType = session('selectedUserType');

    // Validasi input
    $request->validate([
        'email' => 'required|email:dns',
        'password' => 'required',
    ]);

    // Validasi peran menggunakan Query Builder
    $validUser = \Illuminate\Support\Facades\DB::table('users')
    ->where('email', $request->email)
    ->where('role', $userType)
    ->first();


    if ($validUser && Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        $request->session()->regenerate();

        $user = Auth::user();

        switch ($userType) {
            case 'direktur':
                Alert::success('Berhasil Login', 'Selamat Datang Direktur');
                return redirect()->route('dashboard.direktur');
                break;

            case 'sekretaris':
                Alert::success('Berhasil Login', 'Selamat Datang Sekretaris');
                return redirect()->route('dashboard.sekretaris');
                break;

            case 'kurir':
                Alert::success('Berhasil Login', 'Selamat Datang Kurir');
                return redirect()->route('dashboard.kurir');
                break;

            default:
                return back()->with('loginError', 'Invalid role');
        }
    }

    return back()->with('loginError', 'Login Failed!');
}


    public function logout(Request $request){

        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect('/');

    }
}
