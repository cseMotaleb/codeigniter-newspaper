<?php
	$advertisement = cur_advertisement(array("position"=>"Right Sidebar 1", "enabled"=>1), array("table"=>"advertisement", "limit"=>1));
	if($advertisement) echo "{$advertisement}<br />";
?>

<?= news_instant(); ?>

<br />

<div class="well">
  	<ul class="nav nav-tabs" role="tablist">
    	<li role="presentation" class="active"><a href="#latest" aria-controls="home" role="tab" data-toggle="tab">সর্বশেষ</a></li>
    	<li role="presentation"><a href="#mostread" aria-controls="profile" role="tab" data-toggle="tab">সর্বাধিক পঠিত</a></li>
    	<li role="presentation"><a href="#selected" aria-controls="messages" role="tab" data-toggle="tab">নির্বাচিত</a></li>
  	</ul>

  	<div class="tab-content">
    	<div role="tabpanel" class="tab-pane active" id="latest">
    		<?php
    		$latest_news = get_news_list(array("blog.enabled"=>1, "blog.type"=>"List"), 4);
    		$total_latest_news = count($latest_news);
			$i = 0;
    		foreach ($latest_news as $key => $row) {
    			$url = site_url("article/{$row['id']}/{$row['blog_url']}");
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
			if($i != $total_latest_news) echo "<hr class=\"hr-5\" />";
			} ?>

			<br />
    	</div>
    	<div role="tabpanel" class="tab-pane" id="mostread">
    		<?php
    		$mostreaded_news = mostreaded_news(array("blog.enabled"=>1, "blog.type"=>"List"), 4);
    		$total_mostreaded_news = count($mostreaded_news);
			$i = 0;
    		foreach ($mostreaded_news as $key => $row) {
    			$url = site_url("article/{$row['id']}/{$row['blog_url']}");
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
    	<div role="tabpanel" class="tab-pane" id="selected">
    		<?php
    		$selected_news = get_news_list(array("blog.enabled"=>1, "blog.selected"=>1, "blog.type"=>"List"), 4);
    		$total_selected_news = count($selected_news);
			$i = 0;
    		foreach ($selected_news as $key => $row) {
    			$url = site_url("article/{$row['id']}/{$row['blog_url']}");
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
			if($i != $total_selected_news) echo "<hr class=\"hr-5\" />";
			} ?>

			<br />
    	</div>
  	</div>
</div>


<?php
	$advertisement = cur_advertisement(array("position"=>"Right Sidebar 2", "enabled"=>1), array("table"=>"advertisement", "limit"=>1));
	if($advertisement) echo "{$advertisement}<br />";
?>


<?php
$poll_data = cur_poll();
if(isset($poll_data['id'])) {
	$url = non_english_url_title(strip_tags($poll_data['poll']));
	$url = site_url("poll/{$poll_data['id']}/{$url}");
?>
<div class="well">
	<div class="cat-heading">
		<h3>আজকের জরিপ</h3>
	</div>
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
<div class="well">
  	<!-- Nav tabs -->
  	<ul class="nav nav-tabs" role="tablist">
    	<li role="presentation" class="active"><a href="#homea" aria-controls="home" role="tab" data-toggle="tab">সম্পাদকীয়</a></li>
    	<li role="presentation"><a href="#profilea" aria-controls="profile" role="tab" data-toggle="tab">উপসম্পাদকীয় </a></li>
  	</ul>

  	<!-- Tab panes -->
  	<div class="tab-content">
    	<div role="tabpanel" class="tab-pane active" id="homea">
    		<?= tabpanel(array("blog.enabled"=>1, "blog.type"=>"List", "blog_groups.category"=>"সম্পাদকীয়"), array("limit"=>4, "category"=>"সম্পাদকীয়")); ?>
			<br />
    	</div>
    	<div role="tabpanel" class="tab-pane" id="profilea">
    		<?= tabpanel(array("blog.enabled"=>1, "blog.type"=>"List", "blog_groups.category"=>"উপসম্পাদকীয়"), array("limit"=>4, "category"=>"উপসম্পাদকীয়")); ?>
			<br />
    	</div>
  	</div>
</div>


<?php
	$advertisement = cur_advertisement(array("position"=>"Right Sidebar 3", "enabled"=>1), array("table"=>"advertisement", "limit"=>1));
	if($advertisement) echo "{$advertisement}";
?>


<div style="padding-top: 20px;" class="row">
	<div class="col-md-12">
		<div class="fb-page" data-href="<?= $company_config['facebook']; ?>" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="<?= $company_config['facebook']; ?>"><a href="<?= $company_config['facebook']; ?>"><?= $company_config['company_name']; ?></a></blockquote></div></div>
	</div>
</div>

<br />

<div class="cat-heading">
	<h3><a href="<?= site_url("video"); ?>">ভিডিও</a></h3>
</div>
<?php
	$videos_list = get_news_list(array("blog.enabled"=>1, "blog.type"=>"Video"), $limit=4);
	$total_videos = count($videos_list);
	$row_counter = 0;
	foreach ($videos_list as $key => $row) {
		$url = site_url("article/{$row['id']}/{$row['blog_url']}");

		if($row_counter == 1) echo '<div class="row">';
?>

	<?php if($row_counter == 0) { ?>
	<div class="embed-responsive embed-responsive-4by3">
	  	<iframe id="embed-video1" class="embed-responsive-item" id="embed-video" src="https://www.youtube.com/embed/<?= $row['videos'][0]['url']; ?>"></iframe>
	</div>
	<h4>
		<a class="text-primary" href="<?= $url; ?>">
			<?= $row['title']; ?>
		</a>
	</h4>
	<?php } else { ?>
	<div class="col-md-4 col-xs-12">
		<a class="loadVideo1" data-url="<?= $row['videos'][0]['url']; ?>" href="#">
			<div class="show_btn"></div>
			<img style="height: 75px;" class="img-responsive" alt="<?= $row['title']; ?>" src="<?= $row['default_image']; ?>" />
		</a>
		<h6 style="font-size: 16px;">
			<a href="<?= $url; ?>">
				<?= $row['title']; ?>
			</a>
		</h6>
	</div>
	<?php } ?>

<?php
$row_counter++;
//if($row_counter == 2) { echo '</div>'; $row_counter = 0; }
}

//if($total_videos % 2 != 0) echo '</div>';
?>
</div>

<br />


<?php
	$advertisement = cur_advertisement(array("position"=>"Right Sidebar 4", "enabled"=>1), array("table"=>"advertisement", "limit"=>1));
	if($advertisement) echo "{$advertisement}";
?>
<br />

<div class="cat-heading">
	<h3>আর্কাইভ</h3>
</div>
<div class="archive_calendar">
	<div class="row">
		<div class="col-md-6">
			<?php $month = date('m'); ?>
			<select style='color:#0061B6; font-weight:bold; border:1px solid #BCC5D3;width:100%;' name="month" id="archiveMonth">
				<option value ="1" <?php if($month == 1) echo 'selected="selected"'; ?>>January</option>
				<option value ="2" <?php if($month == 2) echo 'selected="selected"'; ?>>February</option>
				<option value ="3" <?php if($month == 3) echo 'selected="selected"'; ?>>March</option>
				<option value ="4" <?php if($month == 4) echo 'selected="selected"'; ?>>April</option>
				<option value ="5" <?php if($month == 5) echo 'selected="selected"'; ?>>May</option>
				<option value ="6" <?php if($month == 6) echo 'selected="selected"'; ?>>June</option>
				<option value ="7" <?php if($month == 7) echo 'selected="selected"'; ?>>July</option>
				<option value ="8" <?php if($month == 8) echo 'selected="selected"'; ?>>August</option>
				<option value ="9" <?php if($month == 9) echo 'selected="selected"'; ?>>September</option>
				<option value ="10" <?php if($month == 10) echo 'selected="selected"'; ?>>October</option>
				<option value ="11" <?php if($month == 11) echo 'selected="selected"'; ?>>November</option>
				<option value ="12" <?php if($month == 12) echo 'selected="selected"'; ?>>Decmber</option>
			</select>
		</div>
		<div class="col-md-6">
			<select style='color:#0061B6; font-weight:bold; border:1px solid #BCC5D3; width:100%;' name="year" id="archiveYear">
				<?php
					$currentYear = date('Y');
					$firstYear = (int)($currentYear - 5);
					for($i=$firstYear;$i<=$currentYear;$i++)
					{
						$selected = ($i == $currentYear) ? 'selected="selected"' : "";
					    echo "<option value=\"{$i}\" {$selected}>{$i}</option>";
					}
				?>
			</select>
		</div>
	</div>

	<br />

	<div id="archiveDetails">
		<?php  // echo draw_calendar();  ?>
	</div>
</div>


<div class="well">
  	<ul class="nav nav-tabs" role="tablist">
    	<li role="presentation" class="active"><a href="#homeaj" aria-controls="home" role="tab" data-toggle="tab">জীবন ও কর্ম</a></li>
  	</ul>

  	<!-- Tab panes -->
  	<div class="tab-content">
    	<div role="tabpanel" class="tab-pane active" id="homeaj">
    		<?= tabpanel(array("blog.enabled"=>1, "blog.type"=>"List", "blog_groups.category"=>"জীবন ও কর্ম"), array("limit"=>4, "category"=>"জীবন ও কর্ম")); ?>
			<br />
    	</div>
  	</div>
</div>

<script type="text/javascript">
$(function () {
	<?php /*
	!function(a){a.fn.datepicker.dates["bn"]= {days:["রবিবার","সোমবার","মঙ্গলবার","বুধবার","বৃহস্পতিবার","শুক্রবার","শনিবার"],daysShort:["রবি.","সোম.","মঙ্গল.","বুধ.","বৃহস্পতি.","শুক্র.","শনি."],daysMin:["রবি.","সোম.","মঙ্গল.","বুধ.","বৃহ.","শুক্র.","শনি."],months:["জানুয়ারী","ফেব্রুয়ারী","মার্চ","এপ্রিল","মে","জুন","জুলাই","আগস্ট","সেপ্টেম্বর","অক্টোবর","নভেম্বর","ডিসেম্বর"],monthsShort:["জানু.","ফেব্রু.","মার্চ","এপ্রিল","মে","জুন","জুলাই","আগ.","সেপ্টে.","অক্টো.","নভে.","ডিসে."],today:"Today",monthsTitle:"Months",clear:"Clear",weekStart:1,format:"dd/mm/yyyy"}}(jQuery);
  	$('#date1 div').datepicker({
  		language: "bn"
  	}); */ ?>


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


<br />



<?php
	$advertisement = cur_advertisement(array("position"=>"Right Sidebar 5", "enabled"=>1), array("table"=>"advertisement", "limit"=>1));
	if($advertisement) echo "{$advertisement}<br />";
?>

<div class="well">
  	<!-- Nav tabs -->
  	<ul class="nav nav-tabs" role="tablist">
    	<li role="presentation" class="active"><a href="#homea1" aria-controls="home" role="tab" data-toggle="tab">লেখকের কলাম</a></li>
    	<li role="presentation"><a href="#profilea1" aria-controls="profile" role="tab" data-toggle="tab">পাঠকের কলাম</a></li>
  	</ul>

  	<!-- Tab panes -->
  	<div class="tab-content">
    	<div role="tabpanel" class="tab-pane active" id="homea1">
    		<?= tabpanel(array("blog.enabled"=>1, "blog.type"=>"List", "blog_groups.category"=>"লেখকের কলাম"), array("limit"=>4, "category"=>"লেখকের কলাম")); ?>
			<br />
    	</div>
    	<div role="tabpanel" class="tab-pane" id="profilea1">
    		<?= tabpanel(array("blog.enabled"=>1, "blog.type"=>"List", "blog_groups.category"=>"পাঠকের কলাম"), array("limit"=>4, "category"=>"পাঠকের কলাম")); ?>
			<br />
    	</div>
  	</div>
</div>

<?= today_prayer(); ?>



<?php
	$advertisement = cur_advertisement(array("position"=>"Right Sidebar 6", "enabled"=>1), array("table"=>"advertisement", "limit"=>1));
	if($advertisement) echo "{$advertisement}";
?>

<br />

<div class="well">
  	<!-- Nav tabs -->
  	<ul class="nav nav-tabs" role="tablist">
    	<li role="presentation" class="active"><a href="#kids1" aria-controls="home" role="tab" data-toggle="tab">কিডস</a></li>
    	<li role="presentation"><a href="#gmaes1" aria-controls="profile" role="tab" data-toggle="tab">গেমস</a></li>
  	</ul>

  	<!-- Tab panes -->
  	<div class="tab-content">
    	<div role="tabpanel" class="tab-pane active" id="kids1">
    		<?= tabpanel(array("blog.enabled"=>1, "blog.type"=>"List", "blog_groups.category"=>"কিডস"), array("limit"=>4, "category"=>"কিডস")); ?>
			<br />
    	</div>
    	<div role="tabpanel" class="tab-pane" id="gmaes1">
    		<?= tabpanel(array("blog.enabled"=>1, "blog.type"=>"List", "blog_groups.category"=>"গেমস"), array("limit"=>4, "category"=>"গেমস")); ?>
			<br />
    	</div>
  	</div>
</div>

<br />

<div class="well">
  	<!-- Nav tabs -->
  	<ul class="nav nav-tabs" role="tablist">
    	<li role="presentation" class="active"><a href="#llist215" aria-controls="home" role="tab" data-toggle="tab">ফিচার</a></li>
    	<li role="presentation"><a href="#llist216" aria-controls="profile" role="tab" data-toggle="tab">আর্তনাত</a></li>
  	</ul>

  	<!-- Tab panes -->
  	<div class="tab-content">
    	<div role="tabpanel" class="tab-pane active" id="llist215">
    		<?= tabpanel(array("blog.enabled"=>1, "blog.type"=>"List", "blog_groups.category"=>"ফিচার"), array("limit"=>4, "category"=>"ফিচার")); ?>
			<br />
    	</div>
    	<div role="tabpanel" class="tab-pane" id="llist216">
    		<?= tabpanel(array("blog.enabled"=>1, "blog.type"=>"List", "blog_groups.category"=>"আর্তনাত"), array("limit"=>4, "category"=>"আর্তনাত")); ?>
			<br />
    	</div>
  	</div>
</div>

<br />


<div class="well">
  	<ul class="nav nav-tabs" role="tablist">
    	<li role="presentation" class="active"><a href="#homeasdj" aria-controls="home" role="tab" data-toggle="tab">Projonmo English</a></li>
  	</ul>

  	<!-- Tab panes -->
  	<div class="tab-content">
    	<div role="tabpanel" class="tab-pane active" id="homeasdj">
    		<?= tabpanel(array("blog.enabled"=>1, "blog.type"=>"List", "blog_groups.category"=>"Projonmo English"), array("limit"=>4, "category"=>"Projonmo English")); ?>
			<br />
    	</div>
  	</div>
</div>

<br />

<div >
	<?php
	if(isset($shift_incharge_1['description'])) echo $shift_incharge_1['description'];
	elseif(isset($shift_incharge_2['description'])) echo $shift_incharge_2['description'];
	elseif(isset($shift_incharge_3['description'])) echo $shift_incharge_3['description'];
	elseif(isset($shift_incharge_4['description'])) echo $shift_incharge_4['description'];
	elseif(isset($shift_incharge_5['description'])) echo $shift_incharge_5['description'];
	elseif(isset($shift_incharge_6['description'])) echo $shift_incharge_6['description'];
	elseif(isset($shift_incharge_7['description'])) echo $shift_incharge_7['description'];
	elseif(isset($shift_incharge_8['description'])) echo $shift_incharge_8['description'];
	elseif(isset($shift_incharge_9['description'])) echo $shift_incharge_9['description'];
	elseif(isset($shift_incharge_10['description'])) echo $shift_incharge_10['description'];
	?>
</div>