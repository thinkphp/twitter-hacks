<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
   <meta content="text/html; charset=UTF-8" http-equiv="content-type">
   <title>Twitter.status.class</title>
   <link rel="stylesheet" href="http://yui.yahooapis.com/2.8.0r4/build/reset-fonts-grids/reset-fonts-grids.css" type="text/css">
   <link rel="stylesheet" href="http://yui.yahooapis.com/2.7.0/build/base/base.css" type="text/css">
   <link rel="stylesheet" type="text/css" media="all" href="twitter.widget.css" />
   <style type="text/css">
   pre {padding: 10px;margin-left: 10px}
   pre code {background: none repeat scroll 0 0 #FFFFCC;}
   </style>
</head>
<body>
<div id="doc" class="yui-t7">
   <div id="hd" role="banner"><h1>Twitter Status Widget</h1></div>
   <div id="bd" role="main">
	<div class="yui-g">
<?php
    require_once('twitter.class.php');
    $ob = new TwitterStatus('thinkphp',10);
    echo$ob->render();
?>

<pre><code>
&lt;?php
    require_once('twitter.class.php');
    $ob = new TwitterStatus('thinkphp',10);
    echo$ob->render();
?&gt;

The features include:

- any number of widgets can be added to any page.
- any number of status items can be shown.
- any Twitter data items can be used.
- the widget HTML code is fully configurable.
- the feed is cached (for 15 minutes by default).
- URLs, @ids and #hashtags can be converted to HTML links.
- dates can be converted to friendly format.

Optionally, you can now change any of the public properties:

- ID =>the Twitter ID name;
- count =>the number of status updates.
- widgetTemplate =>the widget HTML. This can include any number of 
  {named-values} in the Twitter feed. One {TWEETS} value must also 
  be included as the placeholder for all statuses. 
- tweetTemplate =>the HTML for an individual tweet. Any number of 
  {named-values} can be included.
- parseLinks =>set TRUE to convert URLs, @ids, #hashtags to HTML 
  links (default to true).
- dateFormat =>the status date format using PHP date 
  notation or "friendly (by default)"
- cacheFor =>the number of seconds a feed is cached for 
  (default is 900 = 15 minutes).
</code></pre> 
	</div>
	</div>
   <div id="ft" role="contentinfo"><p>Written by @<a href="http:/twitter.com/thinkphp">thinkphp</a></p></div>
</div>
</body>
</html>