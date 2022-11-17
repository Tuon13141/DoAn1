<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/css/headerAndFooter.css">
    <link rel="stylesheet" href="/assets/css/myPage_style.css">
    
    <title>My Page</title>
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
                <div class="circle">        
                    <img src="{{ session('hadAva') == 'yes' ? '/img/ava/'.session('username').'_'.'ava.jpg' : '/assets/img/ava5.jpg' }}" alt="">
                </div>
                <div class="content">
                    Họ tên: {{ session('name') }}   <br>
                    Tài khoản: {{ session('role') }}
                </div>
                
            </div>
            <div class="small-box-2">
                <div class="content">
                    Số điện thoại: {{ session('phone_number') == '0' ? '' : session('phone_number') }} <br>
                    Email: {{ session('email') }} <br>                 
                </div>  
                <a href="{{ route('aboutMe') }}" class="change">Chỉnh sửa</a>
                <a href="{{ route('logout') }}" class="log-out">Đăng xuất</a>                 
            </div>
            
        </div>
        <div class="box">
            <div class="small-box-3 {{ session('role') != 'user' ? 'pd3' : '' }}">
                <div class="host {{ session('role') == 'host' ? '' : 'close' }}">
                    <div class="host-content">
                        <div class="title">
                            <?php 
                                $number_of_motel = DB::table('motel')->where('host_username', session('username'))->count();
                                $number_of_room = DB::table('room')->where('host_username', session('username'))->count();
                                $number_of_room_status = DB::table('room')->where('host_username', session('username'))->where('status', 'available')->count();
                                $number_of_room_qc = DB::table('room')->where('host_username', session('username'))->where('qc', 'yes')->count();
                            ?>
                            <h1 style="text-align: center">
                                ====Quản lí nhà trọ====
                            </h1> <br> <br> <br> <br> <br>
                                - Số nhà trọ đang quản lí: {{ $number_of_motel }} <br> <br>
                                - Số phòng trọ đang quản lí: {{ $number_of_room }} <br> <br>
                                - Số phòng trọ đã được thuê: {{ $number_of_room_status }}<br> <br>
                                - Số phòng trọ đang được quảng cáo: {{ $number_of_room_qc }}<br>
                        </div>  
                        <a href="{{ route('hostMotel') }}">Chi tiết</a>
                    </div>
                </div>
                <div class="user {{ session('role') == 'user' ? '' : 'close' }}">
                    <?php 
                        $room = DB::table('room')->where('qc', 'yes')->where('status', 'available')->get();
                        $number_of_room = DB::table('room')->where('qc', 'yes')->where('status', 'available')->count();
                        
                        if($number_of_room > 0) {
                            $room_qc = $room[rand(0, $number_of_room - 1)];
                        }
                        
                    ?>
                    <div class="title">
                        Gợi ý cho bạn: 
                    </div>
                    
                    @if($number_of_room > 0)
                    <a href="{{ route('viewRoom', ['motel_id' => $room_qc->motel_id, 'room_id' => $room_qc->id, 'host_username'=> $room_qc->host_username]) }}">
                        <img src="/img/room/{{ $room_qc->host_username }}_{{ $room_qc->motel_id }}_{{ $room_qc->id }}_motel_img1.jpg" alt="">
                    </a>
                    
                    @else
                        <img src="/assets/img/tro1.jpg" alt="">
                    @endif
                    
                </div>
                <div class="admin {{ session('role') == 'admin' ? '' : 'close' }}">
                    <div class="title">
                        <?php 
                            $complain = DB::table('question')->where('type', 'complain')->count();
                            $support = DB::table('question')->where('type', 'support')->count();
                            $bug = DB::table('question')->where('type', 'bug')->count();
                            $answer = DB::table('answer')->count();
                        ?>
                        <h1 style="text-align: center">
                           ======Thông báo======
                        </h1> <br> <br> <br> <br> <br>
                            - Phòng trọ xin cấp quảng cáo : 3 <a href="">Chi tiết</a>
                            <br> <br> <br>
                            - Đơn khiếu nại : {{ $complain }} <a href="{{ route('adminQuestion', ['type' => 'complain']) }}">Chi tiết</a>
                            <br> <br> <br>
                            - Yêu cầu hỗ trợ : {{ $support }} <a href="{{ route('adminQuestion', ['type' => 'support']) }}">Chi tiết</a>
                            <br> <br> <br>
                            - Báo lỗi : {{ $bug }} <a href="{{ route('adminQuestion', ['type' => 'bug']) }}">Chi tiết</a>
                            <br> <br> <br>
                            - Đơn đã được phản hồi : {{ $answer }} <a href="{{ route('adminQuestion', ['type' => 'answered']) }}">Chi tiết</a>
                    </div>  
                </div>
            </div>
        </div>
    </div>

    <div id="footer">
        
        
    </div>
</body>
</html>