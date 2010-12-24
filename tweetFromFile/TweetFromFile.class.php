<?php
/** @Description:
  *              Tweet From File 
  *
  * @Data Members
  *              @private $curlHandle (Resource);
  *              @private $updateFile (String);
  *              @private $archiveFile (String);
  *              @public  $files (Array);
  *              @public  $url (String) url call api Twitter to update status
  *
  * @Methods:  
  *         @public __construct($username,$password,$pathfile);
  *         @public __destruct($username,$password,$pathfile);
  *         @public updateStatus(); 
  *         @private _getNewStatus();
  * @Usage: 
  *        $tweet = new TweetFromFile("username","password","path.file");
  *        $send = $tweet->updateStatus();
  *        if($send) {
  *           echo "Twitter Updated";
  *        } else {
  *           echo "Twitter seems to be unavailable at the moment...";
  *        } 
  */

class TweetFromFile {
 
       private $curlHandle;
       private $updateFile;
       private $archiveFile;
       public $files = array('upcoming'=>'', 'archive'=>'');
       public $url = "http://twitter.com/statuses/update.xml";

       public function __construct($username,$password,$filename) {

           $this->curlHandle = curl_init();
           $this->files['upcoming'] = $filename;   
           $this->files['archive'] = 'ARCHIVE_'.$filename;

           //make a shortcut
           $ch = $this->curlHandle;
           $url = $this->url;

           curl_setopt($ch,CURLOPT_URL,$url); 
           curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); 
           curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,2); 
           curl_setopt($ch,CURLOPT_POST,1); 
           curl_setopt($ch,CURLOPT_USERPWD,"$username:$password"); 

       }      

       public function __destruct() {

           curl_close($this->curlHandle);   
       }

       private function _getNewStatus() {

           $upcomingTweetsFile = $this->files['upcoming'];   
           $archivedTweetsFile = $this->files['archive'];

           $handleFile = fopen($upcomingTweetsFile,"r");

           //read contents from file
           $contents = fread($handleFile,filesize($upcomingTweetsFile));

           //split contents
           $splitContents = preg_split('/\n/',$contents,2);

           //archive old status
           $handleArchive = fopen($archivedTweetsFile,"w"); 
           fwrite($handleArchive,$splitContents[0]."\n");

           //remove top line from upcoming
           $handle = fopen($upcomingTweetsFile,"w"); 
           fwrite($handle,$splitContents[1]);
             
           //close files
           fclose($handleFile); 
           fclose($handleArchive); 
           fclose($handle);

         return $splitContents[0];
       }

       public function updateStatus() {

           $status = $this->_getNewStatus();

           curl_setopt($this->curlHandle,CURLOPT_POSTFIELDS,"status=$status");

           $result = curl_exec($this->curlHandle);

           $infos = curl_getinfo($this->curlHandle);

                  if($infos['http_code'] == 200) {

                      return true; 
                  }

           return false;  
       }
}//end class
?>