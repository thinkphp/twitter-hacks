<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
   <title>Test Twitter Friendships</title>
   <link rel="stylesheet" href="http://yui.yahooapis.com/2.8.0r4/build/reset-fonts-grids/reset-fonts-grids.css" type="text/css">
   <link rel="stylesheet" href="http://yui.yahooapis.com/2.7.0/build/base/base.css" type="text/css">
   <style type="text/css">
    html,body{color:#fff;background:#222;font-family:calibri,verdana,arial,sans-serif;font-size: 17px}
    h1{font-size:300%;margin:0;text-align:left;color:#3c3}
    h2{background:#369;padding:5px;color:#fff;font-weight:bold;-moz-box-shadow: 0px 4px 2px -2px #000;-moz-border-radius:5px;-webkit-border-radius:5px;text-shadow: #000 1px 1px}
    h3 a{color:#69c;text-decoration:none;}
    #ft a {color: #369}
   </style>
</head>
<body>
<div id="doc" class="yui-t7">
   <div id="hd" role="banner"><h1>Test Twitter Friendships with PHP</h1></div>
   <div id="bd" role="main">      
	<div class="yui-g">
      <p>Another awesome functionality provided by Twitter is the ability to test friendships between two people.</p>
      <h2>The response in format XML => using preg_match => &lt;friends>true&lt;/friends&gt; | &lt;friends&gt;false&lt;/friends&gt;</h2>

      <form action="<?php echo$_SERVER['PHP_SELF'];?>" method="get">
      <label for="person1">user_a</label> <input type="text" name="person1" value="<?php echo$_GET['person1'];?>" />
      <label for="person2">user_b</label> <input type="text" name="person2" value="<?php echo$_GET['person2'];?>" />
      <input type="submit" name="test" value="test friendship">
      </form>

<?php
    $person1 = isset($_GET['person1']) ? $_GET['person1'] : 'thinkphp';
    $person2 = isset($_GET['person2']) ? $_GET['person2'] : 'mootools';
    $url = "http://twitter.com/friendships/exists";
    $format = "xml";
    $url2 = sprintf("$url.%s?user_a=%s&user_b=%s",$format,$person1,$person2);  
    $url = $url.'.'.$format.'?user_a='.$person1.'&user_b='.$person2;
    $person12 = get($url2);
    $match = get_match('/<friends>(.*)<\/friends>/isU',$person12);     
    echo"<h2><strong>$person1</strong> is friend with <strong>$person2</strong>? $match</h2>";
    function get($url) {
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);  
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,2);
        $data = curl_exec($ch);
        curl_close($ch);
        if(empty($data)) {
           return 'System timeout!';
        } else {
           return $data; 
        }
    }
    function get_match($regexp,$content) {
        preg_match($regexp, $content, $matches);
      return $matches[1]; 
    }
?>


	</div>
	</div>
   <div id="ft" role="contentinfo"><p>@<a href="http://twitter.com/thinkphp">thinkphp</a> | <a href="code.php">source</a></p></div>
</div>
</body>
</html>