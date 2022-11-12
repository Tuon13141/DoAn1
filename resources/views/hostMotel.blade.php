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
        <div class="big-box">
            <div class="small-box">
                <h1>Danh sách nhà trọ của tôi</h1>
            </div>
            <div class="show-motel">
                <div class="row">
                    <ul>
                        <li class="stt">STT</li>
                        <li class="district">Quận</li>
                        <li class="address">Địa Chỉ Cụ Thể</li>
                        <li class="price">Số phòng</li>
                        <li class="status">Trạng Thái</li>
                    </ul>
                </div>
                    
                <?php $stt = 1 ?>
                @foreach ($motels as $motel)
                <div class="row">
                    <ul>
                        <div class="motel-holder">
                            <a href="{{ route('aboutMotel', ['motel_id'=>$motel->id]) }}">
                                <li class="stt"><?php echo $stt ?></li>
                                <li class="district">{{$motel->district}}</li>
                                <li class="address">{{$motel->address}}</li>
                                <li class="number-of-room">{{ $motel->number_of_room}}</li>
                                <li class="status">{{$motel->status == 'available' ? 'Còn phòng' : 'Hết phòng'}}</li>
                               
                            </a>
                        </div>
                        
                        
                    </ul>
                    <?php $stt++ ?> 
                </div>
                   
                @endforeach   
                <div class="clear"></div>   
                
               
            </div>
            <div class="small-box">
                <a href="{{ route('addMotel') }}" class="add">
                    Thêm Trọ
                </a>
                <a href="{{ route('myPage') }}" class="back">
                    Quay lại
                </a>
            </div>
            
        </div>
    </div>

    <div id="footer">
      
    </div>
</body>
</html>