<style type="text/css">
	.nav-tabs {
		border-bottom: 1px solid #565c5c;
	}
	.nav-tabs li.active {
		border-bottom: 2px solid #df384c;
	}

.table-cal {
	width: 100%;
}

.table-cal tbody tr td {
	border: 3px solid #f3f3f3;
	text-align: center;
}
.table-cal .day-number {
	margin: 2px;
}
.table-cal .calendar-day-head {
	margin: 3px;
	padding: 5px;
}
.holiday-head {
	background-color: #eb9193;
}
.holiday {
	background-color: #ea1b21;
	color: #FFFFFF;
}
.current-day {
	background-color: #3071a9;
	color: #FFFFFF;
}
.bg-28374e, .bg-28374e a {
	background-color: #28374e;
	color: #FFFFFF;
}
.bg-7e7e7e {
	background-color: #7e7e7e;
	color: #FFFFFF;
}
.bg-0f64b5, .bg-0f64b5 a {
	background-color: #0f64b5;
	color: #FFFFFF;
}
.active-day {
	background-color: #0f64b5;
	color: #FFFFFF;
}
</style>
<?php
	$advertisement = cur_advertisement(array("position"=>"Right Sidebar 1", "enabled"=>1), array("table"=>"advertisement", "limit"=>1));
	if($advertisement) echo "{$advertisement}<br />";
?>

<?php
$filters = array("blog.enabled"=>1, "blog.type"=>"List");
$get_category_data = get_rows(array("table"=>"blog_groups", "limit"=>1), array("category"=>"সম্পাদকীয়", "parent_id"=>0));
if(isset($get_category_data['id'])) $filters['blog_categories.category_id'] = $get_category_data['id'];
$get_data = get_news_list($filters, 1);
if(isset($get_data['id'])) {
	$url = site_url("article/{$get_data['id']}");
?>
<div style="border: 3px solid #e31723; margin-bottom: 15px;">
	<div class="row">
		<div style="padding-right: 0;" class="col-md-4">
			<a href="<?= $url; ?>">
				<img style="height: 115px;" class="img-responsive" alt="<?= $get_data['title']; ?>" src="<?= $get_data['default_image']; ?>" />
			</a>
		</div>
		<div class="col-md-8">
			<h4 style="margin-top: 0; padding-top: 10px; color: green; font-size: 26px;">সম্পাদকীয়</h4>
			<h2 style="font-size: 16px; margin-top: 0; font-weight: bold;"><a href="<?= $url; ?>"><?= $get_data['title']; ?></a></h2>
			<a href="<?= $url; ?>">
				<p><?= word_limiter(strip_tags($get_data['details']), 20, ' '); ?></p>
			</a>
		</div>
	</div>
</div>
<?php /*
<div style="border: 3px solid #e31723;">
	<div style="height: 55px;">
		<a href="<?= $url; ?>">
			<img style="height: 55px; width: 75px; float: left; margin-right: 8px; padding: 2px;" class="<?= $get_data['img_thumbnail']; ?>" alt="<?= $get_data['title']; ?>" src="<?= $get_data['default_image']; ?>" />
		</a>
		<h4 style="margin-top: 0; padding-top: 10px; color: green; font-size: 26px;">সম্পাদকীয়</h4>
	</div>
</div>
<div class="clearfix"></div>
<div style="margin-top: 6px;">
	<a href="<?= $url; ?>">
		<p><?= word_limiter(strip_tags($get_data['details']), 30, ' '); ?></p>
	</a>
</div> */ ?>
<?php } ?>

<?php
$filters = array("blog.enabled"=>1, "blog.type"=>"List");
$get_category_data = get_rows(array("table"=>"blog_groups", "limit"=>1), array("category"=>"উপসম্পাদকীয়", "parent_id"=>0));
if(isset($get_category_data['id'])) $filters['blog_categories.category_id'] = $get_category_data['id'];
$get_data = get_news_list($filters, 1);
if(isset($get_data['id'])) {
	$url = site_url("article/{$get_data['id']}");
?>
<div style="border: 3px solid #e31723; margin-bottom: 15px;">
	<div class="row">
		<div style="padding-right: 0;" class="col-md-4">
			<a href="<?= $url; ?>">
				<img style="height: 115px;" class="img-responsive" alt="<?= $get_data['title']; ?>" src="<?= $get_data['default_image']; ?>" />
			</a>
		</div>
		<div class="col-md-8">
			<h4 style="margin-top: 0; padding-top: 10px; color: green; font-size: 26px;">উপসম্পাদকীয়</h4>
			<h2 style="font-size: 16px; margin-top: 0; font-weight: bold;"><a href="<?= $url; ?>"><?= $get_data['title']; ?></a></h2>
			<a href="<?= $url; ?>">
				<p><?= word_limiter(strip_tags($get_data['details']), 20, ' '); ?></p>
			</a>
		</div>
	</div>
</div>
<?php } ?>

