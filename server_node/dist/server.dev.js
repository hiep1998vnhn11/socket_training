"use strict";

var io = require('socket.io')(6001);

console.log('Connected to port 6001');
io.on('error', function (socket) {
  console.log('error');
});
io.on('connection', function (socket) {
  console.log('A client ' + socket.id + 'just connected to Server ...');
});

var Redis = require('ioredis');

var redis = new Redis(6379);
redis.psubscribe("*", function (error, count) {
  console.log(error);
  console.log(count);
});
redis.on('pmessage', function (partner, channel, message) {
  console.log(channel);
  console.log(message);
  console.log(partner);
  message = JSON.parse(message);
  io.emit(channel + ":" + message.event, message.data.chats);
  console.log('Sent');
});