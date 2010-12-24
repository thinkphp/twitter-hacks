getTweets
---------

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
        echo$obj; 
        ?>