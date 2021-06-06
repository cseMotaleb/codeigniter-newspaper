<br /><br />
<div class="well">
	<form method="get" action="<?= site_url("search"); ?>">
        <div id="imaginary_container"> 
            <div class="input-group stylish-input-group">
                <input type="text" name="q" class="form-control" value="<?= trim($this->input->get("q")); ?>" placeholder="Search" >
                <span class="input-group-addon">
                    <button type="submit">
                        <span class="fa fa-search"></span>
                    </button>  
                </span>
            </div>
        </div>
  	</form>
</div>

<?php
foreach ($search_rows as $key => $row) {
	$url = site_url("article/{$row['id']}");
?>
<div class="search-area">
	<div class="panel-body">
		<h4 class="news-title">
			<a href="<?= $url; ?>"><?= $row['title']; ?></a>
		</h4>
		<hr />
		<p><?= word_limiter(strip_tags($row['details']), 45); ?></p>
		<div class="rpost_readmore">
            <a class="btn" href="<?= $url; ?>">বিস্তারিত</a>
        </div>
	</div>
</div>
<?php } ?>

<?= $pagination; ?>