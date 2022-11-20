<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/css/headerAndFooter.css">
    <link rel="stylesheet" href="/assets/css/help.css">
    <title>Hỏi Đáp</title>
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
        <div class="box1">
            <h3>Hãy đặt câu hỏi cho chúng tôi !</h3>
        </div>
        <div class="box2">
            <div class="small-box1">
                <div class="title">
                    Về chúng tôi
                </div>
                Được thực hiện bởi nhóm đồ án 2 gồm 5 người:
                <br>
                - Trưởng nhóm : Nguyễn Đình Quang Tuấn
                <br>
                - Tạ Quang Phúc
                <br>
                - Nguyễn Đình Thế
                <br>
                - Vũ Hoàng Long
                <br>
                - Nguyễn Hồng Quang

            </div>
            <div class="small-box2">
                <h3>Đặt câu hỏi tại đây</h3>
                <form action="{{ route('sendHelp') }}" method="post">
                    @csrf
                    <div class="choice">
                        Trạng thái:
                        <select name="type" id="type">
                            <option value="complain" >Khiếu nại</option>
                            <option value="support">Yêu cầu hỗ trợ</option>
                            <option value="bug">Báo lỗi</option>
                        </select>
                    </div>
                    <textarea type="text" name="question" placeholder="">
                    </textarea>
                    
                    <div class="send">
                        <input type="submit" name="submit" value="Gửi">
                    </div>
                    {{ session('hadSend') ? session('hadSend') : ''}}
                </form>
            </div>
        </div>
    </div>
    
    <div id="footer">
        

    </div>

</body>
</html>