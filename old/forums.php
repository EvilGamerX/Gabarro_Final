<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

<script>
function updateCountdown() {

    var remaining = 1000 - jQuery('.message').val().length;
    jQuery('.countdown').html('<br/>' + remaining + ' characters remaining.');
}

jQuery(document).ready(function($) {
    updateCountdown();
    $('.message').change(updateCountdown);
    $('.message').keyup(updateCountdown);
});


</script>

<?php

	$f = "0";
	$sf = "0";
	$t = "0";
	$uid = 0;

	if(isset($_SESSION['uid']))
	{
		$uid = $_SESSION['uid'];
	}


	if(isset($_GET['t']))
	{
		$t = $_GET['t'];
		$t = addslashes(strip_tags(str_replace(';', '\;', $t)));

		if(isset($_POST['new_post']))
		{
			$msg = addslashes(strip_tags(str_replace(';', '\;',$_POST['new_post'])));
			$db->send_sql("INSERT INTO posts(user_id, topic_id, post_data) VALUES (\"$uid\", \"$t\", \"$msg\");");
		}

		disp_posts($t, $db);

	}else if(isset($_GET["sf"]))
	{
		$sf = $_GET['sf'];
		$sf = addslashes(strip_tags(str_replace(';', '\;', $sf)));
		disp_topics($sf, $db);

	}else if(isset($_GET['f']))
	{
		$f = $_GET['f'];
		$f = addslashes(strip_tags(str_replace(';', '\;', $f)));
		disp_forums($f, $db);

	}else
	{
		disp_forums(0, $db);

	}

	function disp_posts($topic_id, $db)
	{
		$posts = $db->send_sql("SELECT * FROM posts WHERE topic_id='$topic_id' ORDER BY post_id;");

		$title = $db->send_sql("SELECT topic_title, sub_forum_id FROM topics WHERE topic_id='$topic_id';");

		if(mysql_num_rows($title) > 0)
		{
			$title = mysql_fetch_assoc($title);
		}else
		{
			echo "<h1 align=\"center\">Invalid Topic</h1>";
			exit(0);
		}


		echo "<h2>".$title['topic_title']."</h2>

		<div id=\"posts\">
			<table border=\"1\" align=\"center\">";

		$first = 1;

		while($res = mysql_fetch_assoc($posts))
		{
			$usr = mysql_fetch_assoc($db->send_sql("SELECT username, id FROM user_info WHERE id=".$res['user_id'].";"));

			echo
				"<tr>
					<td align=\"center\" class=\"wrapword\">
					<b>".(isset($usr['username']) ? $usr['username'] : "DELETED")." said:</b>
					<br>".$res['post_data']."</td>";

			if(isset($_SESSION['uid']))
			{
				if($_SESSION['access'] && $first)
				{
					echo "<td><a href =\"?page=del&tid=".$res['post_id']."&pid=0&t=".$topic_id."&sf=".$title['sub_forum_id']."&td=1\" onclick=\"return confirm('Confirm Delete?')\">Delete</a>";
				}
				if((($usr['id'] == $_SESSION['uid']) || $_SESSION['access']) && !($first))
				{
					echo "<td><a href =\"?page=del&pid=".$res['post_id']."&t=".$topic_id."&sf=0&td=0\" onclick=\"return confirm('Confirm Delete?')\">Delete</a>";
				}
					echo "</tr>";
			}
			$first = 0;
		}
		echo "</table>
		</div>";

		if((isset($_SESSION['uid'])) && ($_SESSION['muted']  < time()))
		{
			echo
				"<div id=\"reply\" align=\"center\">
					<br>Reply to thread?<br>
					<form action=\"?page=forums&t=".$topic_id."\" method=\"post\">
					<textarea class=\"message\" name=\"new_post\" rows=\"5\" cols=\"50\" maxlength=\"1000\"></textarea>
					<span class=\"countdown\"></span>
					<br>

					<br>
					<input type=\"submit\" value=\"submit\">
				</div>";
		}
	}

	function disp_topics($sub_forum_id, $db)
	{
		$topics = $db->send_sql("SELECT * FROM topics WHERE sub_forum_id=".$sub_forum_id.";");

		echo "<div align=\"right\"><a href=\"?page=new_topic&sf=".$sub_forum_id."\">New Topic</a></div>";

		if(mysql_num_rows($topics) <= 0)
		{
			echo "<h1 align=\"center\">There doesn't seem to be anything here.</h1>";
			exit(0);
		}

		echo
		"<div id=\"forum_main\" class=\"main\">
			<table border=\"1\" width=\"100%\" align=\"center\" cellpadding=\"5\" cellspacing=\"1\">";

		while($res = mysql_fetch_assoc($topics))
		{
			echo "<tr>
					<td align=\"left\" colspan=\"3\"><a href=\"?page=forums&t=".$res['topic_id']."\">".$res['topic_title']."</td>
					<td align=\"left\" colspan=\"1\">".$res['topic_date']."</td>
				</tr>";
		}
		echo
			"</table>
		</div>";
	}

	function disp_forums($forum_id, $db)
	{
		if($forum_id)
		{
			$forums = $db->send_sql("SELECT * FROM sub_forums WHERE forum_id=".$forum_id.";");

			if(mysql_num_rows($forums) <= 0)
			{
				echo "<h1 align=\"center\">Invalid Forum</h1>";
				exit(0);
			}

			echo
			"<div id=\"forum_main\" class=\"main\">
				<table border=\"1\" width=\"100%\" align=\"center\" cellpadding=\"5\" cellspacing=\"1\">";

			while($res = mysql_fetch_assoc($forums))
			{
				echo "<tr>
						<td align=\"left\" colspan=\"3\"><a href=\"?page=forums&sf=".$res['sub_forum_id']."\">".$res['sub_forum_name']."</td>
						<td align=\"left\" colspan=\"1\">".$res['sub_forum_desc']."</td>
					</tr>";
			}
			echo
				"</table>
			</div>";
		}else
		{
			$forums = $db->send_sql("SELECT * FROM forums;");

			if(mysql_num_rows($forums) <= 0)
			{
				echo "<h1 align=\"center\">Invalid Forum</h1>";
				exit(0);
			}
			echo
				"<div id=\"forum_main\" class=\"main\">
					<table border=\"1\" width=\"100%\" align=\"center\" cellpadding=\"5\" cellspacing=\"1\">";

			while($res = mysql_fetch_assoc($forums))
			{
				echo "<tr>
						<td align=\"left\" colspan=\"3\"><a href=\"?page=forums&f=".$res['forum_id']."\">".$res['forum_name']."</td>
						<td align=\"left\" colspan=\"1\">".$res['forum_desc']."</td>
					</tr>";
			}
			echo
				"</table>
			</div>";
		}

	}

?>