<?php

/** 
 * This API uses Basic Access Authentication 
 * sends user credentialsin the header at the HTTP request. This makes it easy to use, but insecure.
 * OAuth is the Twitter preffered method of authentication moving forward - "come August 2010. we'll 
 * be turning off Basic Auth from the API"
 *
 */
include("TweetFromFile.class.php");

$obj = new TweetFromFile('thinkphp','xxxx','status.txt');

$send = $obj->updateStatus();

if($send) {echo"Twitter UPDATE";}
       else 
          {echo"Twitter seems to be unavailable at the moment...";}

?>