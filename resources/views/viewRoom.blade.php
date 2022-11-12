<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/css/viewRoom_style.css">
    <link rel="stylesheet" href="/assets/css/headerAndFooter.css">
    <title>Xem trọ</title>
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
        <div class="box box-left">
            <div class="small-box img-box">
                <div class="holder black-text">
                    <div class="container1">
                        <p id="preBtn1"><</p>
                        <p id="nextBtn1">></p> 
                        <div class="slider1">
                            <div class="box1" id="lastClone1">
                                <img src="/img/room/{{ $room->host_username }}_{{ $room->motel_id }}_{{ $room->id }}_motel_img3.jpg" alt="">
                            </div>
                            <div class="box1">
                                <img src="/img/room/{{ $room->host_username }}_{{ $room->motel_id }}_{{ $room->id }}_motel_img1.jpg" alt="">
                            </div>
                            <div class="box1">
                                <img src="/img/room/{{ $room->host_username }}_{{ $room->motel_id }}_{{ $room->id }}_motel_img2.jpg" alt="">
                            </div>
                            <div class="box1">
                                <img src="/img/room/{{ $room->host_username }}_{{ $room->motel_id }}_{{ $room->id }}_motel_img3.jpg" alt="">
                            </div>
                            <div class="box1" id="firstClone1">
                                <img src="/img/room/{{ $room->host_username }}_{{ $room->motel_id }}_{{ $room->id }}_motel_img1.jpg" alt="">
                            </div>
                            
                        </div>     
                    </div>
                      
                </div>             
            </div>
        </div>
        <div class="box">
            <div class="small-box ">
                <div class="holder colored-box">
                    <div class="title">
                        Thông tin phòng
                    </div>
                    <div class="form-body">
                        <label for="status" class="label">
                            Trạng thái: {{ $room->status == 'available' ? 'Còn trống' : 'Đã được thuê' }}     
                        </label>

                        <label for="number" class="label">
                            Phòng số: {{ $room->number }} 
                        </label>
                        
                        <label for="price" class="label">
                            Giá tiền: {{ $room->price }}/tháng
                        </label>
        
                        <label for="area" class="label">
                            Diện tích: {{ $room->area }}m2
                        </label>

                        <div class="clear"></div>

                    </div>
                    <div class="title">
                        Thông tin liên hệ chủ trọ
                    </div>
                    <div class="form-body">
                        <label for="status" class="label">
                            Tên chủ trọ: {{ $host->name }}     
                        </label>

                        <label for="number" class="label">
                            Số điện thoại: {{ $host->phone_number }} 
                        </label>
                        
                        <label for="price" class="label">
                            Email: {{ $host->email }}
                        </label>

                        <div class="clear"></div>

                    </div>
                        


                    <a href="{{ url()->previous() }}" class="back">Quay lại</a>
                   
                </div>             
            </div>
        </div>
    </div>

    <div id="footer">
      
    </div>
    <script src="/assets/js/page1.js"></script>
</body>
</html>