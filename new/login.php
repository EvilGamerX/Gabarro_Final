

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
			//echo($doc['password']);
			echo $doc['password'] . "<br>";
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
    </div> 
		<?php
		}
		else
		{
		//echo "<center><h1>Welcome back to sidestall, " . $_SESSION['username'] . "!</h1></center>";
		header("location: ?page=browse");
		}


		?>