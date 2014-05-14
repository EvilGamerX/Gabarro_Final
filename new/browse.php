<article id="browse_page" >
	<section id="parent_opts">
		<div class="jumbotron">
			<h2>Browse games by Platform, Genre or both! </h2>
		</div>
		<ul>
		<li><button type="submit" class="btn btn-default btn-lg" value="Platform" onclick="display('platform_opts')">Platform</li>
<!--			<li><input type="submit" value="Platform" onclick="display('platform_opts')"></li>
			<li><input type="submit" value="Genre" onclick="display('genre_opts')"></li>
-->
		</ul>
		<br/>
	</section>
	<form action="?page=browse" method="post">
		<section id="platform_opts" class="platform_radio_section" style="display:none">
			<section class="radio_group">
				<label for="pc">PC</label>
				<input type="radio" name="platform_radios" id="pc" value="PC" required/>
			</section>
			<section class="radio_group">
				<label for="ps4">Playstation 4</label>
				<input type="radio" name="platform_radios" id="ps4" value="Playstation 4" required/>
			</section>
			<section class="radio_group">
				<label for="xboxone">Xbox One</label>
				<input type="radio" name="platform_radios" id="xboxone" value="Xbox One" required/>
			</section>
			<section class="radio_group">
				<label for="ps3">Playstation 3</label>
				<input type="radio" name="platform_radios" id="ps3" value="Playstation 3" required/>
			</section>
			<section class="radio_group">
				<label for="xbox360">Xbox 360</label>
				<input type="radio" name="platform_radios" id="xbox360" value="Xbox 360" required/>
			</section>
			<section class="radio_group">
				<label for="wiiu">Wii U</label>
				<input type="radio" name="platform_radios" id="wiiu" value="Wii U" required/>
			</section>
			<section class="radio_group">
				<label for="wii">Wii</label>
				<input type="radio" name="platform_radios" id="wii" value="Wii" required/>
			</section>
			<section class="radio_group">
				<label for="ds">Nintendo DS</label>
				<input type="radio" name="platform_radios" id="ds" value="Nintendo DS" required/>
			</section>
			<section class="radio_group">
				<label for="3ds">Nintendo 3DS</label>
				<input type="radio" name="platform_radios" id="3ds" value="Nintendo 3DS" required/>
			</section>
			<section class="radio_group">
				<label for="psvita">Playstation Vita</label>
				<input type="radio" name="platform_radios" id="psvita" value="Playstation Vita" required/>
			</section>
			<!--<section class="radio-group">
			<div class="btn-group" data-toggle="buttons-radio">  
				<button id="pc" type="button" data-toggle="button" name="platform_radios" value="PC" class="btn btn-primary">PC</button>
				<button id="ps4" type="button" data-toggle="button" name="platform_radios" value="Playstation 4" class="btn btn-primary">Playstation 4</button>
			</div>
			</section>-->

		</section>
		


		<br/>
<!--		<section id="genre_opts" class="genre_radio_section" style="display:none">
			<section class="radio_group">
				<label for="fighting">Fighting</label>
				<input type="radio" name="genre_radios" id="fighting" value="Fighting" required/>
			</section>
			<section class="radio_group">
				<label for="puzzle">Puzzle</label>
				<input type="radio" name="genre_radios" id="puzzle" value="Puzzle" required/>
			</section>
			<section class="radio_group">
				<label for="racing">Racing</label>
				<input type="radio" name="genre_radios" id="racing" value="Racing" required/>
			</section>
			<section class="radio_group">
				<label for="rpg">RPG</label>
				<input type="radio" name="genre_radios" id="rpg" value="RPG" required/>
			</section>
			<section class="radio_group">
				<label for="shooting">Shooting</label>
				<input type="radio" name="genre_radios" id="shooting" value="Shooting" required/>
			</section>
			<section class="radio_group">
				<label for="simulation">Simulation</label>
				<input type="radio" name="genre_radios" id="simulation" value="Simulation" required/>
			</section>
			<section class="radio_group">
				<label for="sports">Sports</label>
				<input type="radio" name="genre_radios" id="sports" value="Sports" required/>
			</section>
			<section class="radio_group">
				<label for="strategy">Strategy</label>
				<input type="radio" name="genre_radios" id="strategy" value="Strategy" required/>
			</section>
		</section>
