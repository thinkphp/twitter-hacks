<?php

    class FileIterator {

          public $filename;
          public $fp;

          public function __construct($filename) {
                 $this->filename = $filename;
          }  

          public function fetch() {
                 if(!$this->fp) {
                     $this->fp = fopen($this->filename,"r"); 
                 }

                 if(($row=fgets($this->fp,4069)) !== false) {
                     return $row;
                 } else {
                     fclose($this->fp);
                     $this->fp = NULL;
                     return false;  
                 }
          }
    }

    $source = new FileIterator("index.php");

    while(($line=$source->fetch()) !== false) {
           echo$line."<br>"; 
    }

 
?>