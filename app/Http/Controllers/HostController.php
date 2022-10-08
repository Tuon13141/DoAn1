<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Session;
use App\Models\Motel;

class HostController extends Controller
{
    public function processAddMotel(Request $request) {
        $motel = new Motel([
            'host_username' => session('username'),
            'district' => $request->input('district'),
            'address' => $request->input('address'),
            'describe' => $request->input('describe'),
            'number_of_room' => 0,
            'status' => 'unavailable',
        ]);

        $motel->save();

        return redirect()->route('hostMotel');
    }

    public function showMotel(){
        $motels = DB::table('motel')->where('host_username', session('username'))->get();
        return view('hostMotel', ['motels' => $motels]);
    }

    public function processAboutMotel(Request $request, $id) {
        $motels = DB::table('motel')->where('host_username', session('username'))->where('id', $id)->get();
        return view('aboutMotel', ['motels' => $motels]);
    }
}