<?php
$filters = array("blog.enabled"=>1, "blog.type"=>"List");
$get_category_data = get_rows(array("table"=>"blog_groups", "limit"=>1), array("category"=>"সাক্ষাৎকার", "parent_id"=>0));
if(isset($get_category_data['id'])) $filters['blog_categories.category_id'] = $get_category_data['id'];
$get_data = get_news_list($filters, 1);
if(isset($get_data['id'])) {
	$url = site_url("article/{$get_data['id']}");
?>
<div style="border: 3px solid #e31723;">
	<div class="row">
		<div style="padding-right: 0;" class="col-md-4">
			<a href="<?= $url; ?>">
				<img style="height: 115px;" class="img-responsive" alt="<?= $get_data['title']; ?>" src="<?= $get_data['default_image']; ?>" />
			</a>
		</div>
		<div class="col-md-8">
			<h4 style="margin-top: 0; padding-top: 10px; color: green; font-size: 26px;">সাক্ষাৎকার</h4>
			<a href="<?= $url; ?>">
				<p><?= word_limiter(strip_tags($get_data['details']), 20, ' '); ?></p>
			</a>
		</div>
	</div>
</div>
<?php } ?>

<br />
<?php // echo news_instant(array("category"=>"মতামত", "top"=>1)); ?>
<style type="text/css">
.nav-green {
	background-color: #008000;
}
.nav-green li a {
	color: #fff;
}
</style>
<div class="well">
  	<ul class="nav nav-tabs nav-green" role="tablist">
    	<li role="presentation" class="active"><a href="#latest" aria-controls="home" role="tab" data-toggle="tab">সর্বশেষ</a></li>
    	<li role="presentation"><a href="#mostread" aria-controls="profile" role="tab" data-toggle="tab">সর্বাধিক পঠিত</a></li>
  	</ul>

  	<div class="tab-content">
    	<div role="tabpanel" class="tab-pane active" id="latest">
    		<?php
    		$latest_news = get_news_list(array("blog.enabled"=>1, "blog.type"=>"List"), 8);
    		$total_latest_news = count($latest_news);
			$i = 0;
    		foreach ($latest_news as $key => $row) {
    			$url = site_url("article/{$row['id']}");
    		?>
			<div class="right-sidebar">
				<a href="<?= $url; ?>">
					<img style="height: 65px; width: 85px; float: left; margin-right: 8px;" class="<?= $row['img_thumbnail']; ?>" alt="<?= $row['title']; ?>" src="<?= $row['default_image']; ?>" />
				</a>
				<h2 style="font-size: 16px; font-weight: bold; margin-top: 10px;"><a href="<?= $url; ?>"><?= $row['title']; ?></a></h2>
				<span class="time-12">
					<?php
						$month = $this->bangla_week_day->get_monthname(date("F", $row['time']));
						echo $this->bangla_number->convert(date("d {$month}, Y H:i", $row['time']));
					?>
				</span>
			</div>
			<div class="clearfix"></div>
			<?php
			$i++;
			if($i != $total_latest_news) echo "<hr class=\"hr-5\" />";
			} ?>

			<br />
    	</div>
    	<div role="tabpanel" class="tab-pane" id="mostread">
    		<?php
    		$mostreaded_news = mostreaded_news(array("blog.enabled"=>1, "blog.type"=>"List"), 8);
    		$total_mostreaded_news = count($mostreaded_news);
			$i = 0;
    		foreach ($mostreaded_news as $key => $row) {
    			$url = site_url("article/{$row['id']}");
    		?>
			<div>
				<a href="<?= $url; ?>">
					<img style="height: 65px; width: 85px; float: left; margin-right: 8px;" class="<?= $row['img_thumbnail']; ?>" alt="<?= $row['title']; ?>" src="<?= $row['default_image']; ?>" />
				</a>
				<h2 style="font-size: 16px; font-weight: bold; margin-top: 10px;"><a href="<?= $url; ?>"><?= $row['title']; ?></a></h2>
				<span class="time-12">
					<?php
						$month = $this->bangla_week_day->get_monthname(date("F", $row['time']));
						echo $this->bangla_number->convert(date("d {$month}, Y H:i", $row['time']));
					?>
				</span>
			</div>
			<div class="clearfix"></div>
			<?php
			$i++;
			if($i != $total_mostreaded_news) echo "<hr class=\"hr-5\" />";
			} ?>

			<br />
    	</div>
  	</div>
