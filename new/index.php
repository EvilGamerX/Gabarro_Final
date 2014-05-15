<!DOCTYPE HTML>
<?php
session_start();
include("functions/db_class.php");
$db = new database();
$db->setup("mgrinthal", "mattdamon", "localhost", "sidestall");
//$lkid = connect();
$m = new MongoClient();
$mdb = $m->sidestall;
?>
<html ng-app="plunker">

<head>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.slate.min.css" rel="stylesheet">
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="style/sidestall3.css" rel="stylesheet">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="http://code.angularjs.org/1.2.13/angular.js"></script>
    <!--script src="//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.11.0.js"></script-->
    <script src="javascript/carousel.js"></script>
</head>

<body>
	<div class="container">
		<nav class="navbar navbar-default" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle Navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				  <ul class="nav navbar-nav">
					<li><a class="navbar-brand" href="#">Sidestall</a></li>
					<li <?php if(isset($pg)) if($pg = "browse") echo "class='active'";?>><a href="?page=browse">Browse</a></li>
					<li><a href="?page=forums">Forums</a></li>
					<?php if (isset($_SESSION['username']))
				{
					$uname = $_SESSION['username'];
					echo "<li><a href=\"?page=accountsettings\">$uname</a></li>";
					echo "<li><a href=\"functions/logout.php\">Log Out</a></li>";
					}
				else
					echo "<li><a href=\"?page=login\">Log In / Sign Up</a></li>"; ?>
					</ul>

				<form class="navbar-form navbar-left" id="search_bar" action="" method="get" role="search">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Search" name="search">
						<input type="hidden" name="page" value="browse">
					</div>
					<button type="submit" class="btn btn-default">Submit</button>
				</form>
				</div>
			</div>
		</nav>
        
		<?php
			if(isset($_REQUEST['page']))
			{
				include $_REQUEST['page'] . ".php";
				$pg = $_REQUEST['page'];
			}
			else
				include "browse.php";
		?>
		
		<div class="footer">
			<p class="text-center">
				&copy; Sidestall Inc. 2013 - All rights reserved.<br>
				<a href="?page=forums">forums</a> &middot; 
				<a href="?page=about">about</a> &middot; 
				<a href="?page=faq">faqs</a> &middot; 
				<a href="?page=tos">terms of service</a> &middot; 
				<a href="?page=privacy">privacy policy</a> &middot; 
				<a href="?page=contact">contact</a><br>
				<a href="mailto:nunya.bizniss@dontemailus.com"><i class="fa fa-envelope"></i></a> &middot; 
				<a href="https://www.facebook.com/bewchy" target="_blank"><i class="fa fa-facebook-square"></i></a> &middot; 
				<a href="https://twitter.com/ProBirdRights" target="_blank"><i class="fa fa-twitter-square"></i></a>
			</p>
		</div>
	</div>
</body>


</html>