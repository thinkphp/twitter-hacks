<?php
	
//USAGE
require('twitter.api.php');
//http://apiwiki.twitter.com/Twitter-API-Documentation
$twitter = new Twitter('USERNAME','PASSWORD');

/** Twitter REST API Method: statuses friends
  * ------------------------------------------------------------------------------------------------------------
  * @Description: Returns a user's friends,each with current inline.They are ordered by the order by the order in 
  *               which the user followed them, most recently followed first, 100 at a time.
  *               
  *               
  *
  * URL:          http://api.twitter.com/1/statuses/friends.format
  *
  * FORMATS:      xml,json
  * HTTP Methods: GET
  * Requires Authentication: false
  * Response: (XML Truncated)
  *         <?xml version="1.0" encoding="UTF-8"?>
  *            <users>
  *                <user>
  *                   <id>1401881</id>
  *                    <name>Doug Williams</name>
  *                    <screen_name>dougw</screen_name>
  *                    <location>San Francisco, CA</location>
  *                    <description>Twitter API Support. Internet, greed, users, dougw and opportunities are my passions.</description>
  *                    <profile_image_url>http://s3.amazonaws.com/twitter_production/profile_images/59648642/avatar_normal.png</profile_image_url>
  *                    <url>http://www.igudo.com</url>
  *                    <protected>false</protected>
  *                    <followers_count>1031</followers_count>
  *                    <profile_background_color>9ae4e8</profile_background_color>
  *                    <profile_text_color>000000</profile_text_color>
  *                    <profile_link_color>0000ff</profile_link_color>
  *               .............    
  * Parameters:
  *            id. (optional) the ID or screen name of the user for whom to request a list of friends.
  *                 ex: http://api.twitter.com/1/statuses/friends/12345.json or http://api.twitter.com/1/statuses/friends/bob.xml   
  *            user_id (optional) Specifies the Id of the user for whom to return the list of friends.
  *                  ex: http://api.twitter.com/1/statuses/friends.xml?user_id=1401881
  *            screen_name: (optional) Specifies the screen name of the user for whom to return list of friends.
  *            cursor: (optional) Breaks the results into pages. A single page contains 100 users.
  *                               This is recommended for users who are following many users.
  *                               Provides a value of -1 to begin paging. Provides values as returned to in the response
  *                               body's next_cursor and previous_cursor attributes to page back and forth in the list.
  *
  */
  //$tweets = $twitter->statuses->friends(); 
  //$tweets = $twitter->statuses->friends(array('screen_name'=>'quicksortv')); 


/** Twitter REST API Method: statuses followers
  * -----------------------------------------------------------------------------------------------------
  * @Description: Returns the authenticating user's followers, each with current status inline.
  *               They are ordered by the order in which they followed the user, 100 at a time.
  *               
  *
  * URL:          http://api.twitter.com/1/statuses/followers.format
  *
  * FORMATS:      xml,json
  * HTTP Methods: GET
  * Requires Authentication: false
  *
  * Example:  http://api.twitter.com/1/statuses/followers.format?screen_name=thinkphp
  *
  * Response: (XML Truncated)
  *         <?xml version="1.0" encoding="UTF-8"?>
  *            <users>
  *                <user>
  *                   <id>1401881</id>
  *                    <name>Doug Williams</name>
  *                    <screen_name>dougw</screen_name>
  *                    <location>San Francisco, CA</location>
  *                    <description>Twitter API Support. Internet, greed, users, dougw and opportunities are my passions.</description>
  *                    <profile_image_url>http://s3.amazonaws.com/twitter_production/profile_images/59648642/avatar_normal.png</profile_image_url>
  *                    <url>http://www.igudo.com</url>
  *                    <protected>false</protected>
  *                    <followers_count>1031</followers_count>
  *                    <profile_background_color>9ae4e8</profile_background_color>
  *                    <profile_text_color>000000</profile_text_color>
  *                    <profile_link_color>0000ff</profile_link_color>
  *               .............    
  */
   //$tweets = $twitter->statuses->followers(); 
   //$tweets = $twitter->statuses->followers(array('screen_name'=>'quicksortv')); 

/** Twitter REST API Method: statuses public_timeline
  * ------------------------------------------------------------------------------------------------------------
  * @Description: Returns the 20 most statuses from non-protected have set a custom user icon. 
  *               The public timeline is cached for 60 seconds so requesting it more often than
  *               is a waste of resources. 
  *
  * URL:          http://api.twitter.com/1/statuses/public_timeline.format
  *
  * FORMATS:      xml,json,atom,rss  
  * HTTP Methods: GET
  * Requires Authentication: false
  * Response: (XML Truncated)
  *   <?xml version="1.0" encoding="UTF-8"?>
  *       <statuses>
  *          <status>
  *           <created_at>Tue Apr 07 22:52:51 +0000 2009</created_at>
  *           <id>1472669360</id>
  *           <text>At least I can get your humor through tweets. RT @abdur: I don't mean this in a bad way, but genetically speaking your a cul-de-sac.</text>
  *            <source>&lt;a href="http://www.tweetdeck.com/">TweetDeck&lt;/a></source>
  *        ....
  */
  //$tweets = $twitter->statuses->public_timeline();