</div>

<?php
	$advertisement = cur_advertisement(array("position"=>"Right Sidebar 2", "enabled"=>1), array("table"=>"advertisement", "limit"=>1));
	if($advertisement) echo "{$advertisement}<br />";
?>

<?php // echo today_prayer(); ?>


<?php
$poll_data = cur_poll();
if(isset($poll_data['id'])) {
	$url = non_english_url_title(strip_tags($poll_data['poll']));
	$url = site_url("poll/{$poll_data['id']}/{$url}");
?>
<div class="new-title">
	<div class="title-left">
		<a href="#">
			আজকের জরিপ
		</a>
	</div>
	<div class="title-border"></div>
</div>
<div class="clear-fix"></div>

<div class="well">
	<?= nl2br($poll_data['poll']); ?>
	
	<form id="validate-poll" action="<?= site_url("ajax/poll"); ?>" method="post">
		<?php foreach ($poll_data['options'] as $key => $option) { ?>
		<div class="radio">
			<label>
		      	<input name="option" value="<?= $option['id']; ?>" type="radio"> <?= $option['option']; ?>
		    </label>
		</div>
		<?php } ?>
		<div class="form-group">
			<div class="pull-left">
				<input type="hidden" name="poll_id" id="poll_id" value="<?= $poll_data['id']; ?>" />
				<button id="btn-poll-vote" class="btn btn-primary" name="submit">ভোট দিন</button>
			</div>
			<div class="pull-right">
				<a style="margin-top: 5px;" href="<?= $url; ?>">View Result</a>
			</div>
			<div class="clearfix"></div>
			
			<div id="error-vote"></div>
		</div>
	</form>
</div>
<?php } ?>

<br />

<?= news_instant(array("nlimit"=>1, "category"=>"সিমান্ত সংবাদ")); ?>

<br />

<?= news_instant(array("nlimit"=>1, "category"=>"লাইফস্টাইল")); ?>

<br />

<?php
	$advertisement = cur_advertisement(array("position"=>"Right Sidebar 3", "enabled"=>1), array("table"=>"advertisement", "limit"=>1));
	if($advertisement) echo "{$advertisement}<br />";
?>

<?php /*
<div class="well">
  	<!-- Nav tabs -->
  	<ul class="nav nav-tabs" role="tablist">
    	<li role="presentation" class="active"><a href="#homea1" aria-controls="home" role="tab" data-toggle="tab">অপরাধ</a></li>
    	<li role="presentation"><a href="#profilea1" aria-controls="profile" role="tab" data-toggle="tab">সিমান্ত সংবাদ</a></li>
  	</ul>

  	<!-- Tab panes -->
  	<div class="tab-content">
    	<div role="tabpanel" class="tab-pane active" id="homea1">
    		<?= tabpanel(array("blog.enabled"=>1, "blog.type"=>"List", "blog_groups.category"=>"অপরাধ"), array("limit"=>6, "category"=>"অপরাধ")); ?>
			<br />
    	</div>
    	<div role="tabpanel" class="tab-pane" id="profilea1">
    		<?= tabpanel(array("blog.enabled"=>1, "blog.type"=>"List", "blog_groups.category"=>"সিমান্ত সংবাদ"), array("limit"=>6, "category"=>"সিমান্ত সংবাদ")); ?>
			<br />
    	</div>
  	</div>
</div>

<br />

<?php
	$advertisement = cur_advertisement(array("position"=>"Right Sidebar 4", "enabled"=>1), array("table"=>"advertisement", "limit"=>1));
	if($advertisement) echo "{$advertisement}<br />";
?> */ ?>

<a class="btn btn-block btn-social btn-facebook" target="_blank" href="<?= $company_config['facebook']; ?>">
    <span class="fa fa-facebook"></span> ফেসবুক ফ্যান পেইজ এ লাইক দিন
</a>

<br />

<div class="row">
	<div class="col-md-12">
		<div class="fb-page" data-href="<?= $company_config['facebook']; ?>" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="<?= $company_config['facebook']; ?>"><a href="<?= $company_config['facebook']; ?>"><?= $company_config['company_name']; ?></a></blockquote></div></div>
	</div>
