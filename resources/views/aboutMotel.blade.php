<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/css/aboutMotel_style.css">
    <link rel="stylesheet" href="/assets/css/headerAndFooter.css">
    <title>Thông tin nhà trọ</title>
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
            <div class="small-box">

            </div>
        </div>
        <div class="box">
            <div class="small-box">
                <div class="holder">
                    <form action=" " method="post">
                        @csrf
                        <div class="title">
                            Chỉnh sửa thông tin trọ
                        </div>
                        <label for="Quận" class="label">
                            Quận        
                        </label>
                        
                        <select name="district" id="district">
                            <option value=""></option>
                            <option value="Cầu Giấy">Cầu Giấy</option>
                            <option value="Hai Bà Trưng">Hai Bà Trưng</option>
                            <option value="Đống Đa">Đống Đa</option>
                            <option value="Long Biên">Long Biên</option>
                        </select> 
        
                        <label for="addres" class="label">
                            Địa điểm cụ thể:        
                        </label>
                        
                        <input type="text" id="address" class="input" placeholder="{{ $motels->address }}" name="address"> 
        
                        <label for="desc" class="label">
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