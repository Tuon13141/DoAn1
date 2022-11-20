<?php

namespace App\Http\Controllers;

use App\Models\Answer;
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
        if($type == 'need_qc') {
            $questions = DB::table('question')->where('type', 'qc')->get();
        }
        else {
            if($type == 'answered') {
                $questions = DB::table('answer')->orderByDesc('id')->get();
                $stt = 0;
                foreach($questions as $child) {
                    $answer = DB::table('answer')->where('username', $child->username)->where('id', $child->id)->first();
                    if($answer->type == 'qc') {
                        unset($questions[$stt]);
                    }
                    $stt++;
                }
            }
            else {
                if($type == 'qc') {
                    $questions = DB::table('answer')->where('type', 'qc')->get();
                }
                else {
                    if($type == 'qc_confirm'){
                        $questions = DB::table('answer')->where('type', 'qc_confirment')->get();
                    }
                    else
                        $questions = DB::table('question')->where('type', $type)->get();
                }
                    
            }
        }
        
        return view('adminQuestion', ['questions' => $questions, 'type' => $type]);
    }

    public function aboutQuestion($question_id) {
        $question = DB::table('question')->where('id', $question_id)->first();

        $user = DB::table($question->role)->where('username', $question->username)->first();

        
        if($question->type == 'qc') {    
            $room = DB::table('room')->where('host_username', $question->username)->where('id', $question->question)->first();   

            return view('aboutQc', ['room' => $room, 'user' => $user, 'question' => $question, 'confirm' => 'no', 'viewView' => 'no']);
        }

        return view('aboutQuestion', ['question' => $question, 'user' => $user]);
    }

    public function aboutAnswer($answer_id) {
        $question = DB::table('answer')->where('id', $answer_id)->first();
        $user = DB::table($question->role)->where('username', $question->username)->first();

        return view('aboutAnswer', ['question' => $question, 'user' => $user]);
    }

    public function aboutQcRoom($answer_id) {
        $question = DB::table('answer')->where('id', $answer_id)->first();
        $user = DB::table('host')->where('username', $question->username)->first();
        $room = DB::table('room')->where('host_username', $question->username)->where('id', $question->question)->first();   

        return view('aboutQc', ['room' => $room, 'user' => $user, 'question' => $question, 'confirm' => 'yes', 'viewView' => 'yes']);
    }

    public function cancelQc($username, $room_id, $answer_id) {
        $room_update = DB::table('room')->where('host_username', $username)->where('id', $room_id)->update(['qc' => 'no']);   
        $question_update = DB::table('answer')->where('id', $answer_id)->update(['type' => 'qc_cancel']);
        $question = DB::table('answer')->where('id', $answer_id)->first();

        $answer = new Answer([
            'username' => $username,
            'question' => $question->question,
            'answer' => 'Phòng trọ đã được tắt quảng cáo',
            'type' => 'qc_cancel',
            'hadSeen' => 'no',
            'day_ask' => $question->created_at,
            'role' => $question->role,
        ]);
        $answer->save();

        $questions = DB::table('answer')->where('type', 'qc_confirm')->get();

        return redirect()->route('adminQuestion', ['questions' => $questions, 'type' => 'qc_confirm']);
    }

    public function sendAnswer(Request $request, $username, $question_id) {
        $question = DB::table('question')->where('id', $question_id)->first();

        if($question->type == 'qc') {
            $question_answer = 'Chúng tôi sẽ sớm liên lạc qua mail để tạo đơn thanh toán. Vui lòng chuyển tiền theo đúng hướng dẫn với số tiền và tài khoản nhận. Sau khi đã xác nhận chúng tôi sẽ quảng cáo phòng trọ này theo thời hạn bạn yêu cầu';  
        }
        else {
            $question_answer = $request->input('answer');
        }

        $answer = new Answer([
            'username' => $username,
            'question' => $question->question,
            'answer' => $question_answer,
            'type' => $question->type,
            'hadSeen' => 'no',
            'day_ask' => $question->created_at,
            'role' => $question->role,
        ]);
        $answer->save();

        $type = $question->type;    
        DB::table('question')->where('id', $question_id)->delete();

        $questions = DB::table('question')->where('type', $type)->get();

        if($type == 'qc') {
            return redirect()->route('adminQuestion', ['questions' => $questions, 'type' => 'need_qc']);
        }
        return redirect()->route('adminQuestion', ['questions' => $questions, 'type' => $type]);
    }

    public function confirmQc($answer_id) {
        $question = DB::table('answer')->where('id', $answer_id)->first();
        $user = DB::table($question->role)->where('username', $question->username)->first();
        $room = DB::table('room')->where('host_username', $question->username)->where('id', $question->question)->first();   

        return view('aboutQc', ['room' => $room, 'user' => $user, 'question' => $question, 'confirm' => 'yes', 'viewView' => 'no']);

    }

    public function processConfirmQc($username, $room_id, $answer_id) {
        $room_update = DB::table('room')->where('host_username', $username)->where('id', $room_id)->update(['qc' => 'yes']);   
        $question_update = DB::table('answer')->where('id', $answer_id)->update(['type' => 'qc_confirmed']);
        $question = DB::table('answer')->where('id', $answer_id)->first();

        $answer = new Answer([
            'username' => $username,
            'question' => $question->question,
            'answer' => 'Phòng trọ đã được bật quảng cáo',
            'type' => 'qc_confirment',
            'hadSeen' => 'no',
            'day_ask' => $question->created_at,
            'role' => $question->role,
        ]);
        $answer->save();

        $questions = DB::table('answer')->where('type', 'qc')->get();

        return redirect()->route('adminQuestion', ['questions' => $questions, 'type' => 'qc']);

    }
}
