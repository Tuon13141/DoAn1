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

    <div id="holder">
        <div class="container">
            <div class="header">
                Thay đổi thông tin cá nhân
            </div>
            <div class="body">
                <form action="{{ route('processChangeAboutMe') }}" method="post" enctype="multipart/form-data" >
                    @csrf

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
        
                    <label for="ava" class="label">
                        Ảnh đại diện:   
                    </label>
                    
                    <input type="file" id="ava" class="input" name="ava">
        
                    <div class="button">
                        <input type="submit" name="submit" value="Thay đổi">
                    </div>   
                </form>
                
            </div>
            <div class="footer">
                <a href="{{ route('myPage') }}">Quay lại</a>
            </div>
        </div>
        
    </div>

</body>
</html>