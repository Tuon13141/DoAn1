<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/css/buyPage_2_style.css">
    <link rel="stylesheet" href="/assets/css/headerAndFooter.css">
    <title>Trang nhà trọ</title>
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

    <?php 
        use Illuminate\Support\Facades\DB;
        use Illuminate\Database\Query\Builder;
    ?>

    <div id="body">
        <div class="setting-part">
            <form action="{{ route('page2_orderedView') }}">
                <div class="choice">

                </div>
                <div class="choice">
                    Quận:
                    <select name="district" id="district">
                        <option value="all" {{ $district_input == 'all' ? 'selected' : '' }}>Tất Cả</option>
                        <option value="Cầu Giấy" {{ $district_input == 'Cầu Giấy' ? 'selected' : '' }}>Cầu Giấy</option>
                        <option value="Hai Bà Trưng" {{ $district_input == 'Hai Bà Trưng' ? 'selected' : '' }}>Hai Bà Trưng</option>
                        <option value="Đống Đa" {{ $district_input == 'Đống Đa' ? 'selected' : '' }}>Đống Đa</option>
                        <option value="Long Biên" {{ $district_input == 'Long Biên' ? 'selected' : '' }}>Long Biên</option>
                    </select>
                </div>
                <div class="choice">
                    Diện tích:
                    <select name="area" id="area">
                        <option value="all" {{ $area_input == 'all' ? 'selected' : '' }}>Tất Cả</option>
                        <option value="0<x<=20" {{ $area_input == '0<x<=20' ? 'selected' : '' }}>1m2 - 20m2</option>
                        <option value="20<x<=30" {{ $area_input == '20<x<=30' ? 'selected' : '' }}>21m2 - 30m2</option>
                        <option value="30<x<=40" {{ $area_input == '30<x<=40' ? 'selected' : '' }}>31m2 - 40m2</option>
                        <option value="40<x<=50" {{ $area_input == '40<x<=50' ? 'selected' : '' }}>41m2 - 50m2</option>
                        <option value="x>50" {{ $area_input == 'x>50' ? 'selected' : '' }}>Trên 51m2</option>
                    </select>
                </div>
                <div class="choice">
                    Giá tiền:
                    <select name="price" id="price">
                        <option value="all" {{ $price_input == 'all' ? 'selected' : '' }}>Tất Cả</option>
                        <option value="x<=1" {{ $price_input == 'x<=1' ? 'selected' : '' }}>0 - 1 triệu</option>
                        <option value="1<x<=2" {{ $price_input == '1<x<=2' ? 'selected' : '' }}>1 triệu 1 - 2 triệu</option>
                        <option value="2<x<=3" {{ $price_input == '2<x<=3' ? 'selected' : '' }}>2 triệu 1 - 3 triệu</option>
                        <option value="3<x<=4" {{ $price_input == '3<x<=4' ? 'selected' : '' }}>3 triệu 1 - 4 triệu</option>
                        <option value="4<x<=5" {{ $price_input == '4<x<=5' ? 'selected' : '' }}>4 triệu 1 - 5 triệu</option>
                        <option value="x>5" {{ $price_input == 'x>5' ? 'selected' : '' }}>Trên 5 triệu</option>
                    </select>
                </div>
                <div class="choice">
                    Trạng thái:
                    <select name="status" id="status">
                        <option value="all" {{ $status_input == 'all' ? 'selected' : '' }}>Tất Cả</option>
                        <option value="available" {{ $status_input == 'available' ? 'selected' : '' }}>Còn trống</option>
                        <option value="unavailable" {{ $status_input == 'unavailable' ? 'selected' : '' }}>Đã cho thuê</option>
                    </select>
                </div>
                <div class="choice">
                    Thời Gian:
                    <select name="timeline" id="timeline">
                        <option value="all" {{ $timeline_input == 'all' ? 'selected' : '' }}>Tất Cả</option>
                        <option value="new" {{ $timeline_input == 'new' ? 'selected' : '' }}>Mới nhất</option>
                        <option value="old" {{ $timeline_input == 'old' ? 'selected' : '' }}>Cũ nhất</option>
                    </select>
                </div>
                <div class="choice">
                    <br>
                    <input type="submit" name="submit" value="Tìm kiếm">
                </div>
           
            </form>
            
        </div>

        <div class="qc-part {{ $room_qc->count() == 0 ? 'close' : '' }}">
            <div class="holder">
               
                @foreach($room_qc as $child) 
             
                <?php 

                    $host = DB::table('host')->where('username', $child->host_username)->first();
                    $motel = DB::table('motel')->where('id', $child->motel_id)->where('host_username',  $child->host_username)->first();
                    $district = $motel->district;
                    $address = $motel->address;

                ?>
                <div class="col">
                    <a href="{{ route('viewRoom', ['motel_id' => $child->motel_id, 'room_id' => $child->id, 'host_username' => $child->host_username,
                                'district_input' => $district_input, 'price_input' => $price_input, 'area_input' => $area_input,
                                'status_input' => $status_input, 'timeline_input' => $timeline_input]) }}" class="link">
                        <div class="info-holder ad">
                            <div class="info-content">
                                <div class="img-holder">
                                    <img src="/img/room/{{ $child->host_username }}_{{ $child->motel_id }}_{{ $child->id }}_motel_img1.jpg" alt="">
                                </div>
                                <div class="info">
                                    <div class="district">
                                        Quận: {{$district }}
                                    </div>
                                    <div class="address">
                                        Địa điểm: {{ $address }}
                                    </div>
                                    <div class="area">
                                        Diện tích: {{ $child->area }} m2
                                    </div>
                                    <div class="price">
                                        Giá tiền: {{ $child->price }} VNĐ
                                    </div>
                                    <div class="status">
                                        Trạng thái: {{ $child->status == 'unavailable' ? 'Đã cho thuê' : 'Còn trống'}}
                                    </div>
                                </div>
                            </div>         
                        </div>
                    </a>
                    
                </div>
                @endforeach
                 
                <div class="clear"></div>
            </div>
        </div>
        <div class="normal-part">
            <div class="holder">
              
                @foreach($room as $child) 
                <?php 

                    $motel = DB::table('motel')->where('id', $child->motel_id)->where('host_username',  $child->host_username)->first();
                    $district = $motel->district;
                    $address = $motel->address;

                ?>
                <div class="col">
                    <a href="{{ route('viewRoom', ['motel_id' => $child->motel_id, 'room_id' => $child->id, 'host_username'=> $child->host_username]) }}" class="link">
                        <div class="info-holder">
                            <div class="info-content">
                                <div class="img-holder">
                                    <img src="/img/room/{{ $child->host_username }}_{{ $child->motel_id }}_{{ $child->id }}_motel_img1.jpg" alt="">
                                </div>
                                <div class="info">
                                    <div class="district">
                                        Quận: {{$district }}
                                    </div>
                                    <div class="address">
                                        Địa điểm: {{ $address }}
                                    </div>
                                    <div class="area">
                                        Diện tích: {{ $child->area }} m2
                                    </div>
                                    <div class="price">
                                        Giá tiền: {{ $child->price }} VNĐ
                                    </div>
                                    <div class="status">
                                        Trạng thái: {{ $child->status == 'unavailable' ? 'Đã cho thuê' : 'Còn trống'}}
                                    </div>
                                </div>
                            </div>         
                        </div>
                    </a>       
                </div>
                @endforeach
                 
               
            </div>
        </div>
    </div>
</body>
</html>