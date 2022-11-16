<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/css/buyPage_1_style.css">
    <link rel="stylesheet" href="/assets/css/headerAndFooter.css">
    <title>Thuê Nhà Trọ Xịn</title>
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

    <?php 
        $room_qc = DB::table('room')->where('qc', 'yes')->where('status', 'available')->inRandomOrder()->limit(5)->get();
        $stt = 0;
    ?>

    <div id="body">
        <div class="container1">
            <p style="font-size: 30px; color: rgb(51, 51, 51); padding-left: 470px; padding-bottom: 30px; font-weight: 600;">Gợi ý cho bạn:</p>
            <p id="preBtn1"><</p>
            <p id="nextBtn1">></p> 
            <div class="slider1">
                <div class="box1" id="lastClone1">
                    <img src="/img/room/{{ $room_qc[$room_qc->count() - 1]->host_username }}_{{ $room_qc[$room_qc->count() - 1]->motel_id }}_{{ $room_qc[$room_qc->count() - 1]->id }}_motel_img1.jpg" alt="">
                </div>
                @while ($stt < $room_qc->count()) 
                    <div class="box1">
                        <img src="/img/room/{{ $room_qc[$stt]->host_username }}_{{ $room_qc[$stt]->motel_id }}_{{ $room_qc[$stt]->id }}_motel_img1.jpg" alt="">
                    </div>
                    <?php $stt++; ?>
                @endwhile
                <div class="box1" id="firstClone1">
                    <img src="/img/room/{{ $room_qc[0]->host_username }}_{{ $room_qc[0]->motel_id }}_{{ $room_qc[0]->id }}_motel_img1.jpg" alt="">
                </div>
                
            </div>   
            <a href="{{ route('page2_randomView') }}" class="more">
                Xem thêm
            </a>    
        </div>

    </div>

    <div id="footer">
       
    </div>


    <script src="./assets/js/page1.js"></script>
</body>
</html>