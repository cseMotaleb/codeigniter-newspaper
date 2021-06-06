<div class="row">
	<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa-fw fa fa-pencil-square-o"></i> Language
		</h1>
	</div>
</div>

<section id="widget-grid" class="">
	<div class="row">
		<article class="col-sm-12 col-md-12 col-lg-6">
			<div class="jarviswidget" id="wid-id-4" data-widget-editbutton="false" data-widget-custombutton="false">
				<header>
					<span class="widget-icon"> <i class="fa fa-edit"></i> </span>
					<h2>Language</h2>				
				</header>
				<div>
					<div class="jarviswidget-editbox">
					</div>
					<div class="widget-body no-padding">
						<form action="<?= site_url("controlpanel/languages/index/{$mode}/{$cur_id}"); ?>" id="smart-form" class="smart-form" method="post">
							<fieldset>
								<section>
									<label class="input">
									<input type="text" name="language" placeholder="Language" value="<?php if(isset($language['value'])) echo $language['value']; ?>">
									<b class="tooltip tooltip-bottom-right">Please enter Language</b> </label>
								</section>
							</fieldset>
							<fieldset>
								<section>
									<label class="select">
										<select name="direction">
											<option value="ltr" <?php if(isset($direction['value']) && $direction['value'] == 'ltr') echo 'selected'; ?>>LTR</option>
											<option value="rtl" <?php if(isset($direction['value']) && $direction['value'] == 'rtl') echo 'selected'; ?>>RTL</option>
										</select>
									</label>
								</section>
							</fieldset>							
							<fieldset>
								<section>
									<label class="input">
									<input type="text" name="lang" placeholder="Language Code" value="<?php if(isset($lang['value'])) echo $lang['value']; ?>">
									<b class="tooltip tooltip-bottom-right">Please enter Language Code</b> </label>
								</section>
							</fieldset>

							<fieldset>
								<section>
									<label class="select">
										<select name="enabled">
											<option value="1" <?php if(isset($enabled['value']) && $enabled['value'] == '1') echo 'selected'; ?>>Enabled</option>
											<option value="0" <?php if(isset($enabled['value']) && $enabled['value'] == '0') echo 'selected'; ?>>Disabled</option>
										</select>
									</label>
								</section>
							</fieldset>
							<footer>
								<input type="hidden" name="id" value="<?php if(isset($cur_id)) echo $cur_id; ?>" />
								<button type="submit" class="btn btn-primary">Save</button>
							</footer>
						</form>						
					</div>
				</div>
			</div>
		</article>	
	</div>
</section>

<script type="text/javascript">
	pageSetUp();

	var pagefunction = function() {
		var $checkoutForm = $('#smart-form').validate({
			rules : {
				language : {
					required : true
				}
			},
			messages : {
				language : {
					required : 'Please enter language'
				}
			},
			submitHandler : function(form) {
				$(form).ajaxSubmit({
					success : processJson
				});
			},
			errorPlacement : function(error, element) {
				error.insertAfter(element.parent());
			}
		});
		
		function processJson(data) {
			var obj = jQuery.parseJSON( data );
		    $.bigBox({
		      title: obj.mtitle,
		      content: obj.mcontent,
		      color: obj.mcolor,
		      iconSmall: obj.miconSmall,
		      timeout: 10000
		    });
		    
		    if(obj.mcode == 200) {
		    	$("#smart-form").attr("action", "<?= site_url("controlpanel/languages/index"); ?>/" + obj.data_mode + "/" + obj.zone_id);
		    	$('#zone_id').val(obj.data_listing_id);
		    	window.history.pushState("string", "Language", "#languages/index/" + obj.data_mode + "/" + obj.zone_id);
		    }
		};
	};
	
	loadScript("<?=  base_url();?>assets/controlpanel/js/plugin/jquery-form/jquery-form.min.js", pagefunction);
</script>