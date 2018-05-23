var najax = $ = require('najax');
var nodemailer = require('nodemailer');
var minutes = 5, the_interval = minutes * 60 * 1000;

var transporter = nodemailer.createTransport({
	service: 'gmail',
	auth: {
		user: 'm.faiznoeris@gmail.com',
		pass: 'mynameisroccat7'
	}
});

var mailOptions = {
	from: 'm.faiznoeris@gmail.com',
	to: 'faiznoeris@rocketmail.com',
	subject: 'Sending Email using Node.js',
	text: 'Something went wrong! go check it'
};

function sendmail(){
	transporter.sendMail(mailOptions, function(error, info){
		if (error) {
			console.log(error);
		} else {
			console.log('Email sent: ' + info.response);
		}
	});
}


setInterval(function() {
  // console.log("I am doing my 5 minutes check");
  najax({
  	// url: 'http://marketplace-kombas.com/Ajax/testnodejs/',
  	url: 'http://marketplace-kombas.com/Ajax/cekresi',
  	type: 'GET',
  	dataType: 'json',
  	success: function (data) {
  		if (data.success) {
  			console.log("OK");
  		}else{
  			// console.log("BAD");
  			sendmail();
  		}
  	}
  })
  // do your stuff here
}, 5000);
