<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Session;
use App\Models\Motel;
use App\Models\Room;
use App\Models\Question;
use Illuminate\Support\Facades\File; 

class HostController extends Controller
{
    public function processAddMotel(Request $request) {
        if($request->input('district') == '' || $request->input('address') == '' || $request->input('describe') == '') {
            return back();
        }

        $motel = new Motel([
            'host_username' => session('username'),
            'district' => $request->input('district'),
            'address' =>  ucwords($request->input('address')),
            'describe' => ucfirst($request->input('describe')),
            'number_of_room' => '0',
            'status' => 'unavailable',
            'qc' => 'no',
        ]);

        // $img1 = $request->file('img-1')->storeAs('img', session('username').'_'.$motel->id.'_'.'img1.jpg', 'local');
        // $img2 = $request->file('img-2')->storeAs('img', session('username').'_'.$motel->id.'_'.'img2.jpg', 'local');
        // $img3 = $request->file('img-3')->storeAs('img', session('username').'_'.$motel->id.'_'.'img3.jpg', 'local');
        
        if(!$request->hasFile('img-1') || !$request->hasFile('img-2') || !$request->hasFile('img-3'))
        {
            
            return back();
        }

       
        $motel->save();

        $request->file('img-1')->move('img/motel', session('username').'_'.$motel->id.'_'.'motel_img1.jpg');
        $request->file('img-2')->move('img/motel', session('username').'_'.$motel->id.'_'.'motel_img2.jpg');
        $request->file('img-3')->move('img/motel', session('username').'_'.$motel->id.'_'.'motel_img3.jpg');

        //$path = 'assets/img/';
        

        return redirect()->route('hostMotel');
    }

    public function showMotel(){
        $motels = DB::table('motel')->where('host_username', session('username'))->get();

        foreach($motels as $motel) {
            $number_of_room =  DB::table('room')->where('host_username', session('username'))->where('motel_id', $motel->id)->count();
            $update = DB::table('motel')->where('host_username', session('username'))->where('id', $motel->id)
            ->update(['number_of_room' => $number_of_room]);
        }

        $motels = DB::table('motel')->where('host_username', session('username'))->get();

        return view('hostMotel', ['motels' => $motels]);
    }

    public function processAboutMotel(Request $request, $motel_id) {
        $motel = DB::table('motel')->where('host_username', session('username'))->where('id', $motel_id)->first();
        $rooms = DB::table('room')->where('host_username', session('username'))->where('motel_id', $motel_id)->get();

        $status = 'unavailble';
        foreach($rooms as $room) {
            if($room->status == 'available') {
                $status = 'available';
                break;
            }
        }

        $number_of_room =  DB::table('room')->where('host_username', session('username'))->where('motel_id', $motel_id)->count();
        $update = DB::table('motel')->where('host_username', session('username'))->where('id', $motel_id)
        ->update(['number_of_room' => $number_of_room, 'status' => $status]);

        $motel = DB::table('motel')->where('host_username', session('username'))->where('id', $motel_id)->first();
        $rooms = DB::table('room')->where('host_username', session('username'))->where('motel_id', $motel_id)->get()->sortBy('number');

        return view('aboutMotel', ['motel' => $motel, 'rooms' => $rooms]);
    }

    public function processChangeAboutMotel(Request $request, $motel_id) {
        $motel = DB::table('motel')->where('host_username', session('username'))->where('id', $motel_id)->first();
        $number_of_room =  DB::table('room')->where('host_username', session('username'))->where('motel_id', $motel_id)->count();

        $district = $request->input('district') == '' ? $motel->district : $request->input('district');
        $address = $request->input('address') == '' ? $motel->address : ucwords($request->input('address'));
        $describe = $request->input('describe') == '' ? $motel->describe : ucfirst($request->input('describe'));

        $addressExists = DB::table('motel')->where('address', $request->input('address'))->exists();
        if ($addressExists){
            return back();
        }
        
        $update = DB::table('motel')->where('host_username', session('username'))->where('id', $motel_id)
        ->update(['district' => $district, 'address' => $address, 'describe' => $describe, 'number_of_room' => $number_of_room]);

        $motel = DB::table('motel')->where('host_username', session('username'))->where('id', $motel_id)->first();
        $rooms = DB::table('room')->where('host_username', session('username'))->where('motel_id', $motel_id)->get();

        return redirect()->route('aboutMotel', ['motel_id' => $motel_id]);
    }

    public function processDeleteMotel(Request $request, $motel_id) {
       
        $rooms = Room::where('host_username', session('username'))->where('motel_id', $motel_id);

        if($rooms->count() != 0)
        {
           $rooms->delete();
        }

        $motel = Motel::where('host_username', session('username'))->where('id', $motel_id)->first()->delete();


        $img1_path = public_path('img/motel/'.session('username').'_'.$motel_id.'_'.'motel_img1.jpg');
        $img2_path = public_path('img/motel/'.session('username').'_'.$motel_id.'_'.'motel_img2.jpg');
        $img3_path = public_path('img/motel/'.session('username').'_'.$motel_id.'_'.'motel_img3.jpg');

        File::delete($img1_path, $img2_path, $img3_path);

        return redirect()->route('hostMotel');
    }

