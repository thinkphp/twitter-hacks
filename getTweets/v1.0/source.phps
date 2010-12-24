<?php
   if(isset($_GET['user']) && $_GET['user'] != '') {
       $screen_name = $_GET['user'];
   } else {
       $screen_name = 'codepo8';
   }
  /**
    * @param $twitter_id (String) screen name of the user
    * @return Object SimpleXMLElement that contains data about user  
    */
    function retrieve_status($twitter_id) {

        $url = "http://twitter.com/statuses/user_timeline/$twitter_id.xml";
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,3);
        curl_setopt($ch,CURLOPT_TIMEOUT,3);
        $data = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);

        if(intval($info['http_code']) == 200) {

               if(class_exists('simpleXMLElement')) {

                   $xml = new SimpleXMLElement($data); 

                 return $xml;

               } else {

                 return $data;
               }

        } else {

          return false;
        }
 
    }//end function

   /**
     * @param $text (String) 
     * @return $newtext (String) same text but tweetified
     */ 
    function tweetify($text) {

       $text = preg_replace("/(https?:\/\/[\w\-:;?&=+.%#\/]+)/i", '<a href="$1">$1</a>',$text);
       $text = preg_replace("/(^|\W)@(\w+)/i", '$1<a href="http://twitter.com/$2">@$2</a>',$text);
       $text = preg_replace("/(^|\W)#(\w+)/i", '$1#<a href="http://search.twitter.com/search?q=%23$2">$2</a>',$text); 

      return $text;
    }

  /** @param $screen_name (String) the screen name of the desired user from Twitter
    * @param $count (Integer) number of tweets from desired user
    * @param $tweetify (Bool) true if the tweet is tweetified or false for non tweetify
    * @param $dateFormat (Date) format date from tweet
    * @param $timeZone (String) time zone 
    * @param $beforeHTML (Element) begin markup between tweet
    * @param $startHTML (Element) the markup for tweet
    * @param $middleHTML (Element) the markup for details
    * @param $endHTML (Element) the end markup
    * @param $afterHTML (Element) close markup
    * @return (String) the tweets from desired screen_user between markups
    */
    function get_tweets($screen_name,
                        $count=3,
                        $tweetify=false,
                        $dateFormat="D jS M y H:i",
                        $timeZone="Europe/Bucharest",
                        $beforeHTML="<ul>",
                        $startHTML="<li class=\"tweet\"><span class=\"tweet-status\">",
                        $oddHTML="<li class=\"tweet-odd\"><span class=\"tweet-status\">",
                        $middleHTML="</span><br/><span class=\"tweet-details\">",
                        $endHTML="</span></li>",
                        $afterHTML="</ul>"
                       ) {


	date_default_timezone_set($dateTimeZone);
        
        if($statuses = retrieve_status($screen_name)) {

               //set up the data for that username
               $about = '<div class="about-screen-name">'.
                        '<div><img src="'.$statuses[0]->status->user->profile_image_url.'" alt="cover"></div>'. 
                        '<div>URL: <a href="'.$statuses[0]->status->user->url.'">'.$statuses[0]->status->user->url.'</a></div>'. 
                        '<div>Name: '.$statuses[0]->status->user->name.'</div>'. 
                        '<div>ID: '.$statuses[0]->status->user->id.'</div>'. 
                        '<div>Location: '.$statuses[0]->status->user->location.'</div>'.
                        '<div>Created At: '.$statuses[0]->status->user->created_at.'</div>'.
                        '</div>';

               $map = '';
               if($statuses[0]->status->user->location) { 
                 //set up a map from location     
                 $src = 'http://maps.google.com/maps/api/staticmap?center='.$statuses[0]->status->user->location.'&zoom=14&size=440x150&sensor=false&markers=size:mid|color:red|'.$statuses[0]->status->user->location;
                 //display out the map with its locations
                 $map = "<div class='map'><img src='$src' alt='map'></div>";
               }

               $output = $about.$map.$beforeHTML; 

               $i = 0;

               foreach($statuses as $key=>$status) {  

                    ++$i; 

                    if($tweetify) {

                      if(substr_count($status->text,'@') != 0 | substr_count($status->text,'#') != 0 | substr_count($status->text,'http://') != 0) {

                        $tweet = tweetify($status->text);

                      }else{

                        $tweet = $status->text;

                      }

                    }else{

                        $tweet = $status->text;
                    }

                    $time = date($dateFormat,strtotime($status->created_at));

                    if($i%2 != 0) {$beginHTML = $oddHTML;}

                           else 
                                  {$beginHTML = $startHTML;}

                    $output .= $beginHTML.$tweet.$middleHTML.$time.$endHTML; 

                    if($count == $i) {break;}
               }

               $output .= $afterHTML;

        } else {

               $output .= $beforeHTML.'<li id="tweet">Twitter seems to be unavailable at the moment.</li>'.$afterHTML;
        }

       return$output; 

    }//end function 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">  
   <title>get Tweets</title>
   <link rel="stylesheet" href="http://yui.yahooapis.com/2.7.0/build/reset-fonts-grids/reset-fonts-grids.css" type="text/css">
   <link rel="stylesheet" href="http://yui.yahooapis.com/2.7.0/build/base/base.css" type="text/css">
   <style type="text/css">
   html,body{font-family: georgia,sans-serif,verdana,helvetica}
   a{color: #1b8c57}
   h1{background: #447E40;color:#FFFFFF;padding:14px;text-align:center;font-size: 40px;-moz-border-radius:5px;-border-radius:5px;-webkit-border-radius:5px;}
   span.tweet-details{font-size:11px; padding-top:4px; color:#999;}
   .tweet{padding:6px;border-bottom:solid 1px #eefcf5;} 
   .tweet-odd{padding:6px;border-bottom:solid 1px #eefcf5;background:#eefcf5}
   ul {padding: 0;margin: 0}
   ul li{list-style:none}
   .about-screen-name{padding: 4px;margin: 3px;float: left}
   #ft{font-size:80%;color:#888;text-align:right;margin:2em 0;font-size: 12px}
   #ft p a{color:#93C37D;}
   </style>
</head>
<body>
<div id="doc" class="yui-t7">
   <div id="hd" role="banner"><h1>Get Tweets From Any Twitter User</h1></div>
   <div id="bd" role="main">
	<div class="yui-g"> 
        <?php echo get_tweets($screen_name,12,true);?>
	</div>
	</div>
   <div id="ft" role="contentinfo"><p>Created by @<a href="http://twitter.com/thinkphp">thinkphp</a> | <a href="source.phps">source</a></p></div>
</div>
</body>
</html>
