<?php

class TwitterStatus {

      /* Twitter user name */
      public $ID;

      /* tweets to fetch */
      public $count;

      /* widget template */
      public $widgetTemplate; 

      /* template for each tweet */
      public $tweetTemplate;

      /* parse links in Twitter status */
      public $parseLinks;

      /* PHP or 'friendly' dates */
      public $dateFormat;

      /* number of seconds to cache feed */
      public $cacheFor;

      /* location of cache file */
      private $cache;

      /* constructor of class */
      public function __construct($id=null, $count=0) {

             /* cache location */
             $this->cache = dirname(__DIR__) . '/cache/';
             /* cache feed for 15 minutes */
             $this->cacheFor = 900;  
             /* set ID */
             $this->ID = $id;
             $this->count = $count;
             $this->parseLink = true;
             $this->dateFormat = 'friendly';

             /* default widget template */
             $this->widgetTemplate = '<div class="twitterstatus">'.
                                     '<h2><a href="http://twitter.com/{screen_name}"><img src="{profile_image_url}" width="24" height="24" alt="{name}" />{name}</a></h2>'.
                                     '<ul>{TWEETS}</ul>'.
                                     '</div>';

             /* default tweet template */
             $this->tweetTemplate = '<li>{text} <em>{created_at}</em></li>';
           
      }

      /** Fetching the Twitter Feed 
       *  @param none.
       *  @returns JSON-formatted status feed or false on failure. 
       */
      public function fetchFeed() {
            $r = '';
            if($this->ID != '' && $this->count > 0) {
               $c = curl_init();  
               curl_setopt_array($c, array(  
                   CURLOPT_URL => 'http://api.twitter.com/1/statuses/user_timeline/' . $this->ID . '.json?count=' . $this->Count,  
                   CURLOPT_HEADER => false,  
                   CURLOPT_TIMEOUT => 10,  
                   CURLOPT_RETURNTRANSFER => true  
               ));  
               $r = curl_exec($c);  
               curl_close($c);  
            }
          /* return JSON as array */
          return (!!$r ? json_decode($r, true) : false); 
      }   

      /* returns formatted feed widget */
      public function render() {

         /* returned HTML string */   
         $render = '';

         /* cache file available */
         $cache = $this->cache . $this->ID . '_' . $this->count . '.html';

         /* we can calculate the number of seconds which have expired since the file was created (assuming it exists) */
         $cacheage = (file_exists($cache) ? time() - filemtime($cache) : -1 );

         /* if the file doesn't exists or the number of seconds is greater than  $cacheFor 
          * we need to re-generate the HTML widget cache file. 
          */
         if($cacheage < 0 || $cacheage > $this->cacheFor) {

              /* fetch feed */
              $json = $this->fetchFeed();

              if($json) {
                 
                 $widget = '';
                 $status = '';

                 /* examine all tweets */ 
                 for($i=0, $j=count($json); $i<$j; $i++) {

                     if($i == 0) {
 
                        $widget .= $this->parseStatus($json[$i], $this->widgetTemplate);
                     }

                     $status .= $this->parseStatus($json[$i], $this->tweetTemplate);

                 }//endfor

                 $render = str_replace('{TWEETS}', $status, $widget); 

                 /* if the HTML is correctly generated in our $render string, 
                    we can save it to our cache file 
                  */
                 file_put_contents($cache, $render);
              }

         }//endif

         /*
          * the $render string will be empty if a valid cache file exists.
          * it will be empty if the Twitter API call falls; 
          * in that situation, we'll retrieve the last available cached file.
          * fetch from cache file.
          */
         if($render == '' && $cacheage > 0) {

            $render = file_get_contents($cache);
         }
 
         /* 
          * to complete our method, we return $render to the calling code. However, we must
          * parse the dates first.
          */
         return $this->parseDates($render);

      }

