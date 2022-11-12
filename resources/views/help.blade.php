<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/css/headerAndFooter.css">
    <link rel="stylesheet" href="/assets/css/help.css">
    <title>Document</title>
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
        <div class="box1">
            <h3>Tìm câu hỏi đã có sẵn</h3>
            <input type="text" name="">
            <a href="">Tìm kiếm</a>
        </div>
        <div class="box2">
            <div class="small-box1">
                <a href="">Tôi không biết cách thông đít thằng quang?</a>
                <a href="">Tôi không biết cách nạp tiền?</a>
                <a href="">Cách đánh tài xỉu?   </a>
                <a href="">Cách nạp tiền vào Nhà Cái đến từ Châu Âu</a>
                <a href="">Tôi không biết cách uống trà đá?</a>
                <a href="">Tôi không biết cách nạp tiền?</a>
                <a href="">Tôi không biết cách gia hạn?</a>
                <a href="">Tôi không biết cách lừa sinh viên?</a>
                <a href="">Tôi không biết cách uống trà đá?</a>
                <a href="">Tôi không biết cách nạp tiền?</a>
                <a href="">Tôi không biết cách gia hạn?</a>
                <a href="">Tôi không biết cách lừa sinh viên?</a>
                <a href="">Tôi không biết cách uống trà đá?</a>
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
                    <textarea type="text" name="question">
                    </textarea>
                    <div class="send">
                        <input type="submit" name="submit" value="Gửi">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div id="footer">
        

    </div>

</body>
</html>