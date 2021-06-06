<?php {?>
	<div class="sidebar-singleads">
	<?php
	$advertisement = cur_advertisement(array("position"=>"Right Sidebar 1", "enabled"=>1), array("table"=>"advertisement", "limit"=>1));
	if($advertisement) echo "{$advertisement}";
	?>
	</div>
<?php }?>

<?php
$filters = array("blog.enabled"=>1, "blog.type"=>"List");
$get_category_data = get_rows(array("table"=>"blog_groups", "limit"=>1), array("category"=>"সম্পাদকীয়", "parent_id"=>0));
if(isset($get_category_data['id'])) $filters['blog_categories.category_id'] = $get_category_data['id'];
$get_data = get_news_list($filters, 1);
if(isset($get_data['id'])) {
	$url = site_url("article/{$get_data['id']}");
?>

<?php } ?>

<?php
$filters = array("blog.enabled"=>1, "blog.type"=>"List");
$get_category_data = get_rows(array("table"=>"blog_groups", "limit"=>1), array("category"=>"উপসম্পাদকীয়", "parent_id"=>0));
if(isset($get_category_data['id'])) $filters['blog_categories.category_id'] = $get_category_data['id'];
$get_data = get_news_list($filters, 1);
if(isset($get_data['id'])) {
	$url = site_url("article/{$get_data['id']}");
?>
<?php } ?>

	<?php {?>
		<div class="sidebar-singleads">
			<?php
			$advertisement = cur_advertisement(array("position"=>"Right Sidebar 2", "enabled"=>1), array("table"=>"advertisement", "limit"=>1));
			if($advertisement) echo "{$advertisement}<br />";
			?>
		</div>
	<?php }?>
<?php
$filters = array("blog.enabled"=>1, "blog.type"=>"List");
$get_category_data = get_rows(array("table"=>"blog_groups", "limit"=>1), array("category"=>"সাক্ষাৎকার", "parent_id"=>0));
if(isset($get_category_data['id'])) $filters['blog_categories.category_id'] = $get_category_data['id'];
$get_data = get_news_list($filters, 1);
if(isset($get_data['id'])) {
	$url = site_url("article/{$get_data['id']}");
?>
<?php } ?>

<div class="sidebar-tab" id="listtab">
  	<ul class="nav nav-tabs nav-green" role="tablist">
    	<li role="presentation"><a class="active" href="#latest" aria-controls="home" role="tab" data-toggle="tab">সর্বশেষ</a></li>
    	<li role="presentation"><a href="#mostread" aria-controls="profile" role="tab" data-toggle="tab">সর্বাধিক পঠিত</a></li>
  	</ul>

  	<div class="tab-content">
    	<div role="tabpanel" class="tab-pane active" id="latest">
    		<?php
    		$latest_news = get_news_list(array("blog.enabled"=>1, "blog.type"=>"List"), 8, array('imgwidth'=>85, 'imgheight'=>65));
    		$total_latest_news = count($latest_news);
			$i = 0;
    		foreach ($latest_news as $key => $row) {
    			$url = site_url("article/{$row['id']}");     
    		?>
			<div class="single-tab">
				<div class="tab-img">
					<a href="<?= $url; ?>">
						<img class="<?= $row['img_thumbnail']; ?> lazyload" alt="<?= $row['title']; ?>" data-src="<?= $row['default_image']; ?>" />
					</a>
				</div>
				<div class="tab-text">
				<h2><a href="<?= $url; ?>"><?= word_limiter(strip_tags($row['title']), 4); ?></a></h2>
				
			</div>
			</div>
			<div class="clearfix"></div>
			<?php
			$i++;
			if($i != $total_latest_news) echo "<hr class=\"hr-5\" />";
			} ?>
    	</div>
    	<div role="tabpanel" class="tab-pane" id="mostread">
    		<?php
    		$mostreaded_news = mostreaded_news(array("blog.enabled"=>1, "blog.type"=>"List"), 8, array('imgwidth'=>85, 'imgheight'=>65));
    		$total_mostreaded_news = count($mostreaded_news);
			$i = 0;
    		foreach ($mostreaded_news as $key => $row) {
    			$url = site_url("article/{$row['id']}");
    		?>
			<div class="single-tab">
				<div class="tab-img">
				<a href="<?= $url; ?>">
					<img class="<?= $row['img_thumbnail']; ?> lazyload" alt="<?= $row['title']; ?>" data-src="<?= $row['default_image']; ?>" />
				</a>
				</div>
				<div class="tab-text">
				<h2><a href="<?= $url; ?>"><?= word_limiter(strip_tags($row['title']), 4); ?></a></h2>
				
				</div>
			</div>
			<div class="clearfix"></div>
			<?php
			$i++;
			if($i != $total_mostreaded_news) echo "<hr class=\"hr-5\" />";
			} ?>
    	</div>
  	</div>
</div>


<?= news_instant(array("category"=>"সাক্ষাৎকার", "top"=>1)); ?>


<!-- <?php
	$advertisement = cur_advertisement(array("position"=>"Right Sidebar 3", "enabled"=>1), array("table"=>"advertisement", "limit"=>1));
	if($advertisement) echo "{$advertisement}<br />";
?> -->



<?= news_instant(array("nlimit"=>1, "category"=>"আলোকিত মানুষ")); ?>

<!-- <div class="row">
	<div class="col-md-12">
		<div class="fb-page" data-href="<?= $company_config['facebook']; ?>" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="<?= $company_config['facebook']; ?>"><a href="<?= $company_config['facebook']; ?>"><?= $company_config['company_name']; ?></a></blockquote></div></div>
	</div>
</div> -->


<div class="archive_calendar">
	<div class="sider-archive">
			<div class="arechive-head">
				<div class="left-head">
					<h3>আর্কাইভ</h3>
				</div>
				<div class="archive-month">
					<?php $month = date('m'); ?>
					<select name="month" id="archiveMonth">
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
				<div class="year-archive">
					<select name="year" id="archiveYear">
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
	
		<div id="archiveDetails">
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
    $('#listtab a').click(function(e) {
    $($('#listtab li').parent()).addClass("active").not(this.parentNode).removeClass("active");   
    e.preventDefault();
 }); 	
});
</script>