
		<div id="page_data" align="center" >

			<?php

			if(isset($_POST['userSearch']))
			{
			$user = strip_tags($_POST['userSearch']);
			$quer = "SELECT username FROM user_info WHERE username=\"$user\"";
			$res = $db->send_sql($quer);
			if(mysql_num_rows($res) == 1)
			{
				if(isset($_POST['delete']))
				{
				$quer = "DELETE FROM user_info WHERE username=\"$user\"";
				$res = $db->send_sql($quer);
				echo "$user has been deleted from the system.";
				}
				else if(isset($_POST['ban']))
				{
					$time = time() + (365000*24*60*60);
					$quer = "UPDATE user_info SET muted=\"$time\" WHERE username=\"$user\"";
					$res = $db->send_sql($quer);
					echo "$user has been banned.";
				}
				else if(isset($_POST['mute']))
				{
					$time = time() + (3*24*60*60);
					$quer = "UPDATE user_info SET muted=\"$time\" WHERE username=\"$user\"";
					$res = $db->send_sql($quer);
					echo "$user has been muted for 3 days.";
				}
				else if(isset($_POST['unban']) || isset($_POST['unmute']))
				{
					$time = time();
					$quer = "UPDATE user_info SET muted=\"$time\" WHERE username=\"$user\"";
					$res = $db->send_sql($quer);
					echo "$user may now post on forums.";
				}

			}
			else
				echo "User not found";
			}

			if(isset($_SESSION['access']) && $_SESSION['access']==1)
			{
			?>

			<h2>Admin Panel. Feel the power!</h2>
			<br/>
			<h4>User Account Controls</h4>
			<form action="" method="post">
			<input type="text" name="userSearch" placeholder="Enter a username">

			<br>
			<input type="submit" name="mute" value="Mute">
			<input type="submit" name="unmute" value="Unmute">
			<input type="submit" name="ban" value="Ban">
			<input type="submit" name="unban" value="Unban">
			<input type="submit" name="delete" value="Delete">
			<input type="hidden" name="page" value="admin">

			</form>
			<br/>
			<p>Administrator powers also include thread and comment controls! However, they are only available at the thread's page.</p>

			<?php
			}
			else
				echo "You are not authorized to view this page. Begone.";
			?>
		</div>
