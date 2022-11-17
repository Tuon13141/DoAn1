<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/css/login_style.css">
    <link rel="stylesheet" href="/assets/css/headerAndFooter.css">
    <title>Quảng cáo cho trọ</title>
</head>
<body>
    <div id="holder">
        <div id="container">
            <div class="header">
                Đăng kí quảng cáo
            </div>
           
            <div class="body">

                <form method="post" action="{{ route('qcRoomController', ['motel_id' => $motel_id, 'room_id' => $room_id]) }}">
                    @csrf
                    <label for="month" class="label">
                        Hãy nhấn nút Xác nhận để được admin liên hệ tạo hợp đồng
                    </label>
             
                    <div class="button">
                        <input type="submit" name="submit" value="Xác nhận">
                    </div>
                    @if(session('hadSend'))
                        <label for="" class="label">{{session('hadSend')}}</label>
                    @endif  
            
                    <label for="" class="label"></label>
                    <label for="" class="label"></label>
                </form>
            </div>
    
            <div class="footer">
                <a href="{{ route('aboutRoom', ['motel_id' => $motel_id, 'room_id' => $room_id]) }}" class="btn">Quay lại</a>
            </div>
        </div>      
    </div>
</body>
</html>