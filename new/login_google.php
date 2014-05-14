<?php
	if(isset($_GET['name'])
		$name = $_GET['name'];
	echo $name."<br>";
	if(isset($_GET['email'])
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
		}
	}
	
	if($exists == 0) //email not in db
	{
		if($counter==0)
		{
			echo "about to create a new user in db<br>";
			$random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
			$password = hash('sha512', rand() . $random_salt);
			echo "about to do the mymax stuff<br>";
					$mymax = $collection->find();
					$mymax->sort(array('uid'=>-1))->limit(1);
					$absmax = 0;
					foreach($mymax as $mmax)
					{
						$absmax = $mmax['uid'];
					}
					$absmax++;
			echo "about to create $newuser<br>";
			$newuser = array('username'=>$uname, 'email'=>$email, 'password'=>$password, 'notif_pref'=>$notifpref, 'salt'=>$random_salt, 'access'=>0, 'muted'=>0, "uid"=>$absmax);
			echo "about to insert newuser into collection";
			$collection->insert($newuser);
		}
		echo "<br><br><br><center><h1>Welcome to the site, " . $uname . "</h1></center>";
		echo "<center><h3>Feel free to <a href=\"?page=login\">log in</a>, and browse the site's features!</h3></center>";
	}
	//=================
	
	/*$userQuery = array('email'=>$email);
	$cursor = $collection->find($userQuery);
	$counter = 0;*/
	
	else if($exists == 1)
	{
		foreach($cursor as $doc)
		{
			echo "Wow you're great";
			$goodlogin = 1;
			$_SESSION['username']=$doc['username'];
			$_SESSION['email']=$doc['email'];
			$_SESSION['access']=$doc['access'];
			$_SESSION['uid']=$doc['uid'];
			$_SESSION['muted']=$doc['muted'];
		}
	}
?>