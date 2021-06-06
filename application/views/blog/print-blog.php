<?php
	$cover_image = get_rows(array("table"=>"media", "limit"=>1), array("type"=>"Slider Image"));
	$cover_image = (isset($cover_image['id']) && file_exists("./{$cover_image['url']}")) ? base_url() . "{$cover_image['url']}" : base_url() . "img/cover.png";
?>
<html>
	<head>
		<title><?= $blog_data['title']; ?></title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
		<style type="text/css">
			body {
				font-size: 14px;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div style="margin-bottom: 10px;">
				<img class="img-responsive" src="<?= $cover_image; ?>" />
			</div>

			<?php
			foreach ($blog_data['images'] as $key => $image) {
				$image = (!empty($image['image']) && file_exists("./uploads/news/{$image['blog_id']}/{$image['image']}")) ? base_url()."uploads/news/{$image['blog_id']}/{$image['image']}" : base_url() . "img/blank.jpg";
			?>
			<div style="margin-bottom: 10px;">
				<img class="img-responsive" src="<?= $image; ?>" />
			</div>
			<?php } ?>
			
			<h2 style="font-size: 28px;"><?= $blog_data['title']; ?></h2>
			<hr style="margin-bottom: 10px; margin-top: 10px;" />
			<div id="news_details">
				<?= $blog_data['details']; ?>
			</div>

			<hr style="margin-bottom: 10px; margin-top: 10px;" />

			<div class="row">
				<div class="col-xs-4">
					<!-- <img class="img-responsive" alt="footer logo" src="<?= base_url(); ?>img/logo.png" /> -->
				</div>
				<div class="col-xs-4">
					<?php if(isset($footer_address['description'])) echo $footer_address['description']; ?>
				</div>
				<div class="col-xs-4">
					<?php if(isset($footer_copyright['description'])) echo $footer_copyright['description']; ?>
				</div>
			</div>
		</div>

		<script type="text/javascript">
			$(document).ready(function() {
				$('#news_details img').each(function() {
					$(this).addClass('img-responsive img-thumbnail');
				});
				
				window.print();
			});
		</script>
	</body>
</html>