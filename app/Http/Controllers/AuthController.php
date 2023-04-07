<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function login()
    {
        return view('login');
    }

    function doLogin(Request $request)
    {
        // cek validasi
        $validasi = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8']
        ]);

        if (Auth::attempt($validasi)) {
            return redirect('');
        } else {
            return redirect()->back()->withErrors([
                'authGagal' => 'Email atau password tidak dapat kami temukan'
            ]);
        }
    }

    function register()
    {
        return view('register');
    }

    function doRegister(Request $request)
    {
        $validasi = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8'],
            'password2' => ['required', 'same:password']
        ]);

        $name = $request['name'];
        $email = $request['email'];
        $password = $request['password'];

        $dataRegister = [
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password)
        ];

        $storeUser = User::create($dataRegister);

        if ($storeUser) {
            return redirect('/login')->with('berhasilRegister', 'Anda sudah berhasil register. sekarang silahkan login');
        } else {
            return redirect()->back()->withErrors([
                'registerError' => 'Gagal register, silahkan coba lagi'
            ]);
        }
    }

    function logout()
    {
        $logout = Auth::logout();

        if ($logout) {
            return redirect('login');
        } else {
            return redirect()->back()->withErrors(['logoutError' => 'Gagal logout']);
        }
    }
}
