<?php   
   $oldtime = microtime(true);
   if(isset($_GET['user']) && $_GET['user'] != '') {
       $screen_name = $_GET['user'];
   } else {
       $screen_name = 'codepo8';
   }
   include('twitter.class.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">  
   <title>Get Tweets From Any Twitter User</title>
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
   .wrapper-header-tweets {margin-bottom: 5px}
   #ft{font-size:80%;color:#888;text-align:right;margin:2em 0;font-size: 12px}
   #ft p a{color:#93C37D;}
   </style>
</head>
<body>
<div id="doc" class="yui-t7">
   <div id="hd" role="banner"><h1>Get Tweets From Any Twitter User</h1></div>
   <div id="bd" role="main">
	<div class="yui-g"> 
        <?php 
          $obj = new GetTweetsFrom($screen_name,5,true);
          echo$obj;
          echo"<br/>";       
          $thinkphp = new GetTweetsFrom('anutron',5,true);
          echo$thinkphp;
          echo"<br/>";
          $ydn = new GetTweetsFrom('ydn',5,true);
          echo$ydn;
        ?>
	</div>
	</div>
   <div id="ft" role="contentinfo"><p>Created by @<a href="http://twitter.com/thinkphp">thinkphp</a> | <a href="twitter.class.phps">twitter.class</a> | <a href="source.phps">source</a> | time: <?php echo microtime(true) - $oldtime;?></p></div>
</div>
</body>
</html>