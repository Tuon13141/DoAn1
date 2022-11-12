<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/css/index_style.css">
    <link rel="stylesheet" href="/assets/css/headerAndFooter.css">
    <title>Homepage</title>
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
                <a href="">Thông báo</a>
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
        <div class="picture-holder">
            <img src="./assets/img/tro1.jpg" alt="">
        </div>
        
        <div class="box">
            <h1>WELCOME TO TRỌ XỊN</h1>
            <p>Hỗ trợ khách hàng với 5 tiêu chí :</p>
            <ul>
                <li>Phù hợp nhu cầu sử dụng.</li>
                <li>Đẹp.</li>
                <li>Giá thành tốt.</li>
                <li>Uy tín.</li>
                <li>Chất lượng.</li>
            </ul>
            <a href="{{  route('page1') }}" class="button">Thuê Ngay!</a>
        </div>
    </div>

    <div id="footer">
        
    </div>
</body>
</html>