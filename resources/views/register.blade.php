<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/css/login_style.css">
    <title>Document</title>
</head>
<body>
    <div id="holder">
        <div id="container">
            <div class="header">
                Register
            </div>
           
            <div class="body">
                <label for="username" class="label">
                    Username:         
                </label>
                
                <input type="text" id="username" class="input" placeholder="Username"> 

                <label for="email" class="label">
                    Email:         
                </label>
                
                <input type="text" id="email" class="input" placeholder="Username"> 

                <label for="password" class="label">
                    Password:   
                </label>
                
                <input type="text" id="password" class="input" placeholder="Password"> 

                <div class="button">
                    <input type="submit" name="submit" value="Register">
                </div>   
            </div>
    
            <div class="footer">
                Đã có tài khoản?  
                <a href="{{ route('login') }}" class="btn">Đăng nhập ngay!</a>
            </div>
        </div>      
    </div>
</body>
</html>