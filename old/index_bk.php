<!DOCTYPE html>
<?php
session_start();
require_once("functions/db_functions.php");
$lkid = connect();

?>
<html>
	<!--This header information will be included in each file of the website-->	
	<head>
		<link rel="stylesheet" type="text/css" href="./style/sidestall.css">
		<meta charset="utf-8" />
		<title>Sidestall - Video Game Recommendations</title>
		<meta name="author" content="TJ Hoplock" >
		<meta name="description" content="Browse and get recommendations on current and future release video games!">
		<!--If they're actually still clinging to old versions of IE, facepalm hard and open script to handle shitty browsers-->		
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>
	<body>
		<!-- Navigation bar at the top of the page-->
		<header>
			<nav>
				<a id="logo" href="?page=sidestall">
						<img src="images/logo.png" alt="Side Stall Video Game Suggestions Homepage"
							width="280" class="logo">
				</a>
				<ul>
					<li><form id="search_bar" action="" method="get">
							<input type="text" name="search" placeholder="Search for a game">
							<input type="hidden" name="page" value="browse">
								<input type="submit" value="Go"></form>
					</li>
					<li><a href="?page=browse">Browse</a></li>
					<li><a href="?page=forums">Forums</a></li>
					<?php if (isset($_SESSION['username']))
					{
						echo "<li><a href=\"?page=accountsettings\">Account</a></li>";
						echo "<li><a href=\"functions/logout.php\">Log Out</a></li>";
						}
					else
						echo "<li><a href=\"?page=login\">Log In / Sign Up</a></li>"; ?>
					
				</ul>
			</nav>
		</header>
	
		<!--All other page data will be loaded into the remainder of the page-->
		<?php
			if(isset($_REQUEST['page']))
				include $_REQUEST['page'] . ".php";
			else
				include "sidestall.php";
		?>
	</body>
</html>