</div>

<br />

<?= news_instant(array("nlimit"=>1, "category"=>"অপরাধ")); ?>

<br />

<?php
	$advertisement = cur_advertisement(array("position"=>"Right Sidebar 4", "enabled"=>1), array("table"=>"advertisement", "limit"=>1));
	if($advertisement) echo "{$advertisement}<br />";
?>

<?= news_instant(array("nlimit"=>1, "category"=>"ক্ষুদে সাংবাদিকতা")); ?>

<br />

<div class="archive_calendar">
	<div style="margin-bottom: 10px;">
		<img class="img-responsive" src="<?= base_url(); ?>img/archive.jpg" />
	</div>

	<div style="background-color: #e9e9e9; padding: 2px;">
		<div style="background-color: #28374e; padding: 5px;">
			<div class="row">
				<div class="col-md-4">
					<h3 style="margin-bottom: 0; margin-top: 0; color: #FFFFFF;">আর্কাইভ</h3>
				</div>
				<div class="col-md-4">
					<?php $month = date('m'); ?>
					<select style='color:#000; font-weight:bold; border:1px solid #BCC5D3;width:100%;' name="month" id="archiveMonth">
						<option value ="1" <?php if($month == 1) echo 'selected="selected"'; ?>>জানুয়ারী</option>
						<option value ="2" <?php if($month == 2) echo 'selected="selected"'; ?>>ফেব্রুয়ারি</option>
						<option value ="3" <?php if($month == 3) echo 'selected="selected"'; ?>>মার্চ</option>
						<option value ="4" <?php if($month == 4) echo 'selected="selected"'; ?>>এপ্রিল</option>
						<option value ="5" <?php if($month == 5) echo 'selected="selected"'; ?>>মে</option>
						<option value ="6" <?php if($month == 6) echo 'selected="selected"'; ?>>জুন</option>
						<option value ="7" <?php if($month == 7) echo 'selected="selected"'; ?>>জুলাই</option>
						<option value ="8" <?php if($month == 8) echo 'selected="selected"'; ?>>অগাস্ট</option>
						<option value ="9" <?php if($month == 9) echo 'selected="selected"'; ?>>সেপ্টেম্বর</option>
						<option value ="10" <?php if($month == 10) echo 'selected="selected"'; ?>>অক্টোবর</option>
						<option value ="11" <?php if($month == 11) echo 'selected="selected"'; ?>>নভেম্বর</option>
						<option value ="12" <?php if($month == 12) echo 'selected="selected"'; ?>>ডিসেম্বর</option>
					</select>
				</div>
				<div class="col-md-4">
					<select style='color:#000; font-weight:bold; border:1px solid #BCC5D3; width:100%;' name="year" id="archiveYear">
						<?php
							$currentYear = date('Y');
							$firstYear = (int)($currentYear - 5);
							for($i=$firstYear;$i<=$currentYear;$i++)
							{
								$bangla = $this->bangla_number->convert($i);
								$selected = ($i == $currentYear) ? 'selected="selected"' : "";
							    echo "<option value=\"{$i}\" {$selected}>{$bangla}</option>";
							}
						?>
					</select>
				</div>
			</div>
		</div>
	
		<br />
	
		<div style="background-color: #f3f3f3;" id="archiveDetails">
			<?php  // echo draw_calendar();  ?>
		</div>
	</div>
</div>

<script type="text/javascript">
$(function () {
	var month = $('#archiveMonth').val(),
		year = $('#archiveYear').val();
	archive_calendar(year, month);

	$('#archiveMonth').change(function(e) {
		e.preventDefault();
		var month = $(this).val(),
			year = $('#archiveYear').val();

		archive_calendar(year, month);
	});

	$('#archiveYear').change(function(e) {
		e.preventDefault();
		var year = $('#archiveMonth').val(),
			month = $(this).val();

		archive_calendar(year, month);
	});

	function archive_calendar (year, month) {
		jQuery.ajax({
			type:'GET',
			url: "<?= site_url("ajax/archive_calendar"); ?>",
			data: { month : month, year : year, rand : Math.random() },
			success: function(response) {
				$("#archiveDetails").html(response);
	    	}
	    });
	};

 	$('#date1 div').on('click', 'td.day', function (e) {
        e.preventDefault();
        var customerId = $('#date1 div').datepicker("getDate");
        alert(customerId);
        return false;
    });  	
});
</script>