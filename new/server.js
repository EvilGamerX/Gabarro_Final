var app = require('express')(),
    server = require('http').createServer(app);

server.listen(52123);

app.get('/', function(req, res) {
  res.sendfile(__dirname + '/booties.html');
});

app.get('/client', function(req, res){
    res.sendfile(__dirname + '/client.html');
});

app.get('/admin', function(req, res){
    res.sendfile(__dirname + '/admin.html');
});

app.get('*', function(req, res){
  res.send(404);
});

var io = require('socket.io').listen(server);

io.sockets.on('connection', function(socket){
   socket.emit('ack', "Wow, much connect"); 
    
    socket.on('team1', function(msg){
        socket.broadcast.emit('team1', msg);
    });
    
    socket.on('score1', function(msg){
        socket.broadcast.emit('score1', msg);
    });
    
    socket.on('team2', function(msg){
        socket.broadcast.emit('team2', msg);
    });
    
    socket.on('score2', function(msg){
        socket.broadcast.emit('score2', msg);
    });
    
    socket.on('lineup1', function(msg){
        socket.broadcast.emit('lineup1', msg);
    });
    
    socket.on('lineup2', function(msg){
        socket.broadcast.emit('lineup2', msg);
    });
    
    socket.on('actions', function(msg){
        socket.broadcast.emit('actions', msg);
    });
});

