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
	


	if(isset($_GET['t']))
	{
		$t = $_GET['t'];
		$t = addslashes(strip_tags(str_replace(';', '\;', $t)));

		if(isset($_POST['new_post']))
		{
			$msg = addslashes(strip_tags(str_replace(';', '\;',$_POST['new_post'])));
			if($msg=="")
				echo "";
			else
			{
			//$db->send_sql("INSERT INTO posts(user_id, topic_id, post_data) VALUES (\"$uid\", \"$t\", \"$msg\");");
			$collection = $mdb->selectCollection("posts");
			$mymax = $collection->find();
			$mymax->sort(array('pid'=>-1))->limit(1);
			$absmax = 0;
			foreach($mymax as $mmax)
			{
			$absmax = $mmax['pid'];
			}
			$absmax++;
			$pid = $absmax;
			$collection->insert(array("uid"=>$uid, "tid"=>$t, "pdata"=>$msg, "pid"=>$pid));
			}
		}

		disp_posts($t, $db, $mdb);

	}else if(isset($_GET["sf"]))
	{
		$sf = $_GET['sf'];
		$sf = addslashes(strip_tags(str_replace(';', '\;', $sf)));
		disp_topics($sf, $db, $mdb, $_SESSION['uid']);

	}else if(isset($_GET['f']))
	{
		$f = $_GET['f'];
		$f = addslashes(strip_tags(str_replace(';', '\;', $f)));
		disp_forums($f, $db, $mdb);

	}else
	{
		disp_forums(0, $db, $mdb);

	}
	}
