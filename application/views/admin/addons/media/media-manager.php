<div class="row">
	<div class="col-lg-9">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa-fw fa fa-pencil-square-o"></i> <?php if(isset($top_title)) echo $top_title; ?>
		</h1>
	</div>
</div>

<div class="panel panel-blue">
  	<div class="panel-heading">File manager</div>
  	<div class="panel-body">
        <div class="kc-outer">
            <iframe name="kcfinder_iframe" id="kcfinder_iframe" src="<?= base_url(); ?>/file_manager/browse.php?type=<?= $kc_browser_type; ?>" frameborder="0" width="100%" height="450" marginwidth="0" marginheight="0" scrolling="no"></iframe>
        </div>
    </div>
</div>

<script src="<?= base_url(); ?>assets/admin/js/file_manager.js"></script>