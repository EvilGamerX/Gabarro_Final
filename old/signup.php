

		<?php

		$goodreg=false;
		$gooduser=false;
		$goodemail=false;
		$goodpass=false;
		$goodreentry=false;
		$regattempt=false;
		if(isset($_POST['username']))
		{
		$regattempt=true;

		$uname=strip_tags($_POST['username']);
		$quer = "SELECT * FROM user_info WHERE username = \"$uname\"";
		//$quer2 = "INSERT INTO user_info (username, password) VALUES (\"Mucus\", \"Man\")";
		$res = $db->send_sql($quer);
		if(strlen($uname)>=4 && ctype_alnum($uname)==true && mysql_num_rows($res)==0)
			$gooduser=true;

		$email=strip_tags($_POST['useremail']);
		if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$goodemail=true;
		}

		$pass=strip_tags($_POST['userpass']);
		if(strlen($pass)>=6)
			$goodpass=true;

		if($pass==strip_tags($_POST['userpassconf']) && $goodpass)
			$goodreentry=true;
		$notifpref=$_POST['pref'];

		if($gooduser && $goodemail && $goodpass && $goodreentry)
			$goodreg=true;
		}

		if($goodreg==true)
		{

		$quer = "SELECT * FROM user_info WHERE username = \"$uname\"";
		$res = $db->send_sql($quer);
		if(mysql_num_rows($res)==0)
			{
			$random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
			$password = hash('sha512', $pass . $random_salt);
			$quer = "INSERT INTO user_info (username, email, password, notif_pref, salt, access, muted) VALUES ('$uname', '$email', '$password', '$notifpref', '$random_salt', 0, 0)";
			$res = $db->send_sql($quer);
			}
		echo "<br><br><br><center><h1>Welcome to the site, " . $uname . "</h1></center>";
		echo "<center><h3>Feel free to <a href=\"?page=login\">log in</a>, and browse the site's features!</h3></center>";
		}
		else
		{
		?>




		<div id="page_data" align="center">
			<h2>Welcome to Side Stall!</h2><br/>
			<h4>Create An Account</h4>
			Already have an account? <a href="?page=login">Log In</a><br><br>
			<form method="post" action="?page=signup&reg=true">
			Enter your desired username: <input type="text" name="username" <?php if(isset($uname)) echo "value=\"$uname\""; ?>><br/>
			<?php if(!$goodreg && !$gooduser && $regattempt) echo "<font color=\"red\">Username must be unique, 4 or more characters long, and contain only letters and numbers.</font><br/>"; ?>
			Enter a valid email address: <input type="text" name="useremail" <?php if(isset($email)) echo "value=\"$email\""; ?>><br/>
			<?php if(!$goodreg && !$goodemail && $regattempt) echo "<font color=\"red\">That email address is invalid or taken. Please try a new one.</font><br/>"; ?>
			Enter your password: <input type="password" name="userpass" <?php if(isset($pass)) echo "value=\"$pass\""; ?>><br/>
			<?php if(!$goodreg && !$goodpass && $regattempt) echo "<font color=\"red\">Password must be 6 characters or longer.</font><br/>"; ?>
			Please re-enter your password: <input type="password" name="userpassconf"><br/>
			<?php if(!$goodreg && !$goodreentry && $regattempt) echo "<font color=\"red\">Please re-enter password again.</font><br/>"; ?>
			<br/><br/>
			Notification Preference: <br/>
			<input type="radio" name="pref" value="0" checked="true">On Site<br/>
			<input type="radio" name="pref" value="1">Email
			<br/><br/>
			<input type="submit" value="Sign me up!">
			</form>
			<br/>
		</div>

<?php
}
?>



