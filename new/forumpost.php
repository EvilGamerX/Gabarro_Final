<!-- thank you to http://jsbin.com/ugami/1/edit for helping to get the countdown done. -->

<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

<script>
function updateCountdown() {

    var remaining = 1000 - jQuery('.message').val().length;
    jQuery('.countdown').html('<br/>' + remaining + ' characters remaining.');
}

jQuery(document).ready(function($) {
    updateCountdown();
    $('.message').change(updateCountdown);
    $('.message').keyup(updateCountdown);
});
</script>


		<div id="page-data">


		<u>Nintendo 3DS</u> > <u>Strategy</u> > <u>Pok&eacute;mon</u>

		<h2>Pokemon: How do I catch the Pikachus?</h2>

		<div id="posts">
		<table border="1" align="center">

		<tr>
		<td align="center">
		<b>BestTrainer1337 said:</b>
		<br>
		Help I am trying to catch the Pikachus but i looked in the tall grass and i couldnt find a pikachus so please if you know where to catch a pikachus plz tell me because i cant find a pikachus. ty.
		<br><br>
		P.s. if you have a pikachus i will trade for them.
		</td>

		</tr>
		<td align="center">

		<b>PikachusCatcher905 said:</b>
		<br>
		I have caught numerous pikachus and the best way to catch a pikachus in my expert opinion is to lure it out with peanut butter and jelly sandwich. ples take advice becus this is legitimate advice and not a joek.
		<br><br>
		P.S. you cannot trade for my pikachus becuz they are special to me
		</td>
		<tr>

		</tr>

		<tr>

		<td align="center">

		<b>BestTrainer1337 said:</b><align="right">x</align>
		<br>
		Ty for tech me how to cetch pikachus. after taek ur advice i have over 17 pikachus and each of pikachus is a good pikachus. this forum is so hepful cuz if i dint have it i woud have caut no pikachus insted of even more than 17 pikachus.

		</td>
		</tr>
		</table>

		</div>

		<div id="forum-nav" align="center">

		<input type="submit" value="First">
		<input type="submit" value="Previous">
		1
		<input type="submit" value="Next">
		<input type="submit" value="Last">
		</div>


		<div id="reply" align="center">
		<br>
		Reply to thread?<br>
		<textarea class="message" rows="5" cols="50" maxlength="1000"></textarea>
<span class="countdown"></span>
		<br>

		<br>
		<input type="submit" value="submit">
		</div>

		</div>

