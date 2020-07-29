// #!/usr/bin/env node

var socket  = require( 'socket.io' );
var express = require('express');
var app     = express();
// var fs = require('fs');
// var privateKey  = fs.readFileSync('/etc/apache2/ssl/bkr.key', 'utf8');
// var certificate = fs.readFileSync('/etc/apache2/ssl/bkr.crt', 'utf8');
// var ca 			= fs.readFileSync('/etc/apache2/ssl/bkr.pem')
// var credentials = {key: privateKey, cert: certificate, ca: ca, agent: false, 
// requestCert: true,
// rejectUnauthorized: false};

var server  = require('http').createServer(app);
var io      = socket.listen( server );
var port    = process.env.PORT || 3000;

server.listen(port, function () {
  console.log('Server listening at port %d', port);
});
// io.set('origin not allowed', false);
// io.origins((origin, callback) => {
  // if (origin !== 'http://www.anugerahperdana.id') {
    // return callback('origin not allowed', false);
  // }
  // callback(null, true);
// });
io.on('connection', function(socket) {
    socket.on('new_activity', function(data) {
        io.sockets.emit('new_activity', {
            totalActivity: data.totalActivity,
            fidMsOperatorAssigned: data.fidMsOperatorAssigned,
            callsound: data.callsound
        });
    });
});