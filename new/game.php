<?php

if (isset($_GET['gid']))
{
	if(isset($_GET['toggle']))
	{
	$usrid = $_SESSION['uid'];
	$gameid = $_GET['gid'];
	$collection = $mdb->selectCollection("wishlist");
	if($_GET['toggle']==1)
	{
		
		//$quer = "INSERT INTO wishlist (uID, gID) VALUES ($usrid, $gameid)";
		$collection->insert(array("uid"=>$usrid, "gid"=>$gameid));
	}
	else
		$collection->remove(array("uid"=>$usrid, "gid"=>$gameid));
		//$quer = "DELETE FROM wishlist WHERE uID = $usrid AND gID = $gameid";

	//$res = $db->send_sql($quer);
	}


	$game = $_GET['gid'];
	$collection = $mdb->selectCollection("game_table");
	$cursor = $collection->find();
	$gameinfo;
	foreach($cursor as $doc)
	{
	if($doc['gid'] == $game)
	{
		$gameinfo = $doc;
		break;
		}
	}
	$quer = "SELECT * FROM game_table WHERE id='$game'";
	$ret = $db->send_sql($quer);
	$results = $db->next_row();

	echo "<section id=\"game_page\">";

	// echo the game details part
	echo "<section id='game_details' align='center'>";
	echo "<div class='well'><h2 align='center'>" . $gameinfo['name'] . "</h2></div>";

	echo "<img id='game_image' src=\"" . $gameinfo['image'] . "\" alt='$game' width=\"300px\" style='float:middle' /><br/>";
	echo "<a href=\"" . $gameinfo['amazon'] . "\" align='middle'>Buy this game on Amazon!</a>";
	echo "</section>";

	if(isset($_SESSION['uid']))
	{
		$usrid = $_SESSION['uid'];

		$collection = $mdb->selectCollection("wishlist");
		$cursor = $collection->find();
		$onlist = false;
		foreach($cursor as $doc)
		{
			if($doc['gid'] == $game && $doc['uid'] == $usrid)
			{
			$onlist = true;
			}
		}
		if(!$onlist)
		{
		echo "<form id='wish1' action='#' method='get' align='center'>
			<input type='hidden' name='page' value='game'>
			<input type='hidden' name='toggle' value='1'>
			<input type='hidden' name='gid' value = '$game'>
		
			<input type='submit' value='Add to Wishlist'>
			</form>";
		}
		else
				echo "<form id='wish2' action='#' method='get' align='center'>
			<input type='hidden' name='page' value='game'>
			<input type='hidden' name='toggle' value='0'>
			<input type='hidden' name='gid' value = '$game'>
			<input type='submit' value='Remove from Wishlist'>
			</form>";
	}

	//$quer = "SELECT * FROM game_review_table WHERE game_id='$game'";
	//$ret = $db->send_sql($quer);
	$collection = $mdb->selectCollection("reviews");
	$counter = 0;
	$cursor = $collection->find();
	$ret=array();
	foreach($cursor as $doc)
	{
	if($doc['gid'] == $game)
	{
		$counter++;
		$ret[] = $doc;
	}
	}
	if ($counter != 0)
	{	// echo the reviews if any
		echo "<h3>Reviews</h3>";
		echo "<section id='game_reviews'>";

		// print result table
		echo "<div id=\"table_wrapper_review\">";
		echo "<div id=\"table_scroll_review\">";
		echo "<table border=0 align='center' width='60%'>";
		echo "<tbody>";
		
		// loop through all results
		foreach($ret as $row)
		{	echo "<tr><td>" . $row['username'] . "</td>";
			echo "<td>" . date("jS M, Y - h:i:s", $row['timestamp']) . "</td>";
			echo "<td>" . $row['review'] . "</td></tr>";
		}
		echo "</tbody>";
		echo "</table>";
		echo "</div>";
		echo "</div>";
		echo "</section>";
	}

	if (isset($_SESSION['uid']))
	{	$uid = $_SESSION['uid'];
		$username= $_SESSION['username'];
		$reviewed = false;
		//$quer_check = "SELECT * FROM game_review_table WHERE user_id='" . $uid . "' AND game_id='" . $game . "'";
		$cursor = $collection->find();
		foreach($cursor as $doc)
		{
		if($doc['uid'] == $uid && $doc['gid'] == $game)
		{
		$reviewed = true;
		break;
		}
		}
		//$check = $db->send_sql($quer_check);
		if (!$reviewed)
		{	// now to do the submit review section
			echo "<section id='submit_review' align='center'>";
			echo "<form action='#' method='post'>";
			echo "<textarea name='prelim_review' rows='10' cols='100' maxlength='1000' required ></textarea>";
			echo "<input type='hidden' name='gid' value'" . $game ."'/>";
			echo "<input type='hidden' name='page' value='game'></br>";
			echo "<input type='submit' name='submit' value='Submit Review' />";
			echo "</form>";
			echo "</section>";
		}
	}

	if ((isset($_GET['gid'])) && (isset($_POST['prelim_review'])))
	{
	$sidp = $_GET['gid'];
	$uid = $_SESSION['uid'];
	$prelim = $_POST['prelim_review'];
	//$curtime = date('Y-m-d H:i:s', time());
	$collection->insert(array("gid"=>$sidp, "uid"=>$uid, "username"=>$username, "timestamp"=>time(), "review"=>$prelim));
	//$quer_submit = "INSERT INTO game_review_table (game_id, user_id, username, timestamp, review) VALUES (\"$sidp\", \"$uid\", \"$username\", CURRENT_TIMESTAMP, \"$prelim\")";
	//$res = $db->send_sql($quer_submit);
	header("Location:#");
	}

echo "</section>";
}//end mysql_num_rows if statement

?>

<script>

function wishlist(toggle)
{

var mgID = $_GET[gid'];
var muID = $_SESSION['uid']
/*
if(toggle==1)
{
var quer = "INSERT INTO wishlist (uID, gID) VALUES (muID, mgID)";
}
else
{
var quer = "DELETE FROM wishlist WHERE uID = muID";
}*/



}

</script>
