<?php

if (isset($_GET['secret_game_id_pass']))
{
	if(isset($_GET['toggle']))
	{
	$usrid = $_SESSION['uid'];
	$gameid = $_GET['secret_game_id_pass'];
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


	$game = $_GET['secret_game_id_pass'];
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

	echo "<img id='game_image' src=\"" . $gameinfo['image'] . "\" alt='$game' style='float:middle' /><br/>";
	echo "<a href=\"" . $gameinfo['amazon'] . "\" align='middle'>Buy this game on Amazon!</a>";
	echo "</section>";

	if(isset($_SESSION['uid']))
	{
		$usrid = $_SESSION['uid'];
		//$quer = "SELECT * FROM wishlist WHERE uID = " . $usrid . " AND gID = " . $game;
		//$res = $db->send_sql($quer);

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
		echo "<form id='wish1' action='' method='get' align='center'>
			<input type='hidden' name='page' value='game'>
			<input type='hidden' name='toggle' value='1'>
			<input type='hidden' name='secret_game_id_pass' value = '$game'>
		
			<input type='submit' value='Add to Wishlist'>
			</form>";
		}
		else
				echo "<form id='wish2' action='' method='get' align='center'>
			<input type='hidden' name='page' value='game'>
			<input type='hidden' name='toggle' value='0'>
			<input type='hidden' name='secret_game_id_pass' value = '$game'>
			<input type='submit' value='Remove from Wishlist'>
			</form>";
	}

	$quer = "SELECT * FROM game_review_table WHERE game_id='$game'";
	$ret = $db->send_sql($quer);
	if (mysql_num_rows($ret) != 0)
	{	// echo the reviews if any
		echo "<h3>Reviews</h3>";
		echo "<section id='game_reviews'>";

		// print result table
		echo "<div id=\"table_wrapper_review\">";
		echo "<div id=\"table_scroll_review\">";
		echo "<table border=0 align='center' width='60%'>";
		echo "<tbody>";
		
		// loop through all results
		while ($row = $db->next_row())
		{	echo "<tr><td>" . $row[2] . "</td>";
			echo "<td>" . $row[3] . "</td>";
			echo "<td>" . $row[4] . "</td></tr>";
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
		$quer_check = "SELECT * FROM game_review_table WHERE user_id='" . $uid . "' AND game_id='" . $game . "'";
		$check = $db->send_sql($quer_check);
		if (mysql_num_rows($check) == 0)
		{	// now to do the submit review section
			echo "<section id='submit_review' align='center'>";
			echo "<form action='' method='post'>";
			echo "<textarea name='prelim_review' rows='10' cols='100' maxlength='1000' required ></textarea>";
			echo "<input type='hidden' name='secret_game_id_pass' value'" . $game ."'/>";
			echo "<input type='hidden' name='page' value='game'></br>";
			echo "<input type='submit' name='submit' value='Submit Review' />";
			echo "</form>";
			echo "</section>";
		}
	}

	if ((isset($_GET['secret_game_id_pass'])) && (isset($_POST['prelim_review'])))
	{
	$sidp = $_GET['secret_game_id_pass'];
	$uid = $_SESSION['uid'];
	$prelim = $_POST['prelim_review'];
	//$curtime = date('Y-m-d H:i:s', time());

	$quer_submit = "INSERT INTO game_review_table (game_id, user_id, username, timestamp, review) VALUES (\"$sidp\", \"$uid\", \"$username\", CURRENT_TIMESTAMP, \"$prelim\")";
	$res = $db->send_sql($quer_submit);
	header("Location:#");
	}

echo "</section>";
}//end mysql_num_rows if statement

?>

<script>

function wishlist(toggle)
{

var mgID = $_GET[secret_game_id_pass'];
var muID = $_SESSION['uid']

if(toggle==1)
{
var quer = "INSERT INTO wishlist (uID, gID) VALUES (muID, mgID)";
}
else
{
var quer = "DELETE FROM wishlist WHERE uID = muID";
}



}

</script>
