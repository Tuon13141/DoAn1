<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Session;
use App\Models\User;

class AuthController extends Controller
{
    public function processLogin (Request $request) {
        $roles = array('host', 'user', 'admin');
        foreach($roles as $role){
            if (Auth::guard($role)->attempt(['username' => $request->input('username'), 'password' => $request->input('password')])) {
                $request->session()->put('username', Auth::guard($role)->user()->username);
                $request->session()->put('role', $role);
                $name = DB::table($role)->where('username', $request->input('username'))->value('name');
                $request->session()->put('name', $name);
                $email = DB::table($role)->where('username', $request->input('username'))->value('email');
                $request->session()->put('email', $email);
                $phone_number = DB::table($role)->where('username', $request->input('username'))->value(('phone_number'));
                $request->session()->put('phone_number', $phone_number);
                $request->session()->put('password', Hash::make($request->input('password')));
                return redirect()->route('index'); 
            }
        }
        return back();
    }

    public function processRegister(Request $request){
        $tables = array('host', 'user', 'admin');
        foreach($tables as $table){
            $userExists = DB::table($table)->where('username', $request->input('username'))->exists();
            $emailExists = DB::table($table)->where('email', $request->input('email'))->exists();
            if ($userExists || $emailExists){
                return back();
            }
        }
        $user = new User([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password'=> Hash::make($request->input('password')),
            'name' => $request->input('name'),
            'phone_number' => null,
        ]);
        $user->save();
        $request->session()->put('username', $request->input('username'));
        $request->session()->put('role', 'user');
        $request->session()->put('name', $request->input('name'));
        $request->session()->put('email', $request->input('email'));
        $request->session()->put('phone_number', null);
        
        return redirect()->route('index');
    }

    public function logout(Request $request){
        $request->session()->flush();
        Auth::logout();
        return redirect()->route('index');
    }

    public function processAboutMe(Request $request) {
        $name = $request->input('name') == '' ? session('name') : $request->input('name');
        $email = $request->input('email') == '' ? session('email') : $request->input('email');
        $phone_number = $request->input('phone_number') == '' ? session('phone_number') : $request->input('phone_number');
        $password = $request->input('password') == '' ? session('password') : Hash::make($request->input('password'));

        if(Hash::make($request->input('email')) != session('email')){
            $tables = array('host', 'user', 'admin');
            foreach($tables as $table){
                $emailExists = DB::table($table)->where('email', $request->input('email'))->exists();
                if ($emailExists){
                    return back();
                }
            }
        }

        $update = DB::table(session('role'))->where('username', session('username'))
        ->update(['name' => $name, 'email' => $email, 'phone_number' => $phone_number, 'password' => $password]);

        $request->session()->put('name', $name);
        $request->session()->put('email', $email);
        $request->session()->put('phone_number', $phone_number);
        $request->session()->put('password', $password);
        return redirect()->route('myPage');
    }
}
