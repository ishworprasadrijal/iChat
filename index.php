<!DOCTYPE html>
<html lang="en">
<head>
  <title>iChat</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="keywords" content="simple chat using pubnub and bootstrap">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <style type="text/css">
  	.sender{

  	}
  </style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>iChat</h2>
  <p>
  	iChat is a simple chat app using pubnub and bootstrap. It uses bootstrap3.4.0 and pubnub. This application uses a demo channel of pubnub and broadcast the message to all online users with the demo channel. This is a one page app. Which doesnot need to install anything like (xampp, wamp, lamp, etc.). Any device that can open html file and is online can access the brodacast message. This is not a huge app but would be very helpful for getting started with chat applications.
  </p>
  	Enter Chat and press enter
	<div><textarea id=input placeholder=you-chat-here cols="20" rows="5" class="form-control"></textarea></div>
	<input type="hidden" id="person" value="Computer"/>
  <br>
  
  <!-- Left-aligned media object -->
  	<div class="row" id="cw">
	  <div class="media box first alert alert-light" style="display: none;">
	    <div class="media-left">
	      <img src="1.png" class="media-object" style="width:60px">
	    </div>
	    <div class="media-body">
	      <h4 class="user media-heading">Sent</h4>
	      <p class="mb"></p>
	      <em>Received : </em><em class="time"></em>
	    </div>
	  </div>
	  <!-- right -->
	  <div class="media box last alert alert-info" style="display: none;">
	   <div class="media-body text-right">
	     <h4 class="user media-heading">Received</h4>
	     <p class="mb"></p>
	     <em>Sent : </em><em class="time"></em>
	   </div>
	   <div class="media-right">
	       <img src="2.jpg" class="media-object" style="width:60px">
	   </div>
	</div>
	</div>
  <hr>


</body>
</html>






<script src=http://cdn.pubnub.com/pubnub.min.js></script>
<script>(function(){
var pubnub = PUBNUB.init({publish_key:'demo',subscribe_key:'demo',ssl:true});
var cw = PUBNUB.$('cw'), channel='demo';
var person = PUBNUB.$('person'), channel='demo';
var time = new Date().toLocaleTimeString(), channel='demo';
pubnub.subscribe({
    channel  : channel,
    callback : function(text) {
    	appendMessage(text.text, text.person, text.time);
    }
});
PUBNUB.bind( 'keyup', input, function(e) {
    (e.keyCode || e.charCode) === 13 && pubnub.publish({
        channel : channel, 
        message : { 
        	text : input.value,
        	person : person.value,
        	time : time,
        }
    })
})
})()</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
</script>
<script type="text/javascript">
	$(document).ready(function(){

		var person = prompt("Please enter your name", "");
		if (person == null) $('.container').html('<div class="alert alert-danger"> Permission Denied. Please Reload and re Enter who you are </div>');
		if(person != null){
			$('#person').val(person);
		}
	})
	function appendMessage(message,_person,time){
		if($('#person').val() == _person){
			var media = $('#cw .last');
		}else{
			var media = $('#cw .first');
		}
		var cln = media.clone(true);
		$('#cw').prepend(cln);
		$(cln).show();
		$(cln).addClass('alert alert-success');
		setTimeout(function(){ $(cln).removeClass('alert-success first last'); 	}, 3000);
		$(cln).find('.mb').html(message);
		$(cln).find('.user').html(_person);
		$(cln).find('.time').html(time);
		$(document).find('textarea').val('');
	}
</script>