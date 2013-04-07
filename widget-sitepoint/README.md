Twitter Status Widget
=====================

![Screenshot](http://farm6.static.flickr.com/5241/5362879371_b8bbb3e467_b.jpg)

How to create your own Twitter Widget in PHP. It's a great introduction to PHP, REST APIs, JSON, regular expressions and
Object Oriented Programming. Our objectives are to:

- interrogate the Twitter API and fetch any number of status updates for an individual user.
- apply the data to a configurable HTML template and convert URLs, @id and #hashtags to proper links.
- format dates into a friendlier format, e.g. posted ten minutes ago, yesterday, two weeks ago, etc...
- cache the widget HTML so the fetching process is not required during every page load.
- make the resulting widget work in all browsers - yes, that includes IE6.

Twitter REST API: https://api.twitter.com/1/statuses/user_timeline/thinkphp.json?count=10