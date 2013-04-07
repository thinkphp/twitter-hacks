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
   #f{background: #eefcf5;margin-bottom: 10px;border-top: -10px;padding: 10px}   
   .about-screen-name{padding: 4px;margin: 3px;float: left}
   .wrapper-header-tweets {margin-bottom: 5px}
   input[type="submit"]  {-moz-border-radius:10px 10px 10px 10px;background:none repeat scroll 0 0 #447E40;border:1px solid #447E40;color:#FFFFFF;cursor:pointer;margin-left:10px;padding:0.1em;}
   input[type="submit"]:hover{background: #fff;color: #447E40}
   #ft{font-size:80%;color:#888;text-align:right;margin:2em 0;font-size: 12px}
   #ft p a{color:#93C37D;}
   </style>
</head>
<body>
<div id="doc" class="yui-t7">
   <div id="hd" role="banner"><h1>Get Tweets From Any User Twitter</h1></div>
   <div id="bd" role="main">
        <div class="yui-g">
         <form name="f" id="f" action="<?php echo$_SERVER['PHP_SELF']?>" method="get">
            <label for="user">User Twitter </label> <input type="text" id="user" name="user" value=""/>
            <input type="submit" value="get Tweets"/>
         </form>
        </div><!-- end yui-g -->
        <div class="yui-g">
        <?php 
            $obj = new GetTweetsFrom($screen_name,10,true);
            echo$obj; 
        ?>
        </div>
     </div>
   <div id="ft" role="contentinfo"><p>Created by @<a href="http://twitter.com/thinkphp">thinkphp</a> | <a href="twitter.class.phps">twitter.class</a> | Time: <?php echo microtime(true) - $oldtime;?></p></div>
</div>
</body>
</html>