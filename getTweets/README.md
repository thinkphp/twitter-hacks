getTweets
---------
This class based on PHP can be used to get formated XHTML containing an avatar, the location, n number of tweets for a given Twitter user.

![Screenshot](http://farm6.static.flickr.com/5090/5287726320_8a79e7b214_b.jpg)

How to use:
-----------
 
        <?php  
        //include twitter.class API
        include('twitter.class.php');
        //enter screen name
        $screen_name = 'thinkphp';
        //enter number of tweets  
        $amount = 10; 
        //true/false for linkify the tweets
        $obj = new GetTweetsFrom($screen_name,$amount,true);
        //echo the object
        echo$obj; 
        ?>

You can view in action: 

* [http://thinkphp.ro/apps/php-hacks/twitter-hacks/getTweets/v1.0/](http://thinkphp.ro/apps/php-hacks/twitter-hacks/getTweets/v1.0/)
* [http://thinkphp.ro/apps/php-hacks/twitter-hacks/getTweets/v1.1/](http://thinkphp.ro/apps/php-hacks/twitter-hacks/getTweets/v1.1/)
* [http://thinkphp.ro/apps/php-hacks/twitter-hacks/getTweets/v1.3/](http://thinkphp.ro/apps/php-hacks/twitter-hacks/getTweets/v1.3/)
