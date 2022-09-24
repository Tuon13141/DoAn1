<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function processLogin (Request $request) {
        $roles = array('host', 'user');
        foreach($roles as $role){
            if (Auth::guard($role)->attempt(['username' => $request->input('username'), 'password' => $request->input('password')])) {
                $request->session()->put('username', Auth::guard($role)->user()->username);
                $request->session()->put('role', $role);
                return redirect()->route('index'); 
            }
        }
        return back();
    }
}
