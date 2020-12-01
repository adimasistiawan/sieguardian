<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Hash;


class UsersController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt(['username' => $request->username, 'password' =>$request->password])){
            return redirect()->route('dashboard.index');
        }else{
            return redirect()->back()->with('message','Username atau Password salah');
        }
    }
    public function logout()
    {
        
        Auth::logout();
        return redirect('/');
    }
}
