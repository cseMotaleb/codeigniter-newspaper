
<div id="mobile_menu_category">
	<div style="display:none">
		<ul class="header_top_menu">
			<li><a class="active continue-hover" href="<?= base_url(); ?>" title="Home"><i class="fa fa-home fa-lg"></i> <span style="float: right;">প্রচ্ছদ</span></a></li>
    		<?php
    		foreach ($categories as $key => $category) {
    			$url = site_url("category/{$category['category_url']}");
    		?>
    		<li><a href="<?= $url; ?>"><?= $category['category']; ?></a></li>
    		<?php } ?>

    		<?php
    		foreach ($sub_categories as $key => $category) {
    			$url = site_url("category/{$category['category_url']}");
    		?>
    		<li><a href="<?= $url; ?>"><?= $category['category']; ?></a></li>
    		<?php } ?>
		</ul>
	</div>
</div><!--end mobile_menu_category-->