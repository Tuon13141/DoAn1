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
        if($type == 'answered') {
            $questions = DB::table('answer')->get();
        }
        else
            $questions = DB::table('question')->where('type', $type)->get();

        return view('adminQuestion', ['questions' => $questions, 'type' => $type]);
    }

    public function aboutQuestion($question_id) {
        $question = DB::table('question')->where('id', $question_id)->first();
        $user = DB::table($question->role)->where('username', $question->username)->first();

        return view('aboutQuestion', ['question' => $question, 'user' => $user]);
    }

    public function aboutAnswer($answer_id) {
        $question = DB::table('answer')->where('id', $answer_id)->first();
        $user = DB::table($question->role)->where('username', $question->username)->first();

        return view('aboutAnswer', ['question' => $question, 'user' => $user]);
    }

    public function sendAnswer(Request $request, $username, $question_id) {
        $question = DB::table('question')->where('id', $question_id)->first();
 
        $answer = new Answer([
            'username' => $username,
            'question' => $question->question,
            'answer' => $request->input('answer'),
            'type' => $question->type,
            'hadSeen' => 'no',
            'day_ask' => $question->created_at,
            'role' => $question->role,
        ]);
        $answer->save();

        $type = $question->type;
        DB::table('question')->where('id', $question_id)->delete();

        $questions = DB::table('question')->where('type', $type)->get();

        return view('adminQuestion', ['questions' => $questions, 'type' => $type]);
    }
}
