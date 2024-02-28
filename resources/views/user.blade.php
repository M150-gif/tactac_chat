<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>tactac</title>
</head>
<body>
    <div class="wrapper">
       <div class="user">
       <header>
                <div class="content">
                    <img src="{{auth()->user()->image}}" alt="">
                    <div class="content_details">
                        <span>{{auth()->user()->fname}} {{auth()->user()->lname}}</span>
                        <p>{{auth()->user()->status}}</p>
                    </div>
                </div>
                <a href="{{route('logout')}}" class="logout">logout</a>
        </header>
        <div class="serach_users">
            <div class="text">search user to start chat</div>
            <input type="text" class="serach_input" placeholder="enter name to search" autocomplete="off">
            <button class=""><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
        <div class="list_users">
            @foreach($users as $user)
            <a href="http://127.0.0.1:8000/chat?user_id_chat={{$user->id}}">
                <div class="content">
                    <img src="{{$user->image}}" alt="">
                    <div class="content_details">
                        <span>{{$user->fname}} {{$user->lname}}</span>
                        <p><span>{{$user->statu}}</span>{{$user->last_message}}</p>
                    </div>
                </div>
                <div class="status {{$user->status}}"><i class="fa-solid fa-circle"></i></div>
            </a>
            @endforeach
        </div>
       </div>
    </div>
    <script src="{{asset('js/serach_users.js')}}"></script>
</body>
</html>