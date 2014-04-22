

	<?php

	$goodlogin = 0;

	if(isset($_GET['log']))
	{

	$uname = strip_tags($_POST['username']);
	$pass = strip_tags($_POST['pass']);

	$quer = "SELECT * FROM user_info WHERE username=\"$uname\"";
	$res = $db->send_sql($quer);
	if(mysql_num_rows($res)==1)
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

	}


	}

	if(!$goodlogin)
	{

	?>

		<div id="page_data" align="center">
			<h2>Welcome to Side Stall!</h2><br/>
			<form method="post" action="?page=login&log=true">
			Username: <input type="text" name="username"><br/>
			Password: <input type="password" name="pass"><br/>
			<?php if(isset($_GET['log']) && $goodlogin == 0) echo "<font color=\"red\">Incorrect Username or Password</font><br>" ?>
			<input type="submit" value="Log In">
			</form>
			<br/>
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