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
        <img class="logo" src="./assets/img/logo1.jpg" alt="">
        <div class="user-account">
            <div class="ava {{ session()->has('role') ? '' : 'close' }}">
                <a href="{{ route('myPage') }}">Tôi</a>            
            </div>
        </div>
        <a class="upload_new" href="/">Đăng tin</a>
        <ul>
            <li>
                <a href="{{ route('login') }}" class="{{ session()->has('role') ? 'close' : '' }}">Đăng nhập</a>
            </li>
            <li>
                <a href="/">Hỏi đáp</a>
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
        <div class="info">
            <ul>
                <li class="about-us">About Us</li>
                <li>Nhóm 1</li>
                <li>Môn đồ án 1</li>
                <li>Web quản lí nhà trọ</li>
            </ul>
        </div>
        <div class="contact">
            <ul>
                <li class="contact-us">Contact</li>
                <li>Phone number: 090912345</li>
                <li>Email : nhom1doan1@gmail.com</li>
            </ul>
        </div>
    </div>
</body>
</html>