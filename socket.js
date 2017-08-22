// var io = require('socket.io')(3000);
//
// io.on('connection' , function (socket){
//
//     console.log("New Connection" , socket.id);
//
//     socket.on('message' , function(data){
//         socket.broadcast.send(data);
//     });
//
//     //Send
//     // socket.send("Message from server");
//
//     //Fire event
//     // socket.emit('server-info' , { version : .1});
//
//     //Send message to users that are on server
//     // socket.broadcast.send("New user");
//
//     //Join to rooms
//     // socket.join('vip' , function (error){
//     //     console.log(socket.rooms);
//     // });
// });

var Redis = require('ioredis');
var redis = new Redis(6379);

    redis.psubscribe('*' , function (error, count) {

    });

    redis.on('pmessage', function (pattern, channel, message) {
        console.log(channel, message);
    });