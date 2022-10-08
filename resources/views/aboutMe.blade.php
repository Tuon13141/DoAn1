<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Me</title>
    <link rel="stylesheet" href="/assets/css/aboutMe_style.css">
    <link rel="stylesheet" href="/assets/css/headerAndFooter.css">
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
        <div class="big-box">
            <div class="holder">
                <form action="{{ route('processAboutMe') }}" method="post">
                    @csrf
                    <div class="title">
                        Chỉnh sửa thông tin cá nhân
                    </div>
                    <label for="name" class="label">
                        Họ Tên:         
                    </label>
                    
                    <input type="text" id="name" class="input" placeholder="Name" name="name"> 
    
                    <label for="email" class="label">
                        Email:         
                    </label>
                    
                    <input type="text" id="email" class="input" placeholder="Email" name="email"> 
    
                    <label for="password" class="label">
                        Password:   
                    </label>
                    
                    <input type="text" id="password" class="input" placeholder="Password" name="password"> 
                    
                    <label for="phone_number" class="label">
                        Số ĐT:   
                    </label>
                    
                    <input type="text" id="phone_number" class="input" placeholder="Phone Number" name="phone_number"> 

                    <div class="button">
                        <input type="submit" name="submit" value="Thay đổi">
                    </div>   
                </form>
                <a href="{{ route('myPage') }}">Quay lại</a>
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