-->
		<button type="submit" name="results_submit" value="View Results" class="btn btn-lg" id="submit"><b>Submit</b></button>
		<!--<input type="submit" name="results_submit" value="View Results">-->
	</form>
	<?php
		// retrieve all games and then run comparisons to sort displayed results
		$quer = "SELECT * FROM game_table";
		$res = $db->send_sql($quer);
		$ret;

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
					$selected_platform = "1000000000";

				elseif (strcasecmp($selected_platform, "playstation 4") == 0)
					$selected_platform = "0100000000";

				elseif (strcasecmp($selected_platform, "xbox one") == 0)
					$selected_platform = "0010000000";

				elseif (strcasecmp($selected_platform, "playstation 3") == 0)
					$selected_platform = "0001000000";

				elseif (strcasecmp($selected_platform, "xbox 360") == 0)
					$selected_platform = "0000100000";

				elseif (strcasecmp($selected_platform, "wii u") == 0)
					$selected_platform = "0000010000";

				elseif (strcasecmp($selected_platform, "wii") == 0)
					$selected_platform = "0000001000";

				elseif (strcasecmp($selected_platform, "nintendo ds") == 0)
					$selected_platform = "0000000100";

				elseif (strcasecmp($selected_platform, "nintendo 3ds") == 0)
					$selected_platform = "0000000010";

				elseif (strcasecmp($selected_platform, "playstation vita") == 0)
					$selected_platform = "0000000001";
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

			// evaluate the results of the query compared to the built strings
			while ($row = $db->next_row())
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
				else*/
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
		}

		// check if get is set from the index (search bar)
		elseif (isset($_GET['search']))
		{	$illegal_chars = " .,:;\"-_~`?!@#$%^&*()[]{}<>/\\\n\t";
			$search = superExplode(strtolower(strip_tags($_GET['search'])), $illegal_chars);

			// search all games
			while ($row = $db->next_row())
			{	// use column 1, that's the game name column.
				$row_name = superExplode(strtolower($row[1]), $illegal_chars);
				$found = FALSE;

				foreach ($search as $word)
				{	foreach ($row_name as $word2)
					{	// if words are same (search term exists in game name) add to ret array
						if (strcasecmp($word, $word2) == 0)
						{	$ret[] = $row;
							$found = TRUE;
							break;
						}
					}
					// if found already, don't continue this loop
					if ($found === TRUE)
						break;
				}
			}
		}

		// if post and get wasn't set, assume they haven't selected everything and auto load all games to results
		// build array of all games from db. Can be used as a sort of cache so when next page/prev page
		// buttons are hit, they're already in script memory
		else
		{	while ($row = $db->next_row())
				$ret[] = $row;
		}

		echo "<section id=\"game_results\">";
		echo "<h3>Games</h3>";

		if(isset($ret))
		{
		$num_results = count($ret);
		}
		else
		$num_results=0;
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
				echo "<input type='image' name='game_result' src=\"". $ret[$j][5] . "\" value='Submit' onclick='reroute(" . $ret[$j][0] . ")'>";
				//echo "<a href='#' class='thumbnail'>";
				//echo "<img data-src=\"".$ret[$j][5]."\" name='game_result' value='Submit' onclick='reroute(".$ret[$j][0].")'></a>";
				echo "<input type='hidden' name='page' value='game'>";
				echo "<input type='hidden' name='secret_game_id_pass' value=".$ret[$j][0].">";
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
		echo "</div>";
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