/** Twitter REST API Method: statuses user_timeline
  * ------------------------------------------------------------------------------------------------------------
  * @Description: Return the 20 most recent statuses posted from the authenticating user.
  *              It's also possible to request another user's timeline via the ID parameter. 
  *              This is equivalent of the web / <user> page for your own user, or the profile
  *              page for third party. 
  *
  * URL:          http://api.twitter.com/1/statuses/user_timeline.format
  *
  */
  //$tweets = $twitter->statuses->user_timeline();
  //$tweets = $twitter->statuses->user_timeline(array('screen_name'=>'quicksortv'));


/** Twitter REST API Method: statuses friends_timeline
  * ------------------------------------------------------------------------------------------------------------
  * @Description: Returns the 20 most recent statuses, including retweets,
  *               posted by authenticating user and that user's friends.
  *               This is equivalent of /timeline/home on the web.
  *
  * URL:          http://api.twitter.com/1/statuses/friends_timeline.format
  *
  */
  //$tweets = $twitter->statuses->friends_timeline();
  //$tweets = $twitter->statuses->friends_timeline(array('count'=>3));
  //$tweets = $twitter->statuses->friends_timeline(array('page'=>2));

/** Twitter REST API Method: statuses home_timeline
  * ------------------------------------------------------------------------------------------------------------
  * @Description: Returns the 20 most recent statuses, including retweets, 
  *               posted by authenticating user and that user's friends.
  *               This is equivalent of /timeline/home on the web.
  *
  * URL:          http://api.twitter.com/1/statuses/home_timeline.format
  *
  */
 //$tweets = $twitter->statuses->home_timeline();

/**  Twitter REST API Method: statuses/update
  *  ------------------------------------------------------------------------------------------------------------
  *  @Description: Updates the authenticating user's status. Requires the status parameter specified below. 
  *                Request must be a POST.
  *  HTTP Method: POST
  *  URL: http://api.twitter.com/1/statuses/update.format
  *  FORMAT: XML, JSON
  *  Require Authentication: true
  *  Parameters: status (required)
  *              in_replay_to_status_id (optional)
  *              lat (optional) The location's latitude that this tweet refers to.
  *              lon (optional) The location's longitude that this tweet refers to.
  *              place_id (optional) The place to attach to this status update  
  *              display_coordinates (optional) by default, geo-tweets will have their coordinates exposes in the status object 
  */
  //$tweets = $twitter->statuses->update(array('status'=>'This tweet'.rand(0,300)));
 
/** Twitter REST API Method: direct_messages new 
  *  ------------------------------------------------------------------------------------------------------------
  * @Description: Sends a new direct message to the specified user from the authenticating user. Requires both
  *               the text and user parameters. Request must be a POST. Returns the sent message in the requested
  *               format when successful.
  *               URL: http://api.twitter.com/1/direct_messages/new.format
  *               FORMAT: XML,JSON
  *               Requires Authentication: true
  *               HTTP Methods: POST
  *               Parameters: user (required - the ID or screen name of the recipient user) 
  *                           text (required - the text of your direct message)
  *   Response: 
  *       <?xml version="1.0" encoding="UTF-8"?>
  *        <direct_message>
  *           <id>88619848</id>
  *           <sender_id>1401881</sender_id>
  *             <sender>
  *                 <id>1401881</id>
  *              .....
  *             </sender>
  *           <recipient>
  *             <id>7004322</id>
  *             <name>Doug Williams</name>
  *             <screen_name>igudo</screen_name>
  *               <location>North Carolina</location>
  *           </recipient>
  *        </direct_message>
  */
  //$tweets = $twitter->direct_messages->new(array('user'=>58263325, 'text'=>'the first direct message'));

/** Twitter Search API Method: search
  * -----------------------------------------------------------------------------------------------------
  * @Description: Returns tweets that match a specified query.
  * URL: http://search.twitter.com/search.format
  * Formats: JSON,atom
  * HTTP Method: GET
  * Requires Authentication: false
  * Parameters: -callback (optional). Only available for JSON format. If supplied, the response
  *                                     will use the JSONP format with a callback of the given name.   
  *                     ex: http://search.twitter.com/search.json?callback=foo&q=mootools
  *                -lang (optional)  Restricts tweets to the given language
  *                -max_id (optional)
  *                -q (optional) the text to search for
  *                -rpp (optional) the number of tweets to return per page, up to a max of 100
  *                     ex:  http://search.twitter.com/search.atom?q=devo&rpp=15
  *                -page (optional) page number to return.
  *                -since (optional) returns tweets with since the given date
  *                     ex:  http://search.twitter.com/search.atom?q=twitter&since=2010-02-28
  *                -since_id (optional) returns tweets with status ids greater than a given ID
  *                     ex: http://search.twitter.com/search.atom?q=twitter&since_id=1520639490
  *                -geocode (optional) returns tweets by users located within a given radius of the given
  *                                    latitude/longitude
  *                          ex: http://search.twitter.com/search.atom?geocode=40.757929%2C-73.985506%2C25km
  *                -show_user (optional) when 'true' prepends '<user>'to the beginning of the tweet.This is useful for readers.
  *                -until (optional) returns tweets with generated before the given date.
  *                          ex: http://search.twitter.com/search.atom?q=twitter&until=2010-03-28
  *                -result_type (optional) Specifies what type of search results you would prefer to receive.
  *                             valid values include: mixed, recent, popular.
  *  Notes: Query String should be URL encoded.
  *         Queries are limited 140 URL encoded characters.   
  */
  $tweets = $twitter->search(array('q'=>'mootools','page'=>2));


echo'<pre>';
print_r($tweets);
echo'</pre>';
?>