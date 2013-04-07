<?php

if(isset($_POST['search'])) {

   $query = rawurlencode($_POST['search']);

} else {

  $query = "mootools";
}

$url = 'http://search.twitter.com/search.json?q=' . $query . '&lang=en&rpp=100';

$out = json_decode(file_get_contents($url));

$length = count($out->results);

require('template.php');

function get($url) {
   
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,3);
        curl_setopt($ch,CURLOPT_TIMEOUT,3);
        $data = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);

        if(intval($info['http_code']) == 200) {

          return $data;

        } else {

          return false;
        }
}
?>