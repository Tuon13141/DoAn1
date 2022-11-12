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
                    <div class="img-holder-1">
                        <img src="/img/motel/{{ session('username') }}_{{ $motel->id }}_motel_img1.jpg" alt="">
                    </div>
                    <div class="img-holder-1">
                        <img src="/img/motel/{{ session('username') }}_{{ $motel->id }}_motel_img2.jpg" alt="">
                    </div>
                    <div class="img-holder-1">
                        <img src="/img/motel/{{ session('username') }}_{{ $motel->id }}_motel_img3.jpg" alt="">
                    </div>
                    <form action="{{ route('changePictureMotel', ['motel_id'=>$motel->id]) }}" method="post" enctype="multipart/form-data">
                       
                        @csrf
                        <div class="title">
                            Chỉnh sửa ảnh trọ
                        </div>
                        <label for="img-1" class="label">
                            Ảnh 1:       
                        </label>

                        <input type="file" id="img-1"  name="img-1"> 
                    
                        <label for="img-2" class="label">
                            Ảnh 2:       
                        </label>

                        <input type="file" id="img-2"  name="img-2"> 

                        <label for="img-3" class="label">
                            Ảnh 3:       
                        </label>

                        <input type="file" id="img-3"  name="img-3">  

                        <div class="button bt1">
                            <input type="submit" name="submit" value="Thay đổi">
                        </div>

                        <div class="clear"></div>
                    </form>       
                </div>             
            </div>
        </div>
        <div class="box box-right">
            <div class="small-box colored-box">
                <div class="holder">
                    <form action="{{ route('processChangeAboutMotel', ['motel_id'=>$motel->id]) }}" method="post">
                        @csrf
                        <div class="title">
                            Chỉnh sửa thông tin trọ
                        </div>
                        <div class="form-body">
                            <label for="district" class="label">
                                Quận        
                            </label>
                            
                            <select name="district" id="district">
                                <option value="{{ $motel->district }}">{{ $motel->district }}</option>
                                <option value="Cầu Giấy" class="{{ $motel->district == 'Cầu Giấy' ? 'close' : ''}}">Cầu Giấy</option>
                                <option value="Hai Bà Trưng" class="{{ $motel->district == 'Hai Bà Trưng' ? 'close' : ''}}">Hai Bà Trưng</option>
                                <option value="Đống Đa" class="{{ $motel->district == 'Đống Đa' ? 'close' : ''}}">Đống Đa</option>
                                <option value="Long Biên" class="{{ $motel->district == 'Long Biên' ? 'close' : ''}}">Long Biên</option>
                            </select> 
    
                            <div class="button bt1">
                                <input type="submit" name="submit" value="Thay đổi">
                            </div>
                            
                            <a href="{{ route('hostMotel') }}" class="back">Quay lại</a>
    
                            <label for="addres" class="label">
                                Địa điểm cụ thể:        
                            </label>
                            
                            <input type="text" id="address" class="input" placeholder="{{ $motel->address }}" name="address"> 
            
                            <label for="describe" class="label">
                                Miêu tả chi tiết:   
                            </label>
                            
                            <input type="text" id="describe" class="input" placeholder="{{ $motel->describe }}" name="describe"> 
    
                            <div class="clear"></div>
                        </div>
                        
                    </form>

                    <a href="{{ route('deleteMotel', ['motel_id'=>$motel->id]) }}" class="back bt2">Xoá trọ</a>
                    <a href="{{ route('addRoom', ['motel_id'=>$motel->id, 'motel'=>$motel]) }}" class="back bt3">Thêm phòng</a>
          
                    <div class="show-room">
                        
                        @foreach ($rooms as $room)
                        <div class="row">
                            <ul>
                                <a href=" {{ route('aboutRoom', ['motel_id' => $motel->id, 'room_id' => $room->id]) }}">
                                    <li class="stt">Phòng số: {{ $room->number }}</li>
                                   
                                    <li class="status">Trạng thái: {{$room->status == 'available' ? 'Còn trống' : 'Đã thuê'}}</li>
                                   
                                </a>
                                
                            </ul>
                            
                        </div>
                           
                        @endforeach   
                    </div>
                   
                </div>             
            </div>
        </div>
    </div>

    <div id="footer">
   
    </div>
</body>
</html>