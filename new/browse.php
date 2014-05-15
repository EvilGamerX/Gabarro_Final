<article id="browse_page" >
    
    <div class="carousel slide" id="myCarousel" data-ride="carousel">
		<ol class="carousel-indicators">
			<li class="active" data-slide-to="0" data-target="#myCarousel"></li>
			<li data-slide-to="1" data-target="#myCarousel" class=""></li>
			<li data-slide-to="2" data-target="#myCarousel" class=""></li>
			<li data-slide-to="3" data-target="#myCarousel" class=""></li>
			<li data-slide-to="4" data-target="#myCarousel" class=""></li>
			<li data-slide-to="5" data-target="#myCarousel" class=""></li>
			<li data-slide-to="6" data-target="#myCarousel" class=""></li>
			<li data-slide-to="7" data-target="#myCarousel" class=""></li>
		</ol>
		<div class="carousel-inner">
			<div class="item active">

			  <img alt="Titanfall XbOne" src="http://3.bp.blogspot.com/-wSj90eVZ1O8/UksNDHe-PKI/AAAAAAAAAA8/6d1Jk21ydW0/s1600/titanfall-hd-wallpaper2112.jpg" width="100%">
			  <div class="carousel-caption" style="background-color:rgba(0, 0, 0, 0.2); border-radius:30px;">
				<h4>Titanfall Xbox One</h4>
				<p><strong>$57.44</strong></p>
			  </div>
			</div>
			<div class="item">
			  <img alt="PKMN B2/W2 3DS" src="http://tecnoslave.com/wp-content/uploads/2012/05/pokemonblackwhite2banner.jpg" width="100%">
			  <div class="carousel-caption" style="background-color:rgba(0, 0, 0, 0.2); border-radius:30px;">
				<h4>Pokemon Black 2/White 2 3DS</h4>
				<p><strong>$49.49</strong></p>
			  </div>
			</div>
			<div class="item">
			  <img alt="Battlefield 3" src="http://img255.imageshack.us/img255/6214/battlefield3s.jpg" width="100%">
			  <div class="carousel-caption" style="background-color:rgba(0, 0, 0, 0.2); border-radius:30px;">
				<h4>Battlefield 3 PS3</h4>
				<p><strong>$39.99</strong></p>
			  </div>
			</div>
			<div class="item">
			  <img alt="SWTOR" src="http://img3.wikia.nocookie.net/__cb20100423033129/starwars/images/1/10/WPTORtalk.png" width="100%">
			  <div class="carousel-caption" style="background-color:rgba(0, 0, 0, 0.2); border-radius:30px;">
				<h4>Star Wars: The Old Republic PC</h4>
				<p><strong>Free!</strong></p>
			  </div>
			</div>
			<div class="item">
			  <img alt="LEGO Batman 2" src="http://1.bp.blogspot.com/-tjVPUBkRV10/TxQrPGG4yCI/AAAAAAAAKLE/QveGN3tNBrA/s1600/legobatman2banner.jpg" width="100%">
			  <div class="carousel-caption" style="background-color:rgba(0, 0, 0, 0.2); border-radius:30px;">
				<h4>LEGO Batman 2: DC Super Heroes Wii</h4>
				<p><strong>$19.99</strong></p>
			  </div>
			</div>
			<div class="item">
			  <img alt="BioShock Infinite" src="http://pyramida.info/tv/bioshock.jpg" width="100%">
			  <div class="carousel-caption" style="background-color:rgba(0, 0, 0, 0.2); border-radius:30px;" width="100%">
				<h4>BioShock Infinite PS4</h4>
				<p><strong>$24.99</strong></p>
			  </div>
			</div>
			<div class="item">
			  <img alt="Saints Row IV" src="http://www.thepalaceofwisdom.co.uk/wp-content/uploads/2013/05/Saints-Row-IV-Header.png" width="100%">
			  <div class="carousel-caption" style="background-color:rgba(0, 0, 0, 0.2); border-radius:30px;">
				<h4>Saints Row IV PC</h4>
				<p><strong>$AMERICA</strong></p>
			  </div>
			</div>
			<div class="item">
			  <img alt="Halo 4" src="http://www.thesixthaxis.com/wp-content/uploads/2012/11/halo4end.jpeg" width="100%">
			  <div class="carousel-caption" style="background-color:rgba(0, 0, 0, 0.2); border-radius:30px;">
				<h4>Halo 4 Xbox 360</h4>
				<p><strong>$59.99</strong></p>
			  </div>
			</div>
		</div>

			<a class="left carousel-control" href="#myCarousel" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left"></span>
			</a>
			<a class="right carousel-control" href="#myCarousel" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right"></span>
			</a>
	</div>

    <script>
	/*$.post( "game_call.php", function( data ) {
		alert( data );
});*/
	</script>
	<section id="parent_opts">
		<div class="well well-small">
			<h2>Browse games by platform! </h2>
		</div>

	<div ng-controller="CarouselDemoCtrl">
		<label>Video Game Platforms</label>
		<div class="form-group">
			<label class="checkbox-inline">
				<input type="checkbox" name="platform" ng-model="formData.platform.PC" ng-change="search();"> PC
			</label>
				<label class="checkbox-inline">
				<input type="checkbox" name="platform" ng-model="formData.platform.PS4" ng-change="search();"> PS4
			</label>
			<label class="checkbox-inline">
				<input type="checkbox" name="platform" ng-model="formData.platform.PS3" ng-change="search();"> PS3
			</label>
				<label class="checkbox-inline">
				<input type="checkbox" name="platform" ng-model="formData.platform.xb1" ng-change="search();"> Xbox One
			</label>
				<label class="checkbox-inline">
				<input type="checkbox" name="platform" ng-model="formData.platform.x360" ng-change="search();"> Xbox 360
			</label>
				<label class="checkbox-inline">
				<input type="checkbox" name="platform" ng-model="formData.platform.WiiU" ng-change="search();"> WiiU
			</label>
				<label class="checkbox-inline">
				<input type="checkbox" name="platform" ng-model="formData.platform.Wii" ng-change="search();"> Wii
			</label>
				<label class="checkbox-inline">
				<input type="checkbox" name="platform" ng-model="formData.platform.3DS" ng-change="search();"> Nintendo 3DS
			</label>
				<label class="checkbox-inline">
				<input type="checkbox" name="platform" ng-model="formData.platform.NDS" ng-change="search();"> Nintendo DS
			</label>
				<label class="checkbox-inline">
				<input type="checkbox" name="platform" ng-model="formData.platform.PSV" ng-change="search();"> PS Vita
			</label>
				<label class="checkbox-inline">
				<input type="checkbox" name="platform" ng-model="formData.platform.PSP" ng-change="search();"> PSP
			</label>
		</div>
		<!--pre>{{formData}}</pre>
		<pre>{{result}}</pre-->
		<div class="row" style="margin-bottom:15px;" ng-repeat="row in result">
			<div class="col-md-3 text-center" ng-repeat="col in row">
				<a href="?page=game&gid={{col.gid}}"><img src="{{col.image}}" class="img-thumbnail" width="100%"></a>
			</div>
		</div>
		<!--(_id, amazon, gid, img, name, platform)-->
	</div>
	<?php
		// retrieve all games and then run comparisons to sort displayed results
		//$quer = "SELECT * FROM game_table";
		//$res = $db->send_sql($quer);
		$ret;
		$ret2;
		$collection = $mdb->selectCollection("game_table");
		$counter = 0;
		// FER BLOWIN' SHIT UP (meant to be read in dumb southern accent).
			// super explode function gabarro gave us!
			function superExplode($s, $sep)
			{	$i = 0;
				$arr[$i++] = strtok($s, $sep);
				while (($token = strtok($sep)) !== FALSE)
					$arr[$i++] = $token;
				return $arr;
			}

		// check to see if user picked radio buttons to narrow results field
		if (isset($_POST["results_submit"]))
		{	// check a platform was set
			if (isset($_POST["platform_radios"]))
			{	$selected_platform = $_POST["platform_radios"];
				// form num for query for platform
				if (strcasecmp($selected_platform, "pc") == 0)
					$selected_platform = "pc";

				elseif (strcasecmp($selected_platform, "playstation 4") == 0)
					$selected_platform = "ps4";

				elseif (strcasecmp($selected_platform, "xbox one") == 0)
					$selected_platform = "xb1";

				elseif (strcasecmp($selected_platform, "playstation 3") == 0)
					$selected_platform = "ps3";

				elseif (strcasecmp($selected_platform, "xbox 360") == 0)
					$selected_platform = "x360";

				elseif (strcasecmp($selected_platform, "wii u") == 0)
					$selected_platform = "wiiu";

				elseif (strcasecmp($selected_platform, "wii") == 0)
					$selected_platform = "wii";

				elseif (strcasecmp($selected_platform, "nintendo ds") == 0)
					$selected_platform = "nds";

				elseif (strcasecmp($selected_platform, "nintendo 3ds") == 0)
					$selected_platform = "n3ds";

				elseif (strcasecmp($selected_platform, "playstation vita") == 0)
					$selected_platform = "psv";
			}

			// check if genre was set

			if (isset($_POST["genre_radios"]))
			{	$selected_genre = $_POST["genre_radios"];

				// form num for query for genre
				if (strcasecmp($selected_genre, "fighting") == 0)
					$selected_genre = "10000000";

				elseif (strcasecmp($selected_genre, "puzzle") == 0)
					$selected_genre = "01000000";

				elseif (strcasecmp($selected_genre, "racing") == 0)
					$selected_genre = "00100000";

				elseif (strcasecmp($selected_genre, "rpg") == 0)
					$selected_genre = "00010000";

				elseif (strcasecmp($selected_genre, "shooting") == 0)
					$selected_genre = "00001000";

				elseif (strcasecmp($selected_genre, "simulation") == 0)
					$selected_genre = "00000100";

				elseif (strcasecmp($selected_genre, "sports") == 0)
					$selected_genre = "00000010";

				elseif (strcasecmp($selected_genre, "strategy") == 0)
					$selected_genre = "00000001";
			}

				$cursor = $collection->find();
				foreach($cursor as $doc)
				{
				if($selected_platform == strtolower($doc['platform']))
				{
				$ret2[] = $doc;
				$counter++;
				}
				}
			// evaluate the results of the query compared to the built strings
			/*while ($row = $db->next_row())
			{	// check to see which if any are set. first check both
				/*if ((isset($_POST["platform_radios"])) && (isset($_POST["genre_radios"])))
				{	$platform_pos = strpos($selected_platform, "1", $offset = null);
					$genre_pos = strpos($selected_genre, "1", $offset = null);

					if (strpos(decbin($row[2]), "1") == $platform_pos)
					{	if (strpos(decbin($row[3]), "1") == $genre_pos)
						{	$ret[] = $row;
						}
					}
				}

				// get position of switch for platform string if set
				else
				if (isset($_POST["platform_radios"]))
				{
					$platform_pos = strpos($selected_platform, "1", $offset = null);
					$tmp = decbin($row[2]);
					
					//echo $selected_platform."</br>".decbin($row[2])."</br>".strlen($tmp)."</br>";
										
					while(strlen($tmp) != 10)
					{
						$tmp = "0".$tmp;
					}
					//echo $selected_platform."</br>".strlen($tmp)."</br>";
					if (strpos($tmp, "1", $offset=$platform_pos) == $platform_pos)
					{	
						$ret[] = $row;
					}
					//echo "</br>";
				}

				// get position of switch for genres string if set
				elseif (isset($_POST["genre_radios"]))
				{	$genre_pos = strpos($selected_genre, "1", $offset = null);

					if (strpos(decbin($row[3]), "1") == $genre_pos)
						$ret[] = $row;
				}

				// if post is set and these conditions somehow don't meet, then
				// it technically should display all games
			}
		*/
}
		// check if get is set from the index (search bar)
		elseif (isset($_GET['search']))
		{	$illegal_chars = " .,:;\"-_~`?!@#$%^&*()[]{}<>/\\\n\t";
			$search = superExplode(strtolower(strip_tags($_GET['search'])), $illegal_chars);

			// search all games
			$cursor = $collection->find();
			
			foreach($cursor as $doc)
			{
			$row_name = superExplode(strtolower($doc['name']), $illegal_chars);
			$found = false;
			foreach($search as $word)
			{
				foreach($row_name as $word2)
				{
						if (strcasecmp($word, $word2) == 0)
						{	$ret2[] = $doc;
							$counter++;
							$found = TRUE;
							break;
						}					
				}
			}
			}
			/*while ($row = $db->next_row())
			{	// use column 1, that's the game name column.
				$row_name = superExplode(strtolower($row[1]), $illegal_chars);
				$found = FALSE;

				foreach ($search as $word)
				{	foreach ($row_name as $word2)
					{	// if words are same (search term exists in game name) add to ret array
						if (strcasecmp($word, $word2) == 0)
						{	//$ret[] = $row;
							$found = TRUE;
							break;
						}
					}
					// if found already, don't continue this loop
					if ($found === TRUE)
						break;
				}
			}*/
		}

		// if post and get wasn't set, assume they haven't selected everything and auto load all games to results
		// build array of all games from db. Can be used as a sort of cache so when next page/prev page
		// buttons are hit, they're already in script memory
		
		/*	$counter = 0;
			$cursor = $collection->find();
			foreach($cursor as $doc)
			{
				$counter++;
				$ret2[] = $doc;
			}
		/*while ($row = $db->next_row())
				$ret[] = $row;
		}

		echo "<section id=\"game_results\">";
		echo "<h3>Games</h3>";

		$num_results = $counter;
		//echo $num_results;
		// print result table
		echo "<div id=\"table_wrapper\">";
		echo "<div id=\"table_scroll\">";
		echo "<table border=0>";
		echo "<tbody>";
		// loop through all results
		for ($i = 0; $i < $num_results; $i+=5)
		{	// every 5 results make a new row
			echo "<tr>";
			for ($j = $i; (($j < ($i + 5)) && ($j < $num_results)); $j++)
			{	echo "<td><form name=".$j." action='' method='get'>";
				echo "<input type='image' name='game_result' src=\"". $ret2[$j]["image"] . "\" value='Submit' onclick='reroute(" . $ret2[$j]["gid"] . ")'>";
				//echo "<a href='#' class='thumbnail'>";
				//echo "<img data-src=\"".$ret[$j][5]."\" name='game_result' value='Submit' onclick='reroute(".$ret[$j][0].")'></a>";
				echo "<input type='hidden' name='page' value='game'>";
				echo "<input type='hidden' name='secret_game_id_pass' value=".$ret2[$j]["gid"].">";
				//echo "<input type='hidden' name='secret_game_id_pass' value=\"" . $ret[$j][0] . "\"
				echo "</form></td>";
			//	echo "<td><form name=".$j." action='' method='get'>";
				//echo "<a href='#' class='thumbnail'>";
				//echo "<img data-src=\"".$ret[$j][5]."\" name='game_result' value='Submit' onclick='reroute(".$ret[$j][0].")'></a>";
				//echo "</form></td>";
			}
			echo "</tr>";
		}
		echo "</tbody>";
		echo "</table>";
		echo "</div>";
		echo "</div>";*/
?>
</article>

<script>

function reroute(game)
{
}

function display(e){
	//if(e.checked)
	if(document.getElementById(e).style.display == "block")
		document.getElementById(e).style.display = "none";
	else
		document.getElementById(e).style.display = "block"

		}
</script>
