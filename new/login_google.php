<?php
	
?>

<div id="profile" class="hide">
	<div>
	  <span id="pic"></span>
	  <span id="name"></span>
	</div>

	<div id="email"></div>
</div>

<script type="text/javascript">

var request = gapi.client.plus.people.get( {'userId' : 'me'} );
request.execute(loadProfileCallback);

/**
* Callback for the asynchronous request to the people.get method. The profile
* and email are set to global variables. Triggers the user's basic profile
* to display when called.
*/
function loadProfileCallback(obj) {
	profile = obj;

	// Filter the emails object to find the user's primary account, which might
	// not always be the first in the array. The filter() method supports IE9+.
	email = obj['emails'].filter(function(v) {
		return v.type === 'account'; // Filter out the primary email
	})[0].value; // get the email from the filtered results, should always be defined.
	displayProfile(profile);
}

/**
* Display the user's basic profile information from the profile object.
*/
function displayProfile(profile){
	document.getElementById('name').innerHTML = profile['displayName'];
	document.getElementById('pic').innerHTML = '<img src="' + profile['image']['url'] + '" />';
	document.getElementById('email').innerHTML = email;
	toggleElement('profile');
}

/**
* Utility function to show or hide elements by their IDs.
*/
function toggleElement(id) {
	var el = document.getElementById(id);
	if (el.getAttribute('class') == 'hide') {
	  el.setAttribute('class', 'show');
	} else {
	  el.setAttribute('class', 'hide');
	}
}
</script>
<script src="https://apis.google.com/js/client:plusone.js" type="text/javascript"></script>