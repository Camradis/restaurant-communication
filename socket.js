var io = require('socket.io')(3000);

var Redis = require('ioredis');
var redis = new Redis(6379);

    redis.psubscribe('*' , function (error, count) {

    });

    redis.on('pmessage', function (pattern, channel, message) {
        message = JSON.parse(message);
        io.emit(channel + ':' + message.event, message.data.order);

        console.log(channel, message);
    });