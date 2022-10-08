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
        <div class="container1">
            <p style="font-size: 30px; color: rgb(51, 51, 51); padding-left: 470px; padding-bottom: 30px; font-weight: 600;">Gợi ý cho bạn:</p>
            <p id="preBtn1"><</p>
            <p id="nextBtn1">></p> 
            <div class="slider1">
                <div class="box1" id="lastClone1">
                    <img src="./assets/img/tro3.jpg" alt="">
                </div>
                <div class="box1">
                    <img src="./assets/img/tro1.jpg" alt="">
                </div>
                <div class="box1">
                    <img src="./assets/img/tro2.jpg" alt="">
                </div>
                <div class="box1">
                    <img src="./assets/img/tro3.jpg" alt="">
                </div>
                <div class="box1" id="firstClone1">
                    <img src="./assets/img/tro1.jpg" alt="">
                </div>
                
            </div>   
            <a style="width: 160px; height: 40px; line-height: 40px; color: white; text-align: center; font-size: 30px; 
                    float: right; margin-top: 30px; background-color: rgb(119, 76, 16)">
                Xem thêm
            </a>    
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


    <script src="./assets/js/page1.js"></script>
</body>
</html>