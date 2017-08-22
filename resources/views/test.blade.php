@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Websockets</div>

                    <div class="panel-body">
                        <ul class="chat">
                            @foreach($items as $item)
                                <li>
                                    <b> {{ $item->id }}</b>
                                    <b> {{ $item->dish_name }}</b>
                                    <b> {{ $item->board }}</b>
                                    <b> {{ $item->status }}</b>
                                    <b> {{ $item->created_at }}</b>
                                </li>
                            @endforeach
                        </ul>

                        <hr>

                        <form action="/items" method="POST">
                            {{ csrf_field() }}
                            <input type="text" name="author">
                            <br>
                            <textarea name="content" style="width: 60%; height: 100px"></textarea>
                            <input type="submit" value="Send">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.4.2/vue.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js"></script>
    <script>

        var socket = io(':3000');

        function appendMessage(data){
            $('.chat').append(
                $('<li/>').append(
                    $('<b/>').text(data.dish_name),
                    $('<b/>').text(data.board),
                    $('<b/>').text(data.created_at)
                )
            );
        }

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
        socket.on('service:item' , function(data){
            console.log(data.id);
            console.log(data.dish_name);

           appendMessage(data);
        });

    </script>
@endsection