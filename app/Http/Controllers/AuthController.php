<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Session;
use App\Models\User;
use App\Models\Host;

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
                $hadAva =  DB::table($role)->where('username', $request->input('username'))->value('hadAva');
                $request->session()->put('hadAva', $hadAva);
                return redirect()->route('index'); 
            }
        }
        return back();
    }

    public function processRegister(Request $request){
        $tables = array('host', 'user', 'admin');

        if($request->input('username') == '' || $request->input('password') == '' || $request->input('email') == '' || $request->input('name') == '') {
            return back();
        }

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
            'hadAva' => 'no',
        ]);
        $user->save();
        $request->session()->put('username', $request->input('username'));
        $request->session()->put('role', 'user');
        $request->session()->put('name', $request->input('name'));
        $request->session()->put('email', $request->input('email'));
        $request->session()->put('phone_number', null);
        $request->session()->put('hadAva', 'no');
        
        return redirect()->route('index');
    }

    public function processHostRegister(Request $request){
        if($request->input('username') == '' || $request->input('password') == '' || $request->input('email') == '' || $request->input('name') == '' || $request->input('phone_number')) {
            return back();
        }

        $tables = array('host', 'user', 'admin');
        foreach($tables as $table){
            $userExists = DB::table($table)->where('username', $request->input('username'))->exists();
            $emailExists = DB::table($table)->where('email', $request->input('email'))->exists();
            $phone_numberExists = DB::table($table)->where('phone_number', $request->input('phone_number'))->exists();
            if ($userExists || $emailExists || $phone_numberExists){
                return back();
            }
        }
        $host = new Host([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password'=> Hash::make($request->input('password')),
            'name' => $request->input('name'),
            'phone_number' => $request->input('phone_number'),
            'hadAva' => 'no',
        ]);
        $host->save();
        $request->session()->put('username', $request->input('username'));
        $request->session()->put('role', 'host');
        $request->session()->put('name', $request->input('name'));
        $request->session()->put('email', $request->input('email'));
        $request->session()->put('phone_number', null);
        $request->session()->put('hadAva', 'no');
        
        return redirect()->route('index');
    }

    public function logout(Request $request){
        $request->session()->flush();
        Auth::logout();
        return redirect()->route('index');
    }

    public function processChangeAboutMe(Request $request) {
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

        $hadAva = DB::table(session('role'))->where('username', session('username'))->value('hadAva');
       
        if($request->hasFile('ava')) {
            $request->file('ava')->move('img/ava', session('username').'_'.'ava.jpg');
            $hadAva = 'yes';
        }

        $update = DB::table(session('role'))->where('username', session('username'))
        ->update(['name' => $name, 'email' => $email, 'phone_number' => $phone_number, 'password' => $password, 'hadAva' => $hadAva]);

        $request->session()->put('name', $name);
        $request->session()->put('email', $email);
        $request->session()->put('phone_number', $phone_number);
        $request->session()->put('password', $password);
        $request->session()->put('hadAva', $hadAva);
        return redirect()->route('myPage');
    }
}
