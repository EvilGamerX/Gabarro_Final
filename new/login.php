<?php

	$goodlogin = 0;

	if(isset($_GET['log']))
	{

		$uname = strip_tags($_POST['username']);
		$pass = strip_tags($_POST['pass']);

		//$quer = "SELECT * FROM user_info WHERE username=\"$uname\"";
		//$res = $db->send_sql($quer);
		/*if(mysql_num_rows($res)==1)
		{
		$res = mysql_fetch_assoc($res);
		$pass = hash('sha512', $pass . $res['salt']);
		if($pass == $res['password'])
		{
		$goodlogin = 1;
		$_SESSION['username']=$res['username'];
		$_SESSION['email']=$res['email'];
		$_SESSION['access']=$res['access'];
		$_SESSION['uid']=$res['id'];
		$_SESSION['muted']=$res['muted'];
		}

		}*/
		$collection = $mdb->selectCollection('users');
		$userQuery = array('username'=>$uname);
		$cursor = $collection->find($userQuery);
		$counter = 0;
			foreach($cursor as $doc)
			{
				$counter++;
			}
		if($counter==1)
			{
			foreach($cursor as $doc)
			{
			echo $pass . "<br>";
			$pass = hash('sha512', $pass . $doc['salt']);
			echo $pass . "<br>";
			echo $doc['password'] . "<br>";
			if($pass == $doc['password'])
				{
				$goodlogin = 1;
				$_SESSION['username']=$doc['username'];
				$_SESSION['email']=$doc['email'];
				$_SESSION['access']=$doc['access'];
				$_SESSION['uid']=$doc['uid'];
				$_SESSION['muted']=$doc['muted'];
				}
			}
			}
		/*if(!$cursor)
			echo "Fuck you.";
		else
			{
			foreach($cursor as $doc)
				echo(var_dump($doc));
			}*/

	}
	
	if(!$goodlogin)
	{
?>
	<div id="page_data" align="center">
	<div class="well">
			<h2>Welcome to Side Stall!</h2>
	</div>
		<form method="post" action="?page=login&log=true">
		<!--<div class="input-group">
			<span class="input-group-addon">Username</span>
			<input type="text" name="username" class="form-control">
		</div>
		Username: <input type="text" name="username"><br/>
		Password: <input type="password" name="pass"><br/>
		<?php if(isset($_GET['log']) && $goodlogin == 0) echo "<font color=\"red\">Incorrect Username or Password</font><br>" ?>
		<button class="btn" type="submit" value="Log In"><b>Log In</b></button>
		</form>
		<br/>
		Don't have an account? <a href="?page=signup">Sign Up</a>
	</div>-->
	<div class="container">
		<form class="form-signin">
			<h2 class="form-signin-heading">Please sign in!</h2>
			<input type="text" class="input-block-level" name="username" placeholder="Username">
			<input type="password" class="input-block-level" name="pass" placeholder="Password"><br/>
			<?php if(isset($_GET['log']) && $goodlogin == 0) echo "<font color=\"red\">Incorrect Username or Password</font><br>" ?>
			<br>
			<button class="btn btn-large btn-primary" type="submit">Sign in</button>
		</form><br/>
		
		Don't have an account? <a href="?page=signup">Sign Up</a>
			

		<!--span id="signinButton">
		  <span
		   class="g-signin"
		   data-callback="signinCallback"
		   data-clientid="315155486850-n914vts3enlr0d1clc0le9npa29aukpk.apps.googleusercontent.com"
		   data-cookiepolicy="single_host_origin"
		   data-scope="profile">
		  </span>
		</span-->

		<div id="signin-button" class="show">
			<div class="g-signin"
			data-callback="loginFinishedCallback"
			data-approvalprompt="force"
			data-clientid="315155486850-n914vts3enlr0d1clc0le9npa29aukpk.apps.googleusercontent.com"
			data-scope="https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/plus.profile.emails.read"
			data-height="short"
			data-cookiepolicy="single_host_origin"
			>
		</div>
		<!-- In most cases, you don't want to use approvalprompt=force. Specified
		here to facilitate the demo.-->
		</div>

		<div id="profile" class="hide">
		<div>
		  <span id="pic"></span>
		  <span id="name"></span>
		</div>

		<div id="email"></div>
		</div>
	</div> 
<?php
	}
	else
	{
		//echo "<center><h1>Welcome back to sidestall, " . $_SESSION['username'] . "!</h1></center>";
		header("location: ?page=browse");
	}
?>
		
<script type="text/javascript">
/**
* Global variables to hold the profile and email data.
*/
var profile, email;

/*
* Triggered when the user accepts the sign in, cancels, or closes the
* authorization dialog.
*/
function loginFinishedCallback(authResult) {
	if (authResult) {
	  if (authResult['error'] == undefined){
		toggleElement('signin-button'); // Hide the sign-in button after successfully signing in the user.
		gapi.client.load('plus','v1', loadProfile);  // Trigger request to get the email address.
	  } else {
		console.log('An error occurred');
	  }
	} else {
	  console.log('Empty authResult');  // Something went wrong
	}
}

/**
* Uses the JavaScript API to request the user's profile, which includes
* their basic information. When the plus.profile.emails.read scope is
* requested, the response will also include the user's primary email address
* and any other email addresses that the user made public.
*/
function loadProfile(){
	//window.location = "?page=login_google";
	var request = gapi.client.plus.people.get( {'userId' : 'me'} );
	request.execute(loadProfileCallback);
}

/**
* Callback for the asynchronous request to the people.get method. The profile
* and email are set to global variables. Triggers the user's basic profile
* to display when called.
*/
function loadProfileCallback(obj) {
	profile = obj;

	// Filter the emails object to find the user's primary account, which might
	// not always be the first in the array. The filter() method supports IE9+.
	email = obj['emails'].filter(function(v) {
		return v.type === 'account'; // Filter out the primary email
	})[0].value; // get the email from the filtered results, should always be defined.
	window.location = "./?page=login_google&name="+profile['displayName']+"&email="+email;
	displayProfile(profile);
	alert("This shouldn't happen");
}

/**
* Display the user's basic profile information from the profile object.
*/
function displayProfile(profile){
	document.getElementById('name').innerHTML = profile['displayName'];
	document.getElementById('pic').innerHTML = '<img src="' + profile['image']['url'] + '" />';
	document.getElementById('email').innerHTML = email;
	toggleElement('profile');
}

/**
* Utility function to show or hide elements by their IDs.
*/
function toggleElement(id) {
	var el = document.getElementById(id);
	if (el.getAttribute('class') == 'hide') {
	  el.setAttribute('class', 'show');
	} else {
	  el.setAttribute('class', 'hide');
	}
	setSessionData();
}

function setSessionData(){
	/*$.ajax(
	{
		type:'POST',
		url:'login_google',
		data:
	});*/
}
</script>
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<script src="https://apis.google.com/js/client:plusone.js" type="text/javascript"></script>