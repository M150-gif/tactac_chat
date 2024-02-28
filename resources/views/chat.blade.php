<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <title>Document</title>
    <!-- mohamed ibrahimi -->
</head>
<body>
    <div class="wrapper">
        <div class="chat">
            <header>
                <a href="{{route('user')}}" class="back_icon"><i class="fas fa-arrow-left"></i></a>
                <img src="{{$other_user->image}}" alt="">
                <div class="details_user_chat">
                    <span>{{$other_user->fname}} {{$other_user->lname}}</span>
                    <p>{{$other_user->status}}</p>
                </div>
            </header>
            <div class="chat_box">
                @if(empty($messages[0]->message))
                <div class="text">no message avaible now!</div>
                @endif
                @foreach($messages as $message)
                @if($message->user_outgoing_id==auth()->user()->id)
                <div class="message outgoing">
                    <div class="details"><p>{{$message->message}}</p></div>
                </div>
                @elseif($message->user_outgoing_id==$other_user->id)
                <div class="message incoming">
                    <img src="{{$message->image}}" alt="">
                    <div class="details"><p>{{$message->message}}</p></div>
                </div>
                @endif
                @endforeach
            </div>
            <form action="" class="chat_area">
                @csrf
                <input type="hidden" name="incoming_user_id" value="{{$other_user->id}}" autocomplete="off">
                <input type="text" name="message" class="text" placeholder="send message" autocomplete="off">
                <button><i class="fa-solid fa-paper-plane"></i></button>
                </form>
        </div>
    </div>
    <script src="js/send_message.js"></script>
    <script src="js/get_messages.js"></script>
</body>
</html>