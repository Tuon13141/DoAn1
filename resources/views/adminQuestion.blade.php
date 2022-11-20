<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/css/headerAndFooter.css">
    <link rel="stylesheet" href="/assets/css/adminQuestion_style.css">
    <title>Danh sách câu hỏi của người dùng</title>
</head>
<body>
    <div id="header">
        <img class="logo" src="/assets/img/logo1.jpg" alt="a">
        <ul class="sub">
            <a class="login {{ session()->has('role') ? 'close' : '' }}" href="{{ route('login') }}">Đăng nhập</a>
            <a class="me {{ session()->has('role') ? '' : 'close' }}" href="{{ route('myPage') }}">Tôi</a>
            <li class="child-sub {{ session()->has('role') ? '' : 'close' }}">
                <a href="{{ route('myPage') }}">Trang cá nhân</a>
            </li>
            <li class="child-sub {{ session()->has('role') ? '' : 'close' }}">
                <?php 
                    use Illuminate\Support\Facades\DB;
                    use Illuminate\Database\Query\Builder;
                    $note = DB::table('answer')->where('username', session('username'))->where('hadSeen', 'no')->count();
                ?>              
                <a href="{{ route('notification') }}">Thông báo</a>
                {{ $note > 0 ? '*' : '' }}
            </li>
            <li class="child-sub {{ session()->has('role') ? '' : 'close' }}">
                <a href="{{ route('logout') }}">Đăng xuất</a>
            </li>

        </ul>
        <ul class="head-bar">
            <li>
                <a href="{{ route('help') }}">Hỏi đáp</a>
            </li>
            <li>
                <a href="{{ route('page1') }}">Thuê trọ</a>
            </li>
            <li>
                <a href="{{ route('index') }}">Trang chủ</a>
            </li>
        </ul>
    </div>

    <div id="body">
        <div class="big-box">
            <div class="small-box">
                <h1>Danh sách đơn {{ $type == 'complain' ? 'khiếu nại của người dùng' : ''}} {{ $type == 'bug' ? 'báo lỗi của người dùng' : '' }}
                    {{ $type == 'support' ? 'yêu cầu hỗ trợ của người dùng' : '' }} {{ $type == 'answered' ? 'đã phản hồi' : '' }} {{  $type == 'qc' ? 'đợi xác minh quảng cáo' : '' }}</h1>
            </div>
            <div class="show-question">
                <div class="row">
                    <ul>
                        <li class="stt">STT</li>
                        <li class="username">Username</li>
                        <li class="role">Chức vụ</li>
                        <li class="created_at">{{ $type == 'answered' ? 'Ngày phản hồi' : 'Ngày hỏi' }}</li>
                    </ul>
                </div>
                    
                <?php $stt = 1 ?>
                @foreach ($questions as $question)
                <div class="row">
                    <ul>
                        <div class="question-holder">
                            @if ($type == 'qc')
                            <a href="{{ route('confirmQc', ['answer_id' => $question->id]) }}">
                                <li class="stt"><?php echo $stt ?></li>
                                <li class="username">{{ $question->username }}</li>
                                <li class="role">{{ $question->role }}</li>
                                <li class="created_at">{{ $question->created_at }}</li>
                            </a>
    
                            @else
                                @if ($type == 'qc_confirm')
                                <a href="{{route('aboutQcRoom', ['answer_id' => $question->id])}}">
                                    <li class="stt"><?php echo $stt ?></li>
                                    <li class="username">{{ $question->username }}</li>
                                    <li class="role">{{ $question->role }}</li>
                                    <li class="created_at">{{ $question->created_at }}</li>
                                </a>
                                @else
                                <a href="{{ $type != 'answered' && $type != 'qc_confirm' ? route('aboutQuestion', ['question_id' => $question->id]) : route('aboutAnswer', ['answer_id' => $question->id])}}">
                                    <li class="stt"><?php echo $stt ?></li>
                                    <li class="username">{{ $question->username }}</li>
                                    <li class="role">{{ $question->role }}</li>
                                    <li class="created_at">{{ $question->created_at }}</li>
                                </a>
                                @endif                 
                            @endif
                        </div>                
                    </ul>
                    <?php $stt++ ?> 
                </div>
                   
                @endforeach   
              
                <div class="clear"></div>   
                
               
            </div>
            <div class="small-box">
                <a href="{{ route('myPage') }}" class="add">
                    Quay lại
                </a>
            </div>
            
        </div>
    </div>
</body>
</html>