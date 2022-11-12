<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/css/addMotel_style.css">
    <link rel="stylesheet" href="/assets/css/headerAndFooter.css">
    <title>Document</title>
</head>
<body>

    <div id="holder">
        <div id="container">
            <div class="header">
                Thêm Trọ
            </div>
           
            <div class="body">
                
                <form method="post" action="{{ route('processAddMotel') }}" enctype="multipart/form-data">
                    @csrf

                    <label for="district" class="label">
                        Quận:   
                    </label>
                    <select name="district" id="district" aria-placeholder="Quận">
                        <option value="Cầu Giấy">Cầu Giấy</option>
                        <option value="Hai Bà Trưng">Hai Bà Trưng</option>
                        <option value="Đống Đa">Đống Đa</option>
                        <option value="Long Biên">Long Biên</option>
                    </select>

                    <label for="address" class="label">
                        Địa Điểm Cụ Thể:   
                    </label>
                    
                    <input type="text" id="address" class="input" placeholder="Địa Điểm" name="address"> 
                    
                    <label for="describe" class="label">
                        Miêu tả:   
                    </label>
                    
                    <input type="text" id="describe" class="input" placeholder="Miêu tả" name="describe">
                 
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
                        <input type="submit" name="submit" value="Thêm trọ">
                    </div>
                </form>
                
            </div>
    
            <div class="footer">
                <a href="{{ route('hostMotel') }}">Quay lại</a>
            </div>
        </div>      

</body>
</html>