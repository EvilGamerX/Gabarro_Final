

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
			echo "Wow you're great";
			$goodlogin = 1;
			$_SESSION['username']=$doc['username'];
			$_SESSION['email']=$doc['email'];
			$_SESSION['access']=$doc['access'];
			$_SESSION['uid']=$doc['_id'];
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
			

    <span id="signinButton">
      <span
       class="g-signin"
       data-callback="signinCallback"
       data-clientid="315155486850-n914vts3enlr0d1clc0le9npa29aukpk.apps.googleusercontent.com"
       data-cookiepolicy="single_host_origin"
       data-scope="profile">
      </span>
    </span>


    </div> 
		<?php
		}
		else
		{
		//echo "<center><h1>Welcome back to sidestall, " . $_SESSION['username'] . "!</h1></center>";
		header("location: ?page=browse");
		}


		?>
		
		 <script type="text/javascript"> (function() { var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true; po.src = 'https://apis.google.com/js/client:plusone.js'; var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s); })(); </script>
		 
		 <script type="text/javascript">
			

    function signinCallback(authResult) {
      if (authResult['status']['signed_in']) {
        // Update the app to reflect a signed in user
        // Hide the sign-in button now that the user is authorized, for example:
        document.getElementById('signinButton').setAttribute('style', 'display: none');
            alert("You did it!");
            console.log("great jorb");
      } else {
        // Update the app to reflect a signed out user
        // Possible error values:
        //   "user_signed_out" - User is signed-out
        //   "access_denied" - User denied access to your app
        //   "immediate_failed" - Could not automatically log in the user
            alert("You goofed :(");
            console.log("fuckin' shit");
        console.log('Sign-in state: ' + authResult['error']);
      }
    }

 </script>