const bodyParser = require('body-parser');
const cors = require('cors');

var app = require('express')();
app.use(cors());
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({extended: false}));

var http = require('http').Server(app);
var io = require('socket.io')(http);
var socketIds = {};

app.get('/', function(req, res){
    res.sendFile(__dirname + '/index.html');
});

app.post('/message', verifyToken, (req, res) => {
    console.log('### [/message] >>');
    let o = req.body;
    let payload = {};
    payload = {
        sourceEmail: socketIds[o.source].email,
        targetEmail: o.target,
        message: o.message,
        date_created: o.date_created,
    };

    if(o.type == 'room') {
        io.emit('message', payload);
    } else {
        // io.to(socketIds[source]).emit('message', payload);
        // io.to(socketIds[target]).emit('message', payload);
    }
    res.send({ result: true } );
});

io.on('connection', function(socket){
    console.log('a user connected');

    socket.on('nouveau_client', function (params) {
        console.log('>>> [nouveau_client] >>>>');
        socketIds[params.token] = { socketId: socket.id, email: params['email'] };
    });
});

http.listen(3000, function(){
    console.log('listening on *:3000');
});


function verifyToken(req, res, next) {
    next()

}
