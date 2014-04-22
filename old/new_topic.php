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

	$sf = 0;
	$uid = 0;;

	if(isset($_SESSION['uid']))
	{
		$uid = $_SESSION['uid'];
	}

	if(isset($_GET['sf']))
	{
		$sf = $_GET['sf'];
	}else
	{
		echo "There seems to be a problem, please go back and try again.";
		exit(0);
	}

	if(isset($_POST['message']) && isset($_POST['title']))
	{
		echo "boop";
		$message = str_replace(";", "\;", addslashes(strip_tags($_POST['message'])));
		$title = str_replace(";", "\;", addslashes(strip_tags($_POST['title'])));
		$sql = "INSERT INTO topics(topic_title, sub_forum_id, user_id) VALUES (\"$title\", \"$sf\", \"$uid\");";
		$db->send_sql($sql);

		$tmp = "SELECT MAX(topic_id) AS max FROM topics;";
		$tmp = mysql_fetch_assoc($db->send_sql($tmp));
		$tid = $tmp['max'];

		$sql = "INSERT INTO posts(user_id, topic_id, post_data) VALUES (\"$uid\", \"$tid\", \"$message\");";

		$db->send_sql($sql);

		header("Location:?page=forums&t=".$tid);
	}else
	{

		echo "<div id=\"reply\" align=\"center\">";
		echo "<form action=\"?page=new_topic&sf=".$sf."\" method=\"post\">";
	    echo "<input type=\"text\" name=\"title\" size=\"90\" placeholder=\"Title\" required>";
	    echo
	   		"<br>
	   		<textarea class=\"message\" name=\"message\" rows=\"10\" cols=\"100\" maxlength=\"1000\" required></textarea>
	   <span class=\"countdown\"></span>
	   		<br>

	   		<br>
	   		<input type=\"submit\" value=\"submit\">
		</div>";
    	echo "</form>";
    }
?>