<html>
	<head>
		<title>Twitter Search</title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<link rel="stylesheet" href="http://bootswatch.com/amelia/bootstrap.min.css" />
		<link rel="stylesheet" href="twitter.css" />
	<head>
	<body>
		<div class="container">
			<div class="row span12">
				<h1 class="span3"><a href="index.php">Twitter</a></h1>
				<form class="span7 offset1" id="search" action="index.php" method="POST">
					<input style="margin: 2px 10px 0px 10px;" name="search" type="text"/>
					<input style="margin-top: 8px;" type="submit" value="Search!" />
				</form>
			</div>
			<div class="row span12">
				<div class="span6">
					<h2>Presenting to you...</h2>
					<div class="well">
						<div class="row">
							<img class="span1" src="<?php echo$user_tweets[0]->user->profile_image_url ?>"/>
							<h2 class="span4"><a target="_blank" href="https://twitter.com/#!/<?php $username ?>"><?= $username ?></a></h2>
						</div>
						<div class="row">
							<p class="span5"><?php echo$user_tweets[0]->user->description ?></p>
						</div>
					</div>
				</div>
				<div class="span5">
					<h2>How <?php echo$query;?> crazy?</h2>
					<div class="well">
						<p>Out of <?php echo$username ?>'s last 100 tweets <?php echo$count ?> were about <?php echo$query;?>!<p>
						<?php for($i=0; $i<$count; $i++): ?>
							<img class="cute" src="http://www.delawaregirlsinitiative.org/wp-content/uploads/2012/01/kitten-50x50.jpg" />
						<?php endfor; ?>
					</div>
				</div>
			</div>
			<div id="results" style="margin-top: 10px;">
                        <?php if($count!=0) { ?>
				<h2 style="margin-left: 38px;">Their tweets about <?php echo$query;?></h2>
                        <?php } ?>  			                    
				<div class="row span12">
					<?php if($count!=0) { ?>
						<?php for($i=0; $i<($count/2)+1; $i++): ?>
							<?php for($k=$i*2; $k<($i*2+2) && $k<$count; $k++): ?>
								<?php $cat=$cat_tweets[$k]; ?>
								<div class="span5 well">
									<div class="row">
										<p class="span5"><?php echo$cat->text ?></p>
									</div>
								</div>
							<?php endfor; ?>
						<?php endfor; ?>
					<?php } else { ?>
                                    <h3 style="margin-left: 20px;">No Tweets</h3>
					<?php } ?>
				</div>
			</div>
		</div>
	</body>
</html>