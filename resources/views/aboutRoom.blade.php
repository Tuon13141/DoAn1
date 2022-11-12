<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/css/aboutRoom_style.css">
    <link rel="stylesheet" href="/assets/css/headerAndFooter.css">
    <title>Phòng của tôi</title>
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
                    
                    <form action="{{ route('changePictureMotel', ['motel_id'=>$motel->id]) }}" method="post" enctype="multipart/form-data">
                       
                        @csrf
                        <div class="img-holder-1">
                            <img src="/img/room/{{ session('username') }}_{{ $motel->id }}_{{ $room->id }}_motel_img1.jpg" alt="">
                        </div>
                        <div class="img-holder-1">
                            <img src="/img/room/{{ session('username') }}_{{ $motel->id }}_{{ $room->id }}_motel_img2.jpg" alt="">
                        </div>
                        <div class="img-holder-1">
                            <img src="/img/room/{{ session('username') }}_{{ $motel->id }}_{{ $room->id }}_motel_img3.jpg" alt="">
                        </div>
                        <div class="title">
                            Chỉnh sửa ảnh phòng
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
        <div class="box">
            <div class="small-box ">
                <div class="holder colored-box">
                    <form action="{{ route('changeAboutRoom', ['motel_id' => $motel->id, 'room_id' => $room->id]) }}" method="post">
                        @csrf
                        <div class="title">
                            Chỉnh sửa thông tin phòng
                        </div>
                        <div class="form-body">
                            <label for="status" class="label">
                                Trạng thái:        
                            </label>
                            
                            <select name="status" id="status">
                                <option value="{{ $room->status }}">{{ $room->status == 'available' ? 'Còn trống' : 'Đã thuê'}}</option>
                                <option value="available" class="{{ $room->status == 'available' ? 'close' : ''}}">Còn trống</option>
                                <option value="unavailable" class="{{ $room->status == 'unavailable' ? 'close' : ''}}">Đã thuê</option>   
                            </select> 
    
                            <div class="button bt1">
                                <input type="submit" name="submit" value="Thay đổi">
                            </div>
    
                            <a href="{{ route('aboutMotel', ['motel_id'=>$motel->id]) }}" class="back">Quay lại</a>
    
                            <label for="number" class="label">
                                Phòng số:     
                            </label>
                            
                            <input type="text" id="number" class="input" placeholder="{{ $room->number }}" name="number"> 
                            
                            <label for="price" class="label">
                                Giá tiền:     
                            </label>
                            
                            <input type="text" id="price" class="input" placeholder="{{ $room->price }}/tháng" name="price"> 
            
                            <label for="area" class="label">
                                Diện tích: 
                            </label>
                            
                            <input type="text" id="area" class="input" placeholder="{{ $room->area }}/m2" name="area"> 
    
                            <label class="label ad">
                                Quảng cáo: {{ $room->qc == 'yes' ? 'Có' : 'Không'}}     
                            </label>
    
                            <div class="clear"></div>
    
                            <a href="{{ route('deleteRoom', ['motel_id'=>$motel->id, 'room_id' => $room->id]) }}" class="back bt2">Xoá phòng</a>
                        </div>
                        
                    </form>

                   
                   
                </div>             
            </div>
        </div>
    </div>

    <div id="footer">
    
    </div>
</body>
</html>