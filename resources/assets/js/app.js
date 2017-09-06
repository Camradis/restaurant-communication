/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

var socket = io(':3000');

function appendMessage(data){
    $('.orders').append(
        $('<p/>').append(
            $('<p/>').text('Dish -'+data.dish_name+' '),
            $('<p/>').text('Board -'+data.board+' '),
            $('<p/>').text('Created -'+data.created_at+' ')
        )
    );
}

socket.on('service:item' , function(data){
    console.log(data.id);
    console.log(data.dish_name);

    appendMessage(data);
});

socket.on('service:item.complete' , function(data){
    console.log(data);
    $( ".order-"+data.id ).remove();
});