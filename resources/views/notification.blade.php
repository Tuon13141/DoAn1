<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/css/notification_style.css">
    <link rel="stylesheet" href="/assets/css/headerAndFooter.css">
    <title>Thông báo</title>
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
                <?php 
                    use Illuminate\Support\Facades\DB;
                    use Illuminate\Database\Query\Builder;
                    $note = DB::table('answer')->where('username', session('username'))->where('hadSeen', 'no')->count();
                ?>              
                <a href="{{ route('notification') }}">Thông báo</a>
                {{ $note > 0 ? '*' : '' }}
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
                <h1>Danh sách thông báo</h1>
            </div>
            <div class="show-question">
                <div class="row">
                    <ul>
                        <li class="stt">STT</li>
                        <li class="type">Loại</li>
                        <li class="day_ask">Ngày hỏi</li>
                        <li class="created_at">Ngày phản hồi</li>
                        <li class="hadSeen">Trạng thái</li>
                    </ul>
                </div>
                    
                <?php $stt = 1 ?>
                @foreach($notifications as $notification)
                <div class="row">
                    <ul>
                        <div class="question-holder">
                            <a href="{{ route('aboutNotification', ['notification_id' => $notification->id]) }}">
                                <li class="stt"><?php echo $stt ?></li>
                                <li class="type">{{ $notification->type }}</li>
                                <li class="day_ask">{{ $notification->day_ask }}</li>
                                <li class="created_at">{{ $notification->created_at }}</li>
                                <li class="hadSeen">{{ $notification->hadSeen == 'no' ? 'Chưa xem' : 'Đã xem'}}</li>
                            </a>
                        </div>                
                    </ul>
                    <?php $stt++ ?> 
                </div>
                 @endforeach  
                 
              
                <div class="clear"></div>   
                
               
            </div>
            <div class="small-box">
                <a href="{{ route('myPage') }}" class="add">
                    Quay lại
                </a>
            </div>
            
        </div>
    </div>
    
</body>
</html>