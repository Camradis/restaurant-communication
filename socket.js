var io = require('socket.io')(3000);

io.on('connection' , function (socket){

    console.log("New Connection" , socket.id);

    // socket.send("Message from server");

    //Fire event
    // socket.emit('server-info' , { version : .1});

    //Send message to users that are on server
    // socket.broadcast.send("New user");
});