      /* parses tweets data */
      private function parseStatus($data, $template) {

         /* replace all {tags} */
         preg_match_all('/{(.+)}/U', $template, $m);

         for($i=0,$j=count($m[0]);$i<$j;$i++) {
     
             $name = $m[1][$i];
  
             /* twitter value found */ 
             $d = false;
             if(isset($data[$name])) {
                $d = $data[$name]; 
             } else if(isset($data['user'][$name])) {
                $d = $data['user'][$name]; 
             }

             /* replace data */
             if($d) {

                switch($name) {

                    /* parse status links */
                    case 'text': 
                         if($this->parseLink) {
                            $d = ($this->parseLinks($d));
                         }
                    break;

                    case 'created_at':
                         $d = "{DATE:$d}";
                    break;
                }   

                $template = str_replace($m[0][$i], $d, $template);
             }//endif
         }//endfor

         return $template;
      }

      /* parses tweets dates */
      private function parseDates($str) {

           preg_match_all('/{DATE:(.+)}/U', $str, $m); 
           $version = phpversion();

           if($version < '5.3.0') {

              $now = time();
               
              for($i=0,$j=count($m[0]);$i<$j;$i++) {

                  $twTime = strtotime($m[1][$i]);

                  $ival = $now - $twTime;

                  if($this->dateFormat === 'friendly') {

                        switch(true) {

                            case ($ival < 10):
                                $strTime = 'just now';  
                                break;  

                            case ($ival <= 60):
                                /* this is less than a minute */
                                $ival = ($ival === 1) ? $ival . ' secod' : $ival . ' seconds';
                                $strTime = $ival . ' ago';    
                                break;  

                            case ($ival <= (60*60)):
                                /* this is less than an hour */
                                $minutes = round($ival/60, 0);
                                $minutes = ($minutes === 1) ? $minutes . ' minute' : $minutes . ' minutes';
                                $strTime = $minutes . ' ago';
                                break;


                            case ($ival <= (60*60*24)):
                                /* this is less than a day */ 
                                $strHours = explode(".", ($ival/(60*60)));
                                $hours = ($strHours[0] === 1) ? round($strHours[0],0) . ' hour' : round($strHours[0],0) .' hours';
                                $minutePercent = $strHours[1];
                                $minutes = str_split($minutePercent, 2);
                                $minutes = round(($minutes[0]/100)*60, 0);  
                                $minutes = $minutes === 1 ? $minutes .' minute' : $minutes . ' minutes';   
                                $strTime = $hours . ' '. $minutes . ' ago'; 
                                break;
           

                            case ($ival > (60*60*24)):
                                /* this is more than a day */ 
                                $strDays = explode(".", ($ival/(60*60*24)));
                                $days = ($strDays[0] === '1') ? round($strDays[0],0) . ' day' : round($strDays[0],0) .' days';
                                $hourPercent = $strDays[1];
                                $hours = str_split($hourPercent, 2);
                                $hours = round(($hours[0]/100)*24,0);
                                $hours = ($hours === 1) ? $hours . ' hour' : $hours . ' hours';
                                $strTime = $days . ' ' . $hours . ' ago'; 
                                break;                               

                        }//endswitch 

                  
                  //stardard date format PHP
                  } else {

                  }

                  $str = str_replace($m[0][$i], $strTime, $str);

              }//endfor

           } else {

           }             

        return $str;  
      }

      /* Parses tweets links */ 
      private function parseLinks($str) {

         //parse URL
         $str = preg_replace('/(https{0,1}:\/\/[\w\-\.\/#?&=]*)/','<a href="$1">$1</a>',$str);
         //parse @ID
         $str = preg_replace('/@(\w+)/','@<a href="http://twitter.com/$1" class="at">$1</a>',$str);
         //parse #hashtag
         $str = preg_replace('/\s#(\w+)/',' <a href="http://twitter.com/#!/search?q=%23$1" class="hashtag">#$1</a>',$str);

        return $str;  
      }
}
?>