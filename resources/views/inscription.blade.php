<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <title>inscription</title>
</head>
<body>
    <div class="wrapper">
        <div class="form sign_up">
            <header>inscription to tactac chat</header>
            <form action="{{route('inscription_auth')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="name_details">
                    <div class="filed input">
                        <label for="">first name</label>
                        <input type="text" name="fname" placeholder="enter your first name">
                        @error('fname')
                          <div id="emailHelp" class="text_erreur">.{{$message}}</div>
                        @enderror
                    </div>
                   
                    <div class="filed input">
                        <label for="">last name</label>
                        <input type="text" name="lname" placeholder="enter your last name">
                        @error('lname')
                          <div id="emailHelp" class="text_erreur">.{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="filed input">
                <label for="">email</label>
                <input type="text" name="email" placeholder="enter your email">
                @error('email')
                          <div id="emailHelp" class="text_erreur">.{{$message}}</div>
                @enderror
                </div>
                <div class="filed input">
                <label for="">password</label>
                <input type="password" name="password" placeholder="enter your password">
                @error('password')
                          <div id="emailHelp" class="text_erreur">.{{$message}}</div>
                @enderror
                <i class="fa-solid fa-eye-slash"></i>
                </div>
                <div class="filed image">
                <label for="">select image</label>
                <input type="file" name="image" placeholder="enter your image">
                @error('image')
                          <div id="emailHelp" class="text_erreur">.{{$message}}</div>
                @enderror
                </div>
                <div class="filed button">
                    <input type="submit" value="enter to submit" auto>
                </div>
            </form>
            <div class='link'>i have alredy a compte <a href="{{route('login')}}" >login now!</a></div>
        </div>
    </div>
    <script src="{{asset('js/show_password.js')}}"></script>
</body>
</html>