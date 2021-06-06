
<div class="top-selected-news">
	<?php
		include "top-selected-news.php";
	?>
</div>	

<div class="single-adds">
	<?php
		$advertisement = cur_advertisement(array("position"=>"Home List 2", "enabled"=>1), array("table"=>"advertisement", "limit"=>1));
		if($advertisement) echo "<br />{$advertisement}";
	?>
</div>

<div class="row hidden-xs">
	<div class="col-md-6">
		<?php
			$advertisement = cur_advertisement(array("position"=>"Home List Small 3", "enabled"=>1), array("table"=>"advertisement", "limit"=>1));
			if($advertisement) echo "<br />{$advertisement}<br />";
		?>
	</div>
	<div class="col-md-6">
		<?php
			$advertisement = cur_advertisement(array("position"=>"Home List Small 4", "enabled"=>1), array("table"=>"advertisement", "limit"=>1));
			if($advertisement) echo "<br />{$advertisement}<br />";
		?>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-6 col-md-6">
		<?= allcountry_list_style(array("category"=>"দেশজুড়ে", "limit"=>4, "category1"=>"আন্তর্জাতিক", "limit"=>6)); ?>
	</div>

	<div class="col-xs-12 col-sm-6 col-md-6">
		<?= teach_list_style(array("category"=>"শিক্ষা ও স্বাস্থ্য", "limit"=>6, "category1"=>"আন্তর্জাতিক", "limit"=>6)); ?>
	</div>
</div>

<div class="row hidden-xs">
	<div class="col-md-6">
		<?php
			$advertisement = cur_advertisement(array("position"=>"Home List Small 5", "enabled"=>1), array("table"=>"advertisement", "limit"=>1));
			if($advertisement) echo "<br />{$advertisement}<br />";
		?>
	</div>
	<div class="col-md-6">
		<?php
			$advertisement = cur_advertisement(array("position"=>"Home List Small 6", "enabled"=>1), array("table"=>"advertisement", "limit"=>1));
			if($advertisement) echo "<br />{$advertisement}<br />";
		?>
	</div>
</div>

<?php
$invisible = $this->config->item("invisible_1");
if($invisible) echo list_style(array("blog.enabled"=>1, "blog.type"=>"List", "blog_groups.category"=>$invisible), array("limit"=>9, "category"=>$invisible, "list"=>2, "category_title"=>$invisible, "category_name"=>$invisible))."<hr />";
?>


<?php
$invisible = $this->config->item("invisible_2");
if($invisible) echo list_style(array("blog.enabled"=>1, "blog.type"=>"List", "blog_groups.category"=>$invisible), array("limit"=>9, "category"=>$invisible, "list"=>2, "category_title"=>$invisible, "category_name"=>$invisible))."<hr />";
?>