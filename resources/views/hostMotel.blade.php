<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/css/hostMotel_style.css">
    <link rel="stylesheet" href="/assets/css/headerAndFooter.css">
    <title>Nhà trọ của tôi</title>
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
            <div class="small-box">
                <a href="{{ route('addMotel') }}" class="add">
                    Thêm Trọ
                </a>
                <div class="line"></div>
                <div class="clear"></div>
            </div>
            <div class="show-motel">
                <div class="row">
                    <ul>
                        <li class="stt">STT</li>
                        <li class="district">Quận</li>
                        <li class="address">Địa Chỉ Cụ Thể</li>
                        <li class="price">Giá Tiền</li>
                        <li class="status">Trạng Thái</li>
                    </ul>
                </div>
                    
                <?php $stt = 1 ?>
                @foreach ($motels as $motel)
                <div class="row">
                    <ul>
                        <a href="{{ route('aboutMotel', ['id'=>$motel->id]) }}">
                            <li class="stt"><?php echo $stt ?></li>
                            <li class="district">{{$motel->district}}</li>
                            <li class="address">{{$motel->address}}</li>
                            <li class="number-of-room">{{ $motel->number_of_room}}</li>
                            <li class="status">{{$motel->status}}</li>
                           
                        </a>
                        
                    </ul>
                    <?php $stt++ ?> 
                </div>
                   
                @endforeach   
                   
     
               
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