else echo "<center><h2>Why don't you try logging in first?</h2></center>";

	function disp_posts($topic_id, $db, $mdb)
	{
		//$posts = $db->send_sql("SELECT * FROM posts WHERE topic_id='$topic_id' ORDER BY post_id;");

		//$title = $db->send_sql("SELECT topic_title, sub_forum_id FROM topics WHERE topic_id='$topic_id';");
		
		$collection = $mdb->selectCollection("posts");
		//$tQuery = array("tid"=>$topic_id);
		$posts = $collection->find();
		
		$collection = $mdb->selectCollection("topics");
		//$tquery = array("tid"=>$topic_id);
		$cursor = $collection->find();
		//echo $topic_id;
		foreach($cursor as $doc)
		{
		if($doc['tid'] == $topic_id)
		{
			$title = $doc['ttitle'];
			$sf = $doc['sfid'];
			}
		}

		if(!isset($title))
		{
			echo "<h1 align=\"center\">Invalid Topic</h1>";
			exit(0);
		}


		echo "<h2><center>".$title."</center></h2>

		<div id=\"posts\">
			<table class=\"table table-striped table-bordered\" border=\"1\" align=\"center\">";

		$first = 1;

		foreach($posts as $post)
		{
			if($post['tid'] == $topic_id)
			{
			
			//$usr = mysql_fetch_assoc($db->send_sql("SELECT username, id FROM user_info WHERE id=".$res['user_id'].";"));
			$uQuery = array("uid"=>$post['uid']);
			$collection = $mdb->selectCollection("users");
			$cursor = $collection->find();
			foreach($cursor as $doc)
			{
			if($doc['uid'] == $post['uid'])
				$usr = $doc['username'];
			}
			//echo $usr;
			
			echo
				"<tr>
					<td align=\"center\" class=\"wrapword\">
					<b>".(isset($usr) ? $usr : "DELETED")." said:</b>
					<br>".$post['pdata']."</td>";

			if(isset($_SESSION['uid']))
			{
				
				if($_SESSION['access'] && $first)
				{
					echo "<td><a href =\"?page=del&tid=".$post['pid']."&pid=0&t=".$topic_id."&sf=".$sf."&td=1\" onclick=\"return confirm('Confirm Delete?')\">Delete</a>";
				}
				if((($post['uid'] == $_SESSION['uid']) || $_SESSION['access']) && !($first))
				{
					echo "<td><a href =\"?page=del&pid=".$post['pid']."&t=".$topic_id."&sf=0&td=0\" onclick=\"return confirm('Confirm Delete?')\">Delete</a>";
				}
					echo "</tr>";
			}
			$first = 0;
			
			}
		
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


	function disp_topics($sub_forum_id, $db, $mdb, $uid)
	{
		//$topics = $db->send_sql("SELECT * FROM topics WHERE sub_forum_id=".$sub_forum_id.";");
		
		$collection = $mdb->selectCollection("users");
		$cursor = $collection->find();
		$time = time();
		$muted = false;
		foreach($cursor as $doc)
		{
			if($doc['uid'] == $uid)
				if($doc['muted'] > $time)
					$muted = true;
		}
		$collection = $mdb->selectCollection("topics");
		$topQuery = array("sfid"=>$sub_forum_id);
		$cursor = $collection->find($topQuery);
		$counter=0;
		if(!$muted)
			echo "<div align=\"right\"><a href=\"?page=new_topic&sf=".$sub_forum_id."\">New Topic</a></div>";
		else
			echo "<div align=\"right\"><a href=\"#\">You are muted!</a></div>";
		foreach($cursor as $doc)
		{
		$counter++;
		}

		if($counter <= 0)
		{
			echo "<h1 align=\"center\"><div class=\"alert alert-danger\">There are no posts in this forum yet.</div></h1>";
			exit(0);
		}

		echo
		"<div id=\"forum_main\" class=\"main\">
			<table class=\"table table-striped table-bordered\" border=\"1\" width=\"100%\" align=\"center\" cellpadding=\"5\" cellspacing=\"1\">";

		foreach($cursor as $doc)
		{
			echo "<tr>
					<td align=\"left\" colspan=\"3\"><a href=\"?page=forums&t=".$doc['tid']."\">".$doc['ttitle']."</td>
					<td align=\"left\" colspan=\"1\"></td>".//.$doc['tdate']."</td>
				"</tr>";
		}
		echo
			"</table>
		</div>";
	}

	function disp_forums($forum_id, $db, $mdb)
	{
		if($forum_id)
		{
			$collection = $mdb->selectCollection('subforums');
			//$forums = $db->send_sql("SELECT * FROM sub_forums WHERE forum_id=".$forum_id.";");
		

			$cursor = $collection->find();
			//echo $cursor;
			/*
			if(mysql_num_rows($forums) <= 0)
			{
				echo "<h1 align=\"center\">Invalid Forum</h1>";
				exit(0);
			}*/

			echo
			"<div id=\"forum_main\" class=\"main\">
				<table class=\"table table-striped table-bordered\" border=\"1\" width=\"100%\" align=\"center\" cellpadding=\"5\" cellspacing=\"1\">";

			foreach($cursor as $doc)
			{
					if($doc['fid'] == $forum_id)
						{
					echo "<tr>
						<td align=\"left\" colspan=\"3\"><a href=\"?page=forums&sf=".$doc['sfid']."\">".$doc['fname']."</td>
						<td align=\"left\" colspan=\"1\">".$doc['fdesc']."</td>
					</tr>";
					}
			}
		/*	while($res = mysql_fetch_assoc($forums))
			{
				echo "<tr>
						<td align=\"left\" colspan=\"3\"><a href=\"?page=forums&sf=".$res['sub_forum_id']."\">".$res['sub_forum_name']."</td>
						<td align=\"left\" colspan=\"1\">".$res['sub_forum_desc']."</td>
					</tr>";
			}*/
			echo
				"</table>
			</div>";
		}else
		{
			//$forums = $db->send_sql("SELECT * FROM forums;");
			$collection = $mdb->selectCollection('forums');
			$cursor = $collection->find();
			echo
				"<div id=\"forum_main\" class=\"main\">
					<table class=\"table table-striped table-bordered\" border=\"1\" width=\"100%\" align=\"center\" cellpadding=\"5\" cellspacing=\"1\">";

			foreach($cursor as $doc)
			{
				echo "<tr>
						<td align=\"left\" colspan=\"3\"><a href=\"?page=forums&f=".$doc['fid']."\">".$doc['fname']."</td>
						<td align=\"left\" colspan=\"1\">".$doc['fdesc']."</td>
					</tr>";			
			}
			/*if(mysql_num_rows($forums) <= 0)
			{
				echo "<h1 align=\"center\">Invalid Forum</h1>";
				exit(0);
			}*/


		/*	while($res = mysql_fetch_assoc($forums))
			{
				echo "<tr>
						<td align=\"left\" colspan=\"3\"><a href=\"?page=forums&f=".$res['forum_id']."\">".$res['forum_name']."</td>
						<td align=\"left\" colspan=\"1\">".$res['forum_desc']."</td>
					</tr>";
			}*/
			echo
				"</table>
			</div>";
		}

	}

?>