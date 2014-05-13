<!DOCTYPE HTML>
<?php
session_start();
include("functions/db_class.php");
$db = new database();
$db->setup("evilgamerx", "sg06017", "localhost", "sidestall");
//$lkid = connect();
//$m = new MongoClient();
//$mdb = $m->sidestall;
?>
<html ng-app="plunker">

<head>
    <meta charset="utf-8">
   <!-- <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.10/angular.js"></script>
    <script src="javascript/app.js"></script>
    <script src="//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.11.0.js"></script>
    <script src="javascript/carousel.js"></script> -->
    
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.10/angular.js"></script>
    <script src="//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.11.0.js"></script>
    <script src="javascript/carousel.js"></script>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
    
</head>

<body>

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

	<br>
    <br>
    
    <div ng-controller="CarouselDemoCtrl">
  <div style="height: 250px">
    <carousel interval="myInterval">
      <slide ng-repeat="slide in slides" active="slide.active">
        <img ng-src="{{slide.image}}" style="margin:auto;">
        <div class="carousel-caption">
          <h4>Slide {{$index}}</h4>
          <p>{{slide.text}}</p>
        </div>
      </slide>
    </carousel>
  </div>
  <div class="row">
    <div class="col-md-6">
      <button type="button" class="btn btn-info" ng-click="addSlide()">Add Slide</button>
    </div>
  </div>
</div>
	
    
			<?php
			if(isset($_REQUEST['page']))
			{
				include $_REQUEST['page'] . ".php";
				$pg = $_REQUEST['page'];
				}
			else
				include "browse.php";
		?>
    
    
    
</body>


</html>