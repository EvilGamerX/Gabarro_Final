<?php
	if(isset($_REQUEST['name']))
		$name = $_REQUEST['name'];
	echo $name."<br>";
	if(isset($_REQUEST['email']))
		$email = $_REQUEST['email'];
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
			echo "about to create newuser<br>";
			$newuser = array('username'=>$name, 'email'=>$email, 'password'=>$password, 'notif_pref'=>0, 'salt'=>$random_salt, 'access'=>0, 'muted'=>0, "uid"=>$absmax);
			echo "about to insert newuser into collection";
			$collection->insert($newuser);
		
		echo "<br><br><br><center><h1>Welcome to the site, " . $name . "</h1></center>";
		echo "<center><h3>Thanks for signing in with Google.  Feel free to browse the site's features!</h3></center>";
	}
	
	else if($exists == 1)
	{
		foreach($cursor as $doc)
		{
			if($email == $doc['email'])
			{
				$goodlogin = 1;
				echo $_SESSION['username']=$doc['username'];
				echo $_SESSION['email']=$doc['email'];
				echo $_SESSION['access']=$doc['access'];
				echo $_SESSION['uid']=$doc['uid'];
				echo $_SESSION['muted']=$doc['muted'];
				header("location: ?page=browse");
			}
		}
	}
	
	echo "you shouldn't be here";
?>