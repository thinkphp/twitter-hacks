<?php

$username = $_GET['username'];

$query = $_GET['what'];

$user_tweets = json_decode(file_get_contents("http://api.twitter.com/1/statuses/user_timeline.json?screen_name=".$username."&count=100"));

$count = 0;

$cat_tweets = array();

$pattern = '/'.$query.'/';

foreach($user_tweets as $tweet) {

	if(preg_match($pattern, $tweet->text)) {
		$count++;
		$cat_tweets[] = $tweet;
	}
}

require('./user_template.php');

?>