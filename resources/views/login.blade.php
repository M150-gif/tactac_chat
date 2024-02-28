<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <title>login</title>
</head>
<!-- //flash pour afficher un message -->
<body>
    <div class="wrapper">
        <div class="form login">
            <header>login to tactac chat</header>
           <form action="{{route('login_auth')}}" method="POST" enctype="multipart/form-data">
            @csrf
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
                <i class="fa-solid fa-eye-slash "></i>
                @error('password')
                    <div id="emailHelp" class="text_erreur">.{{$message}}</div>
                @enderror
            </div>
            <div class="filed button">
                    <input type="submit" value="enter to submit" auto>
            </div>
           </form>
           <div class="link">i don't have a compte <a href="{{route('inscription')}}">sign up now!</a></div>
        </div>
    </div>
    <script src="{{asset('js/show_password.js')}}"></script>

</body>
</html>