    public function processChangePictureMotel(Request $request, $motel_id) {

        if($request->hasFile('img-1')) $request->file('img-1')->move('img/motel', session('username').'_'.$motel_id.'_'.'motel_img1.jpg'); 
        if($request->hasFile('img-2')) $request->file('img-2')->move('img/motel', session('username').'_'.$motel_id.'_'.'motel_img2.jpg');
        if($request->hasFile('img-3')) $request->file('img-3')->move('img/motel', session('username').'_'.$motel_id.'_'.'motel_img3.jpg');

        return back();
    }

    public function processAboutRoom(Request $request, $motel_id, $room_id)
    {
        $motel = Motel::where('host_username', session('username'))->where('id', $motel_id)->first();
        $room = Room::where('host_username', session('username'))->where('motel_id', $motel_id)->where('id', $room_id)->first();

        return view('aboutRoom', ['room' => $room, 'motel' => $motel]);
    }

    public function processChangeAboutRoom(Request $request, $motel_id, $room_id) {

        $room = Room::where('host_username', session('username'))->where('motel_id', $motel_id)->where('id', $room_id)->first(); 

        $status = $request->input('status') == '' ? $room->status : $request->input('status');
        $price = $request->input('price') == '' ? $room->price : $request->input('price');
        $area = $request->input('area') == '' ? $room->area : $request->input('area');
        $number = $request->input('number') == '' ? $room->number : $request->input('number');

        $update = DB::table('room')->where('host_username', session('username'))->where('motel_id', $motel_id)->where('id', $room_id)
                        ->update(['status' => $status, 'price' => $price, 'area' => $area, 'number' => $number]);

        $motel = Motel::where('host_username', session('username'))->where('id', $motel_id)->first();
        $room = Room::where('host_username', session('username'))->where('motel_id', $motel_id)->where('id', $room_id)->first();       
        
        return redirect()->route('aboutRoom', ['motel_id' => $motel->id, 'room_id' => $room->id]);
    }

    public function addRoom($motel_id) {
        $motel = Motel::where('host_username', session('username'))->where('id', $motel_id)->first();

        return view('addRoom', ['motel' => $motel]);
    }

    public function processAddRoom(Request $request, $motel_id) {

        $hadPrice = $request->input('price') == '' ;
        $hadArea = $request->input('area') == '';
        $hadNumber = $request->input('number') == '';

        if($hadArea || $hadPrice || $hadNumber) {
            return back();
        }

        if(!$request->hasFile('img-1') || !$request->hasFile('img-2') || !$request->hasFile('img-3'))
        {
            return back();
        }

        $room = new Room([
            'host_username' => session('username'),
            'motel_id' => $motel_id,
            'price' => $request->input('price'),
            'status' => 'available',
            'area' => $request->input('area'),
            'number' => $request->input('number'),
            'qc' => 'no',
        ]);

        $room->save();

        $request->file('img-1')->move('img/room', session('username').'_'.$motel_id.'_'.$room->id.'_'.'motel_img1.jpg');
        $request->file('img-2')->move('img/room', session('username').'_'.$motel_id.'_'.$room->id.'_'.'motel_img2.jpg');
        $request->file('img-3')->move('img/room', session('username').'_'.$motel_id.'_'.$room->id.'_'.'motel_img3.jpg');

        return redirect()->route('aboutMotel', ['motel_id' => $motel_id]);
    }

    public function processDeleteRoom($motel_id, $room_id) {
        $room = Room::where('host_username', session('username'))->where('motel_id', $motel_id)->where('id', $room_id)->first()->delete();  

        $img1_path = public_path('img/room/'.session('username').'_'.$motel_id.'_'.$room_id.'_'.'motel_img1.jpg');
        $img2_path = public_path('img/room/'.session('username').'_'.$motel_id.'_'.$room_id.'_'.'motel_img2.jpg');
        $img3_path = public_path('img/room/'.session('username').'_'.$motel_id.'_'.$room_id.'_'.'motel_img3.jpg');

        File::delete($img1_path, $img2_path, $img3_path);

        return redirect()->route('aboutMotel', ['motel_id' => $motel_id]);
    }

    public function processChangePictureRoom(Request $request, $motel_id, $room_id) {

        if($request->hasFile('img-1')) $request->file('img-1')->move('img/room', session('username').'_'.$motel_id.'_'.$room_id.'_'.'room_img1.jpg'); 
        if($request->hasFile('img-2')) $request->file('img-2')->move('img/room', session('username').'_'.$motel_id.'_'.$room_id.'_'.'room_img2.jpg');
        if($request->hasFile('img-3')) $request->file('img-3')->move('img/room', session('username').'_'.$motel_id.'_'.$room_id.'_'.'room_img3.jpg');

        return back();
    }

    public function qcRoom() {
        
        $help = new Question([
            'username' => session('username'),
            'email' => session('email'),
            'phone_number' => session('phone_number'),
            'question' => 'Yêu cầu quảng cáo',
            'type' => 'qc',
            'role' => session('role'),
        ]);

        $help->save();

        return back()->with('sendQc', 'Đã gửi yêu cầu');
    }
}
