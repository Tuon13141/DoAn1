<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/css/addRoom_style.css">
    <link rel="stylesheet" href="/assets/css/headerAndFooter.css">
    <title>Thêm phòng</title>
</head>
<body>

    <div id="holder">
        <div id="container">
            <div class="header">
                Thêm Trọ
            </div>
           
            <div class="body">
                
                <form method="post" action="{{ route('processAddRoom', ['motel_id' => $motel->id]) }}" enctype="multipart/form-data">
                    @csrf

                    <label for="number" class="label">
                        Phòng số:   
                    </label>
                    
                    <input type="number" id="number" class="input" placeholder="Phòng số" name="number">

                    <label for="price" class="label">
                        Giá Tiền:   
                    </label>
                    
                    <input type="number" id="price" class="input" placeholder="Giá tiền/tháng" name="price"> 
                    
                    <label for="area" class="label">
                        Diện tích:   
                    </label>
                    
                    <input type="number" id="area" class="input" placeholder="Diện tích/m2" name="area">

                    <label for="img-1" class="label">
                        Ảnh 1:   
                    </label>
                    
                    <input type="file" id="img-1" class="input" name="img-1">

                    <label for="img-2" class="label">
                        Ảnh 2:   
                    </label>
                    
                    <input type="file" id="img-2" class="input" name="img-2">

                    <label for="img-3" class="label">
                        Ảnh 3:   
                    </label>
                    
                    <input type="file" id="img-3" class="input" name="img-3">

                    <div class="button">
                        <input type="submit" name="submit" value="Thêm phòng">
                    </div>   
                </form>
                
            </div>
    
            <div class="footer">
                <a href="{{ route('aboutMotel', ['motel_id'=>$motel->id]) }}">Quay lại</a>
            </div>
        </div>      

</body>
</html>