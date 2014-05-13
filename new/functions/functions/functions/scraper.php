<?php
	include('./simple_html_dom.php');	
//	include('./db_functions.php');
//	$db = new database();
//	$linkid = $db->connect();
	
	$game_arr = array("http://www.amazon.com/Call-Duty-Ghosts-Playstation-3/dp/B003O6CBIG/ref=sr_1_1?ie=UTF8&qid=1386458561&sr=8-1&keywords=call+of+duty+ghost", 
	"http://www.amazon.com/Battlefield-4-PlayStation/dp/B00DS0MQUQ/ref=sr_1_1?ie=UTF8&qid=1386458722&sr=8-1&keywords=battlefield+4",
	"http://www.amazon.com/Killzone-Shadow-Fall-PlayStation-4/dp/B00BGA9YZK/ref=sr_1_2?ie=UTF8&qid=1386458853&sr=8-2&keywords=killzone+shadow+fall",
	"http://www.amazon.com/Titanfall-Xbox-One/dp/B00DB9JYFY/ref=sr_1_1?ie=UTF8&qid=1386458887&sr=8-1&keywords=titanfall",
	"http://www.amazon.com/Assassins-Creed-IV-Black-Flag-Xbox/dp/B00BMFIXT2/ref=sr_1_1?ie=UTF8&qid=1386458923&sr=8-1&keywords=assassins+creed+4",
	"http://www.amazon.com/Destiny-PlayStation-4/dp/B00BGA9Y3W/ref=sr_1_1?ie=UTF8&qid=1386458944&sr=8-1&keywords=destiny",
	"http://www.amazon.com/Need-Speed-Rivals-PlayStation-4/dp/B00D3RBZHY/ref=sr_1_1?ie=UTF8&qid=1386458966&sr=8-1&keywords=need+for+speed+rivals",
	"http://www.amazon.com/The-Sims-3-PC/dp/B00166N6SA/ref=sr_1_5?ie=UTF8&qid=1386458985&sr=8-5&keywords=sims",
	"http://www.amazon.com/Madden-NFL-25-Xbox-360/dp/B00AY1CT4U/ref=sr_1_1?s=videogames&ie=UTF8&qid=1386459196&sr=1-1&keywords=madden+25",
	"http://www.amazon.com/Final-Fantasy-XIV-Realm-Reborn-Playstation/dp/B002BRZ79E/ref=sr_1_1?s=videogames&ie=UTF8&qid=1386459373&sr=1-1&keywords=final+fantasy");
	
	// FER BLOWIN' SHIT UP (meant to be read in dumb southern accent).
	// super explode function gabarro gave us!
	function superExplode($s, $sep)
	{	$i = 0;
		$arr[$i++] = strtok($s, $sep);
		while (($token = strtok($sep)) !== FALSE)
			$arr[$i++] = $token;
		return $arr;
	}

	// takes an array of platforms the game is available on 
	// and converts it to a binary string, then a number
	function convert_platform_for_db($platform_array) 
	{	$ret = "";
		$platform_compare_arr = array("pc" => "0",
											"playstation 4" => "0",
											"xbox one" => "0",
											"playstation 3" => "0",
											"xbox 360"  => "0",
											"wii u"  => "0",
											"wii"  => "0",
											"nintendo ds"  => "0",
											"nintendo 3ds"  => "0",
											"playstation vita"  => "0");
		
		// loop through each platform amazon returned
		// then through each platform we're cataloguing.
		// if its offered, set value to 1 for true
		foreach ($platform_array as $amazon_plat)
		{	// put & in front of val so when we change value, it changes
			// it in the array itself
			foreach ($platform_compare_arr as $comparison_plat => &$val)
			{	// if equal, set val to STRING value of 1 so it can be
				// concatenated later in function
				if (strcmp(strtolower($amazon_plat), $comparison_plat) == 0)
					$val = "1";
			}
		}
	
		// loop through array and concatenate values to a blank string
		// to build string 
		foreach ($platform_compare_arr as $comparison_plat => $val)
			$ret = $ret . $val;
			
		// test
		// echo $ret;
		
		// after building string up, convert it to decimal number
		// for db storage and return it
		$ret = bindec($ret);
		
		return $ret;
	}
/*
	// take the scraped items and form sql query to insert to game table
	function insert($t, $p, $a, $i)
	{	$quer = "INSERT INTO game_table (name, platform, amazon, image) VALUES ('$t', '$p', '$a', '$i')";
		send_sql($quer);
	}
*/
	// loop through games and extract the data from each game's page 	
	foreach ($game_arr as $game)
	{	$html = new simple_html_dom();
		$html->load_file($game);
		
		$title = $html->getElementById("btAsinTitle")->innertext;
		$temp_arr = superExplode($title, "-(");
		$title = chop($temp_arr[0]);
		
		foreach($html->find('div.swatchInnerText') as $elem)
			$platform_results_arr[] = $elem->innertext;

		$platform_number = convert_platform_for_db($platform_results_arr);	
			
		$main_image = $html->getElementById("main-image")->src;
		
//		insert($title, $platform_number, $game, $main_image);		
		
// code for proper results Test code 
		echo "title: ".$title."<br/>";
		echo "platform number: ".$platform_number."<br/>";
		echo $game."<br/>";
		echo "<br/>amazon link size: ".strlen($game)."<br/>";
		echo $main_image."<br/>";
		echo "<br/>image link length: ".strlen($main_image)."<hr/>";		
		
		
		$platform_results_arr = NULL;
	}
?>