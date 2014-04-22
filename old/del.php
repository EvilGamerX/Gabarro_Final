<?php

	if(isset($_GET['pid']) && isset($_GET['t']) && isset($_GET['td']) && isset($_GET['sf']))
	{
		$pid = $_GET['pid'];
		$t= $_GET['t'];
		$td = $_GET['td'];
		$sf = $_GET['sf'];

		if($td)
		{
			//echo "a";
			$db->send_sql("DELETE FROM posts WHERE topic_id=".$t.";");
			$db->send_sql("DELETE FROM topics WHERE topic_id=".$t.";");
			
			header("Location:?page=forums&sf=".$sf);
		}else
		{
			//echo "b";
			$db->send_sql("DELETE FROM posts WHERE post_id=".$pid.";");
			header("Location:?page=forums&t=".$t);
		}
		//echo "c";
	}
	//echo "d";
?>