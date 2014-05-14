<?php
	$name = $_GET['name'];
	echo $name."<br>";
	$email = $_GET['email'];
	echo $email."<br>";
	
	//mongo stuff
	$collection = $mdb->selectCollection("users");
	$cursor = $collection->find();
	$exists = 0;
	foreach($cursor as $doc)
	{
		if($doc['email'] == $email)
		{
			$exists++;
			break;
		}
	}
	if($exists == 0) //email not in db
	{
		//create new user
		$echo "BLEEP BLOOP";
	}
	//=================
	
	/*$userQuery = array('email'=>$email);
	$cursor = $collection->find($userQuery);
	$counter = 0;*/
	
	if($exists == 1)
	{
		foreach($cursor as $doc)
		{
			echo $pass . "<br>";
			$pass = hash('sha512', $pass . $doc['salt']);
			echo $pass . "<br>";
			echo $doc['password'] . "<br>";
			if($pass == $doc['password'])
			{
				echo "Wow you're great";
				$goodlogin = 1;
				$_SESSION['username']=$doc['username'];
				$_SESSION['email']=$doc['email'];
				$_SESSION['access']=$doc['access'];
				$_SESSION['uid']=$doc['_id'];
				$_SESSION['muted']=$doc['muted'];
			}
		}
	}
?>