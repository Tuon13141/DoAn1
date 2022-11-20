<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/css/aboutQc_style.css">
    <link rel="stylesheet" href="/assets/css/headerAndFooter.css">
    <title>Document</title>
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
        <div class="box">
            <div class="small-box-1">
                <div class="title">
                    Thông tin người dùng
                </div>
                <div class="holder">
                    <div class="circle">        
                        <img src="{{ $user->hadAva == 'yes' ? '/img/ava/'.$user->username.'_'.'ava.jpg' : '/assets/img/ava5.jpg' }}" alt="{{ $user->username }}">
                    </div>
                    <div class="content">
                        - ID: {{ $user->id }}
                        <br>
                        - Username: {{ $user->username }}
                        <br>
                        - Tên: {{ $user->name }}
                        <br>
                        - Chức vụ: {{ $question->role }}
                        <br>
                        - Số ĐT: {{ $user->phone_number }}
                        <br>
                        - Email: {{ $user->email }}
                    </div>
                </div>                
            </div>          
        </div>
                    
        <div class="box">
            <div class="small-box-2">
                <div class="img-holder">
                    <img src="/img/room/{{ $room->host_username }}_{{ $room->motel_id }}_{{ $room->id }}_motel_img1.jpg" alt="">
                </div>
                <div class="img-holder">
                    <img src="/img/room/{{ $room->host_username }}_{{ $room->motel_id }}_{{ $room->id }}_motel_img2.jpg" alt="">
                </div>
                <div class="img-holder">
                    <img src="/img/room/{{ $room->host_username }}_{{ $room->motel_id }}_{{ $room->id }}_motel_img3.jpg" alt="">
                </div>                
            </div>    
            <div class="small-box-3">
                <div class="title">
                    Thông tin phòng trọ
                </div>
                <div class="holder">
                  
                    -ID của phòng: {{ $room->id }} <br>
                    -ID của nhà trọ chứa : {{ $room->motel_id }}
                    
                </div>
                @if($viewView != 'yes')
                <form action="{{ $confirm == 'no' ? route('sendAnswer', ['username' => $user->username, 'question_id' => $question->id]) 
                                : route('processConfirmQc', ['username' => $user->username, 'room_id' => $room->id, 'answer_id' => $question->id]) }}" method="post">
                    @csrf
                    <input type="submit" name="submit" value="Xác nhận">
                    <a href="{{ url()->previous() }}" class="back">Quay lại</a>
                </form>
                @else 
                <form action="{{ route('cancelQc', ['username' => $user->username, 'room_id' => $room->id, 'answer_id' => $question->id]) }}" method="post">
                    @csrf
                    <input type="submit" name="submit" value="Huỷ quảng cáo">
                    <a href="{{ url()->previous() }}" class="back">Quay lại</a>
                </form>
                @endif
            </div>   
        </div>
    </div>

    <div id="footer">
        
    </div>
</body>
</html>