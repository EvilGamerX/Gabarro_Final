//var http = require('http');
//var url = require('url');
//var fsvar = require('fs');
var MongoClient = require('mongodb').MongoClient;
var app = require('express')();
var server = require('http').createServer(app);

server.listen(52123);

app.get('/', function(req, res) {
  res.sendfile(__dirname + '/index.html');
});

app.get('*', function(req, res){
  res.send(404);
});

/*fsvar.readFile('./index.html', function(err, html){
if(!err)
	homepage = html;
});

http.createServer(function (request, res)
{
	var getData = url.parse(request.url, true).query;
	var i;

		res.writeHead(200, {'Content-Type': 'text/html'});

			res.write(homepage);
			request.on('end', function()
			{
				MongoClient.connect("mongodb://localhost:27017/sidestall", function(err, db)
				{
					if(!err)
					{
				
						var collection = db.collection('forums');
						
						
						//collection.find().toArray(function(err, items) {
							//mydata = items;
							//set=1;
							//console.log(items[0]['name']);
							//});
						
					}
				});
			});
			
	  res.end();
	  
}).listen(52123, "localhost");*/
console.log('Server running at localhost:52123/');