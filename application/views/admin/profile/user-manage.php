<div class="row">
	<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa-fw fa fa-pencil-square-o"></i> Administrator Users
		</h1>
	</div>
</div>

<section id="widget-grid" class="">
	<div class="row">
		<article class="col-sm-12 col-md-12 col-lg-6">
			<div class="jarviswidget" id="wid-id-4" data-widget-editbutton="false" data-widget-custombutton="false">
				<header>
					<span class="widget-icon"> <i class="fa fa-edit"></i> </span>
					<h2>Administrator Users</h2>				
				</header>
				<div>
					<div class="jarviswidget-editbox">
					</div>
					<div class="widget-body no-padding">
						<form action="<?= site_url("controlpanel/users/index/{$mode}/{$cur_id}"); ?>" id="smart-form" class="smart-form" method="post">
							<fieldset>
								<section>
									<label class="input">
									<input type="text" name="first_name" placeholder="First Name" value="<?php if(isset($first_name['value'])) echo $first_name['value']; ?>">
									<b class="tooltip tooltip-bottom-right">Please enter First Name</b> </label>
								</section>
							</fieldset>
							<fieldset>
								<section>
									<label class="input">
									<input type="text" name="last_name" placeholder="Last Name" value="<?php if(isset($last_name['value'])) echo $last_name['value']; ?>">
									<b class="tooltip tooltip-bottom-right">Please enter Last Name</b> </label>
								</section>
							</fieldset>
							<fieldset>
								<section>
									<label class="input">
									<input type="email" name="email" placeholder="E-mail" value="<?php if(isset($email['value'])) echo $email['value']; ?>">
									<b class="tooltip tooltip-bottom-right">Please enter E-mail</b> </label>
								</section>
							</fieldset>
							<fieldset>
								<section>
									<label class="input">
									<input type="password" name="password" placeholder="Password" value="<?php if(isset($password['value'])) echo $password['value']; ?>">
									<b class="tooltip tooltip-bottom-right">Please enter Password</b> </label>
								</section>
							</fieldset>
							<fieldset>
								<section>
									<label class="select">
										<select name="group">
										<?php 
										      $selected_type = (isset($group['group'])) ? $group['group'] : '' ;
										      $batch = array('table'=>'user_groups', 'limit'=>1000, 'option'=>'group', 'default'=>$selected_type, 'order_by'=>'group', 'order_type'=>'asc');
										      $groups = options($batch, array('enabled'=>1));
										      echo $groups['option_list'];
										?>
										</select>
									</label>
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
				first_name : {
					required : true
				},
				last_name : {
					required : true
				},
				email : {
					required : true,
					email    : true
				},
				password : {
					required : true
				}
			},
			messages : {
				first_name : {
					required : 'Please enter first name'
				},
				last_name : {
					required : 'Please enter last name'
				},
				email : {
					required : 'Please enter email'
				},
				password : {
					required : 'Please enter password'
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
		    	$("#smart-form").attr("action", "<?= site_url("controlpanel/users/index"); ?>/" + obj.data_mode + "/" + obj.zone_id);
		    	$('#zone_id').val(obj.data_listing_id);
		    	window.history.pushState("string", "Users", "#users/index/" + obj.data_mode + "/" + obj.zone_id);
		    }
		};
	};
	
	loadScript("<?=  base_url();?>assets/controlpanel/js/plugin/jquery-form/jquery-form.min.js", pagefunction);
</script>