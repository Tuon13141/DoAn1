<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/css/login_style.css">
    <link rel="stylesheet" href="/assets/css/headerAndFooter.css">
    <title>Login</title>
</head>
<body>
    <div id="holder">
        <div id="container">
            <div class="header">
                Login
            </div>
           
            <div class="body">

                <form method="post" action=" {{ route('processLogin') }}">
                    @csrf
                    <label for="username" class="label">
                        Username:         
                    </label>
                    
                    <input type="text" id="username" class="input" placeholder="Username" name="username"> 
                    
                    @if ($errors->has('username'))               
                        <p style="color: red">
                            <br>{{ $errors->first('username')}}
                        </p>
                    @endif
                    <label for="password" class="label">
                        Password:   
                    </label>
                    
                    <input type="text" id="password" class="input" placeholder="Password" name="password"> 

                    @if ($errors->has('password'))               
                        <p style="color: red">
                            <br>{{ $errors->first('password')}}
                        </p>
                    @endif
                    
                    <div class="button">
                        <input type="submit" name="submit" value="LOGIN">
                    </div>   
                    <label for="" class="label">
                        @if(session('loginFailed'))
                            <p style="color: red">{{ session('loginFailed') }}</p>
                        @endif
                    </label>
                    <label for="" class="label"></label>
                </form>
            </div>
    
            <div class="footer">
                Ch??a c?? t??i kho???n?  
                <a href="{{ route('register') }}" class="btn">????ng k?? ngay!</a>
            </div>
        </div>      
    </div>
</body>
</html>