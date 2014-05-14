<?php

	if(isset($_GET['pid']) && isset($_GET['t']) && isset($_GET['td']) && isset($_GET['sf']))
	{
		$pid = $_GET['pid'];
		$t= $_GET['t'];
		$td = $_GET['td'];
		$sf = $_GET['sf'];

		$collection = $mdb->selectCollection("posts");
		
		if($td)
		{
			//echo "a";
			$cursor = $collection->find();
			foreach($cursor as $doc)
			{
				if($doc['tid'] == $t)
					$collection->remove($doc);
			}
			//$collection->remove(array("tid"=>$t), array("justOne"=>false));
			//$db->send_sql("DELETE FROM posts WHERE topic_id=".$t.";");
			$collection = $mdb->selectCollection("topics");
			$cursor = $collection->find();
			foreach($cursor as $doc)
			{
				if($doc['tid'] == $t)
					$collection->remove($doc);
			}
			//$collection->remove(array("tid"=>$t), array("justOne"=>false));
			//$db->send_sql("DELETE FROM topics WHERE topic_id=".$t.";");
			
			header("Location:?page=forums&sf=".$sf);
		}else
		{
			//echo "b";
			$cursor = $collection->find();
			foreach($cursor as $doc)
			{
				if($doc['pid'] == $pid)
					$collection->remove($doc);
			}
			//$collection->remove(array("pid"=>$pid), array("justOne"=>true));
			//$db->send_sql("DELETE FROM posts WHERE post_id=".$pid.";");
			header("Location:?page=forums&t=".$t);
		}
		//echo "c";
	}
	//echo "d";
?>