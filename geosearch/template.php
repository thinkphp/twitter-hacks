<html>
	<head>
		<title>Geo Twitter Search</title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<link rel="stylesheet" href="http://bootswatch.com/amelia/bootstrap.min.css" />
		<link rel="stylesheet" href="twitter.css" />
	<head>
	<body>
		<div class="container">
			<div class="row span12">
				<h1 class="span3"><a href="index.php">Twitter Search!</a></h1>
				<form class="span7 offset1" id="search" action="index.php" method="POST">
					<input name="search" id="search" type="text"/>
					<input style="margin-top: 8px;" type="submit" value="Search!" />
				</form>
			</div>
			<div id="results" style="margin-top: 10px;">
				<?php for($i=0; $i<$length/2; $i++): ?>
				<div class="row span12">
					<?php for($k=$i*2; $k<($i*2+2) && $k<$length; $k++): ?>
						<?php $cat=$out->results[$k]; ?>
						<div class="span5 well">
							<div class="row">
								<img class="span1" src="<?php echo$cat->profile_image_url ?>"/>
								<h2 class="span4"><a href="twitteruser.php?username=<?php echo$cat->from_user ?>&what=<?php echo$query; ?>"><?php echo$cat->from_user ?></a></h2>
							</div>
							<div class="row">
								<p class="span5"><?php echo$cat->text ?></p>
							</div>
						</div>
					<?php endfor; ?>
				</div>
				<?php endfor; ?>
			</div>
		</div>
	</body>
</html>