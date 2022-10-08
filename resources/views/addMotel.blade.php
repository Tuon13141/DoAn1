<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/css/addMotel_style.css">
    <link rel="stylesheet" href="/assets/css/headerAndFooter.css">
    <title>Document</title>
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

    <div id="holder">
        <div id="container">
            <div class="header">
                Thêm Trọ
            </div>
           
            <div class="body">
                
                <form method="post" action="{{ route('processAddMotel') }}">
                    @csrf

                    <label for="district" class="label">
                        Quận:   
                    </label>
                    <select name="district" id="district">
                        <option value="Cầu Giấy">Cầu Giấy</option>
                        <option value="Hai Bà Trưng">Hai Bà Trưng</option>
                        <option value="Đống Đa">Đống Đa</option>
                        <option value="Long Biên">Long Biên</option>
                    </select>

                    <label for="address" class="label">
                        Địa Điểm Cụ Thể:   
                    </label>
                    
                    <input type="text" id="address" class="input" placeholder="Địa Điểm" name="address"> 
                    
                    <label for="describe" class="label">
                        Miêu tả:   
                    </label>
                    
                    <input type="text" id="describe" class="input" placeholder="Miêu tả" name="describe">

                    <div class="button">
                        <input type="submit" name="submit" value="Thêm trọ">
                    </div>   
                </form>
                
            </div>
    
            <div class="footer">
                Chưa có tài khoản?  
                <a href="   " class="btn">Đăng kí ngay!</a>
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