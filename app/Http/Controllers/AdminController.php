<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Session;
use App\Models\Motel;
use App\Models\Room;
use Illuminate\Support\Facades\File; 

class AdminController extends Controller
{
    public function showQuestion($type) {
        $questions = DB::table('question')->where('hadAnwser', 'no')->where('type', $type)->get();

        return view('adminQuestion', ['questions' => $questions]);
    }
}
