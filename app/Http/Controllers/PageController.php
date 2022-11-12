<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Session;
use App\Models\Motel;
use App\Models\Question;
use App\Models\Room;
use Illuminate\Support\Facades\File;
use PHPUnit\Framework\Constraint\IsType;

use function PHPSTORM_META\type;

class PageController extends Controller
{
    public function randomViewController() {       
        $room_qc = DB::table('room')->where('qc', 'yes')->inRandomOrder()->limit(10)->get();
        $room =  DB::table('room')->inRandomOrder()->get(); 

        return view('buyPage_2', ['room_qc' => $room_qc, 'room' => $room, 'district_input' => 'all', 'area_input' => 'all', 'price_input' => 'all',
                    'status_input' => 'all', 'timeline_input' => 'all']);
    }

    public function viewRoom($motel_id, $room_id, $host_username) {
        $room = DB::table('room')->where('host_username', $host_username)->where('motel_id', $motel_id)->where('id', $room_id)->first();
        $host = DB::table('host')->where('username', $host_username)->first();
        $motel = DB::table('motel')->where('host_username', $host_username)->where('id', $motel_id)->first();

        return view('viewRoom', ['room' => $room, 'host' => $host, 'motel' => $motel]);
    }

    public function viewPageController(Request $request) {
        $district_input = $request->input('district');
        $price_input = $request->input('price');
        $area_input = $request->input('area');
        $status_input = $request->input('status');
        $timeline_input = $request->input('timeline');

        if($district_input == 'all' && $price_input == 'all' && $area_input == 'all' && $status_input == 'all' && $timeline_input == 'all')
        {
            return redirect()->route('page2_randomView');
        }

        $area_from = 0;
        $area_to = 0;

        if($area_input == '0<x<=20') {
            $area_from = 0;
            $area_to = 20; 
        }   
        else if ($area_input == '20<x<=30'){
            $area_from = 21;
            $area_to = 30;
        }
        else if ($area_input == '30<x<=40'){
            $area_from = 31;
            $area_to = 40;
        }
        else if ($area_input == '40<x<=50'){
            $area_from = 41;
            $area_to = 50;
        }
        else if ($area_input == 'x>51'){
            $area_from = 51;
            $area_to = 999999;
        }
        else if($area_input == 'all') {
            $area_from = 0;
            $area_to = 999999;
        }

        $price_from = 0;
        $price_to = 0;

        if($price_input == 'x<=1') {
            $price_from = 0;
            $price_to = 1000000;
        }
        else if($price_input == '1<x<=2') {
            $price_from = 1000001;
            $price_to = 2000000;
        }
        else if($price_input == '2<x<=3') {
            $price_from = 2000001;
            $price_to = 3000000;
        }
        else if($price_input == '3<x<=4') {
            $price_from = 3000001;
            $price_to = 4000000;
        }
        else if($price_input == '4<x<=5') {
            $price_from = 4000001;
            $price_to = 5000000;
        }
        else if($price_input == 'x>5') {
            $price_from = 5000001;
            $price_to = 999999999;
        }
        else if($price_input == 'all') {
            $price_from = 0;
            $price_to = 999999999;
        }
        
        $room = DB::table('room')->whereBetween('price', [$price_from, $price_to])->whereBetween('area', [$area_from, $area_to])->get();

        if($district_input != 'all') {
            $stt = 0;
            foreach($room as $child) {
                $motel = DB::table('motel')->where('host_username', $child->host_username)->where('id', $child->motel_id)->first();
                if($motel->district != $district_input) {
                    unset($room[$stt]);
                }
                $stt++;
            }
        }
        
        if($status_input != 'all') {    
            $stt = 0;
            foreach($room as $child) {
                if($child->status != $status_input) {
                    unset($room[$stt]);
                }
                $stt++;
            }        
        }

        if($timeline_input != 'all')
        {
            if($timeline_input == 'new') {
                $room->sort();
            }
            else if($timeline_input == 'old') {
                $room->sortDesc();
            }
        }

        $room_qc = $room->where('qc', 'yes');
     
        return view('buyPage_2', ['room_qc' => $room_qc, 'room' => $room, 'district_input' => $district_input, 'area_input' => $area_input, 'price_input' => $price_input,
                                  'status_input' => $status_input, 'timeline_input' => $timeline_input]);
    }

    public function helpController(Request $request) {
        $type = $request->input('type');
        $question = $request->input('question');

        if($question == '') {
            return back();
        }

        $help = new Question([
            'username' => session('username'),
            'email' => session('email'),
            'phone_number' => session('phone_number'),
            'question' => $question,
            'type' => $type
        ]);

        $help->save();

       

        return back();
    }
}
