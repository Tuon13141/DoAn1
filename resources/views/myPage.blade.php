<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/css/myPage_style.css">
    <link rel="stylesheet" href="/assets/css/headerAndFooter.css">
    <title>My Page</title>
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
        <div class="box">
            <div class="small-box-1">
                <div class="circle">
                    <img src="./assets/img/ava4.jpg" alt="">
                </div>
                <div class="content">
                    Họ tên: {{ session('name') }}   <br>
                    Tài khoản: {{ session('role') }}
                </div>
                
            </div>
            <div class="small-box-2">
                Số điện thoại: {{ session('phone_number') == '0' ? '' : session('phone_number') }} <br>
                Email: {{ session('email') }} <br>
                <a href="{{ route('aboutMe') }}" class="change">Chỉnh sửa</a>
                <a href="{{ route('logout') }}" class="log-out">Đăng xuất</a>            
            </div>
            
        </div>
        <div class="box">
            <div class="small-box-3">
                <div class="host {{ session('role') == 'host' ? '' : 'close' }}">
                    <div class="host-content">
                        <div class="title">
                            Quản lí nhà trọ: <br> <br> <br>
                                - Số nhà trọ đang quản lí: <br> <br>
                                - Số nhà trọ đã được thuê: <br>
                        </div>  
                        <a href="{{ route('hostMotel') }}">Chi tiết</a>
                    </div>
                </div>
                <div class="admin {{ session('role') == 'admin' ? '' : 'close' }}">

                </div>
                <div class="user {{ session('role') == 'role' ? '' : 'close' }}">

                </div>
            </div>
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