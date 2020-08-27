"use strict";

var PORT = 6002;

var io = require('socket.io')(PORT);

console.log("Connected to port ".concat(PORT));
io.on('error', function (socket) {
  console.log('error');
});
io.on('connection', function (socket) {
  console.log('A client ' + socket.id + 'just connected to Server ...');
  socket.on('chatMessage', function (msg) {
    io.emit('message', msg);
  });
  socket.on('sentMessage', function (data) {
    io.emit('receivedMessage', data);
    console.log("Sent message ".concat(data, " to client!"));
  });
}); // var Redis = require('ioredis')
// var redis = new Redis(6379)
// redis.psubscribe("*", function( error, count){
//     console.log(error)
//     console.log(count)
// })
// redis.on('pmessage', function(partner, channel, message){
//     console.log(channel)
//     console.log(message)
//     console.log(partner)
//     message = JSON.parse(message)
//     io.emit(channel + ":" + message.event, message.data.chats)
//     console.log('Sent')
// })