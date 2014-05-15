		<?php
		if(isset($_SESSION['username']))
		{
		$collection = $mdb->selectCollection('users');
		$newemail = false;
		$goodpass = false;
		$message="";
		$user = strip_tags($_SESSION['username']);
		//echo $user;
		if(isset($_GET['newemail']))
		{
		$email = strip_tags($_GET['newemail']);

		if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
			{
			$newemail=true;
			$newdata = array('$set'=>array('email'=>$email));
			//$quer = "UPDATE user_info SET email=\"$email\" WHERE username = \"$user\"";
			//$res = $db->send_sql($quer);
			$collection->update(array('username'=>$user), $newdata);
			$_SESSION['email'] = $email;
			}
		}

		}
		else if(isset($_GET['notific-pref']))
		{

		if($_GET['notific-pref'] == "onsite")
		{
	//	$quer = "UPDATE user_info SET notif_pref = 0 WHERE username = \"$user\"";
	//	$res = $db->send_sql($quer);
		$newdata = array('$set'=>array('notif_pref'=>0));
		$collection->update(array('username'=>$user), $newdata);
		}
		else
		{
	//	$quer = "UPDATE user_info SET notif_pref = 1 WHERE username = \"$user\"";
		//$res = $db->send_sql($quer);
		$newdata = array('$set'=>array('notif_pref'=>1));
		$collection->update(array('username'=>$user), $newdata);
		}

		}
		else if(isset($_POST['newpass']))
		{
			$newpass = strip_tags($_POST['newpass']);
			if(strlen($newpass)>=6)
			{
				if($newpass == strip_tags($_POST['newpassconf']))
				{
					$userQuery = array('username'=>$user);
					$cursor = $collection->find($userQuery);
					foreach($cursor as $doc)
					{
						$userpass = $doc['password'];
						$usersalt = $doc['salt'];
					}
				
					//$quer = "SELECT password, salt FROM user_info WHERE username=\"$user\"";
					//$res = $db->send_sql($quer);
					//$mypass = mysql_fetch_assoc($res);
					$trialpass = hash('sha512', $_POST['oldpass'] . $usersalt);
					if($trialpass == $userpass)
					{
						$goodpass = true;
						$newpass = hash('sha512', $newpass . $usersalt);
						//$quer = "UPDATE user_info SET password = \"$newpass\" WHERE username = \"$user\"";
						$newdata = array('$set'=>array('password'=>$newpass));
						$collection->update(array('username'=>$user), $newdata);
						$message = "Your password was successfully updated.";
						//$res = $db->send_sql($quer);
						}
					else
						$message = "Your current password was typed incorrectly.";
				}
				else
					$message = "Your re-typed password does not match your new password.";
			}
			else
				$message="Your password must be 6 or more characters long.";

		}
		else if(isset($_POST['deletepass']))
		{
					$userQuery = array('username'=>$user);
					$cursor = $collection->find($userQuery);
					foreach($cursor as $doc)
					{
						$userpass = $doc['password'];
						$usersalt = $doc['salt'];
					}
		$attemptedpass = hash('sha512', strip_tags($_POST['deletepass']) . $usersalt);
		if($attemptedpass == $userpass)
			{
				//$quer = "DELETE FROM user_info WHERE username = \"$user\"";
				//$res = $db->send_sql($quer);
				$collection->remove(array('username'=>$user));
				$message = "You should not see this because you are deleted.";
				header('location: functions/logout.php');
			}
		else
			$message="Your password was typed incorrectly.";
		}

		$userQuery = array('username'=>$user);
		$cursor = $collection->find($userQuery);
		foreach($cursor as $doc)
		{
			$pref=$doc['notif_pref'];
		}
		?>


		<div id="page-data" align="center">

		<h1>Account Settings</h1>

		<?php if($newemail == false && isset($_GET['newemail']))
				{
				echo "<font color=\"red\">Requested email address is invalid.</font><br><br>";
				}
				else //if(isset($_POST['newpass']))
					echo "<font color=\"red\">$message</font><br><br>";
				//echo $pref;
		?>
		
		<div class="well">

			<b>Username: </b><?php echo $_SESSION['username']; ?>

			<br><br>

			<b>Email: </b><?php echo $_SESSION['email']; ?>

			<br><br>

			<?php
			if($_SESSION['access']==1)
			{
			?>
			<a href="?page=admin">Administrator Page</a><br><br>
			<?php
			}
			?>
			
			<input type="submit" value="Change Email Address" onclick="display('emailchange')"></input><br><br>

			<div id="emailchange" style="display:none">

				<b>New Email Address: </b>

				<form action="" method="get">
				<input type="text" name="newemail"></input><input type="submit" value="Submit"></input>
				<input type="hidden" name="page" value="accountsettings">
				</form>
				<br>

			</div>

			<input type="submit" value="Notification Preferences" onclick="display('notificpref')"></input><br><br>

			<div id="notificpref" style="display:none">
				<form action="">
				<input type="radio" name="notific-pref" value="onsite" <?php if($pref==0) echo "checked=\"true\""?>>On-Site Only<br>
				<input type="radio" name="notific-pref" value="email" <?php if($pref==1) echo "checked=\"true\""?>>Email + On-site
				<br>
				<input type="hidden" name="page" value="accountsettings">
				<input type="submit" value="Submit">
				</form>
				<br>
			</div>

			<input type="submit" value="Change Password" onclick="display('passwordchange')"></input><br><br>

			<div id="passwordchange" style="display:none">

				<form action="" method="post">
				<b>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp       New Password: </b><input type="password" name="newpass"><br><br>
				<b>Confirm New Password: </b><input type="password" name="newpassconf">
				<br><br>
				<b>&nbsp &nbsp &nbsp &nbsp &nbsp Current Password: </b><input type="password" name="oldpass">
				<br>
				<input type="hidden" name="page" value="accountsettings">
				<input type="submit" value="Submit">
				</form>
				<br><br>

			</div>

			<input type="submit" value="Delete Account" onclick="display('deleteaccount')"></input>

			<div id="deleteaccount" style="display:none">
				<br>
				<b>Are you sure?</b><input type="submit" value="Yes" onclick="display('reallydeleteaccount')">
				<br>
				<div id="reallydeleteaccount" style="display:none">
					<b>Enter Password</b>
					<form action="" method="post">
					<input type="password" name="deletepass"><br>
					<input type="hidden" name="page" value="accountsettings">
					<input type="submit" value="Confirm">
					</form>
				</div>
			</div>

		<?php
		};
		if(isset($_SESSION['username']))
		{
		?>
			<hr>
			<div class="well"">
				<h2>WishList</h2>
				<div class="well well-small">
					<table border="0">
						<tr>

							<?php
							$usrid = $_SESSION['uid'];
							//$quer = "SELECT gID FROM wishlist WHERE uID = \"$usrid\"";
							//$res = $db->send_sql($quer);
							$collection = $mdb->selectCollection("wishlist");
							$cursor = $collection->find();
							foreach($cursor as $doc)
							{
								if($doc['uid'] == $usrid)
								{
									$gid = $doc['gid'];
									$collection2 = $mdb->selectCollection("game_table");
									$cursor2 = $collection2->find();
									foreach($cursor2 as $doc2)
									{
										if($doc2['gid'] == $gid)
										{
										$img = $doc2['image'];
										echo "<td><img src=\"$img\"></img></td>";
										}
									}
									//$quer = "SELECT name, image from game_table WHERE id = \"$gid\"";
									//$res2 = $db->send_sql($quer);
									/*$dat = mysql_fetch_assoc($res2);
									$img = $dat['image'];
									echo "<td><img src=\"$img\"></img></td>";*/
								}
							}
							?>

						</tr>
					</table>
				</div>
			</div>
		</div>
		<?php
		}
		?>

		</div>


<script>

function display(e){
	//if(e.checked)
	if(document.getElementById(e).style.display == "block")
		document.getElementById(e).style.display = "none";
	else
		document.getElementById(e).style.display = "block"

		}
</script>
