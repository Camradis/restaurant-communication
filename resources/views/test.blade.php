<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

<ul class="chat">

</ul>

<hr>

<form action="">

    <textarea style="width: 60%; height: 100px"></textarea>
    <input type="submit" value="Send">
</form>


<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.4.2/vue.min.js"></script>
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js"></script>
<script>

//    var socket = io(':3000');
//
//    function appendMessage(data){
//        $('.chat').append(
//            $('<li/>').text(data.message)
//        );
//    }
//
//    $('form').on('submit' , function(){
//
//        var text = $('textarea').val(),
//            msg = {message: text};
//
//        socket.send(msg);
//        appendMessage(msg);
//        $('textarea').val('');
//
//        return false;
//
//    });
//
//    socket.on('message' , function(data){
//       appendMessage(data);
//    });

</script>
</body>
</html>
