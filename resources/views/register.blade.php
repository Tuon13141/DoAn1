<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/css/login_style.css">
    <link rel="stylesheet" href="/assets/css/headerAndFooter.css">
    <title>Document</title>
</head>
<body>
    <div id="holder">
        <div id="container">
            <div class="header">
                Register as User
            </div>
           
            <div class="body">
                <form action="{{ route('processRegister') }}" method="post">
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
    
                    <label for="email" class="label">
                        Email:         
                    </label>
                    
                    <input type="text" id="email" class="input" placeholder="Email" name="email"> 
                    @if ($errors->has('email'))               
                        <p style="color: red">
                            <br>{{ $errors->first('email')}}
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

                    <label for="name" class="label">
                        Name:   
                    </label>
                    
                    <input type="text" id="name" class="input" placeholder="Name" name="name"> 
                    @if ($errors->has('name'))               
                        <p style="color: red">
                            <br>{{ $errors->first('name')}}
                        </p>
                    @endif
                    
              
                    <div class="button">
                        <input type="submit" name="submit" value="Register">
                    </div>  
                    
                    <label for="" class="label">
                        <a href="{{ route('hostRegister') }}" class="btn">????ng k?? t??i kho???n Ch??? tr??? ?</a> 
                    </label>

                    @if(session('registerFailed'))
                        <label for="" class="label">
                            <p style="color: red">{{ session('registerFailed') }}</p>
                        </label>     
                    @endif
                </form>
            </div>
                
                
            <div class="footer">
                ???? c?? t??i kho???n?  
                <a href="{{ route('login') }}" class="btn">????ng nh???p ngay!</a>
                
            </div>
        </div>      
    </div>
</body>
</html>