<?php

/**  @Description:
  *               with this quick hack class you can get a number of tweets 
  *               for a given twitter screen name formatted HTML. 
  *  @Author:     Adrian Statescu Dumitru
  *  --------------------------------------------------------------------- 
  *  @Methods: 
  *             __construct() (public) - constructor of class. initialize the object with passed actual parameters.
  *             _retrieve_status (private) - call api twitter for timeline tweets
  *             _getTweets (private) - get timeline tweets
  *             _tweetify (private) - tweetify the text of the screen user
  *             __toString (public) - it is worth noting that I used this magical method
  */
class GetTweetsFrom {
 
  /* data members */
  private $data;
  private $url = "http://api.twitter.com/1/statuses/user_timeline/";
  public $screen_name = 'thinkphp';
  public $number_of_tweets = 5;   
  public $tweetify = FALSE;

  /** @constructor of class  
    *   @public
    *   @param (String) $username screen name of the Twitter user
    *   @param (Integer) $number number of tweets for that screen name
    *   @param (boolean) $tweetify true wheather you want to tweetify the text (tweet) of the user and false for not.
    *   @return none. init data members with actual parameters passed.
    */
  public function __construct($username,$number,$tweetify) {

        $this->screen_name = $username;
        $this->number_of_tweets = $number;
        $this->tweetify = $tweetify;
        $this->data = $this->_getTweets($username,$number,$tweetify);           
  }

  /** @description
    *             make API call Twitter for users timeline XML
    * @private
    * @param      $twitter_id (String) screen name of the user
    * @return     Object SimpleXMLElement that contains data about user  
    */
  private function _retrieve_status($twitter_id) {

        $url = $this->url.$twitter_id.".xml";
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
     * @private
     * @param $text (String) 
     * @return $newtext (String) same text but tweetified
     */ 
   private function _tweetify($text) {

       $text = preg_replace("/(https?:\/\/[\w\-:;?&=+.%#\/]+)/i", '<a href="$1">$1</a>',$text);
       $text = preg_replace("/(^|\W)@(\w+)/i", '$1<a href="http://twitter.com/$2">@$2</a>',$text);
       $text = preg_replace("/(^|\W)#(\w+)/i", '$1#<a href="http://search.twitter.com/search?q=%23$2">$2</a>',$text); 

      return $text;
    }

  /** @private
    * @param $screen_name (String) the screen name of the desired user from Twitter
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
    function _getTweets($screen_name,
                        $count=3,
                        $tweetify=false,
                        $dateFormat="D jS M y H:i",
                        $timeZone="Europe/Bucharest",
                        $beforeHTML="<div class='wrapper-content-tweets'><ul>",
                        $startHTML="<li class=\"tweet\"><span class=\"tweet-status\">",
                        $oddHTML="<li class=\"tweet-odd\"><span class=\"tweet-status\">",
                        $middleHTML="</span><br/><span class=\"tweet-details\">",
                        $endHTML="</span></li>",
                        $afterHTML="</ul></div><!-- end wrapper content tweets -->"
                       ) {


        date_default_timezone_set($dateTimeZone);
        
        if($statuses = $this->_retrieve_status($screen_name)) {

               $wrapper_head_start = '<div class="wrapper-header-tweets">'; 
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
               $wrapper_head_end = '</div><!-- end wrapper header tweets -->';

               $header_content = $wrapper_head_start.$about.$map.$wrapper_head_end;

               $output = $header_content.$beforeHTML; 

               $i = 0;

               foreach($statuses as $key=>$status) {  

                    ++$i; 

                    if($tweetify) {

                      if(substr_count($status->text,'@') != 0 | substr_count($status->text,'#') != 0 | substr_count($status->text,'http://') != 0) {

                        $tweet = $this->_tweetify($status->text);

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

    }//end method

    /**
      * @description:
      *              This method allows a class to decide how it 
      *              will react when it is converted to a string.
      */
    public function __toString() {
        
           return $this->data;
    }

 }//end class GetTweetsFrom
?>
