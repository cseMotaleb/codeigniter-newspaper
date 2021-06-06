<div class="jarviswidget well" id="wid-id-3" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false">
	<header>
		<span class="widget-icon"> <i class="fa fa-comments"></i> </span>
	</header>

	<!-- widget div-->
	<div>
		<div class="jarviswidget-editbox"></div>
		<!-- widget content -->
		<div class="widget-body">
			<p>Update your profile, a <code>completed profile</code> may bring you fortune.</p>
			<hr class="simple">
			<ul id="myTab1222" class="nav nav-tabs bordered">
				<li class="active"><a href="#my-profile" data-toggle="tab"><i class="fa fa-fw fa-lg fa-user"></i> My Profile</a></li>
				<li><a href="#change-password" data-toggle="tab"><i class="fa fa-fw fa-lg fa-file-text"></i> Change Password</a></li>
			</ul>

			<div id="profile-tab-container" class="tab-content padding-10">
				<div class="tab-pane fade in active" id="my-profile">
					<table id="user" class="table table-bordered table-striped" style="clear: both">
						<tbody>
							<tr>
								<td style="width:25%;">First Name</td>
								<td style="width:75%"><a class="EdiTables" href="l#" id="first_name" name="first_name" data-type="text" data-pk="<?= $user_data['id']; ?>" data-original-title="Enter Your First Name"><?= $user_data['first_name']; ?></a></td>
							</tr>
							<tr>
								<td>Last Name</td>
								<td><a class="EdiTables" href="l#" id="last_name" name="last_name" data-type="text" data-pk="<?= $user_data['id']; ?>" data-original-title="Enter Your Last Name"><?= $user_data['last_name']; ?></a></td>
							</tr>
							<tr>
								<td>Email</td>
								<td><?= $user_data['email']; ?></td>
							</tr>

						</tbody>
					</table>
				</div>
				<div class="tab-pane fade" id="change-password">
					<div class="jarviswidget" id="wid-id-4" data-widget-colorbutton="false" data-widget-editbutton="false">
						<div>
							<div class="jarviswidget-editbox"></div>
							<div class="widget-body">				
								<div class="alert adjusted alert-info fade in">
									<button class="close" data-dismiss="alert">×</button>
									<i class="fa-fw fa-lg fa fa-exclamation"></i>
									<strong>Attention!</strong> You can change your password here!
								</div>
							
								<form id="validate-changepassword" method="post" action="#profile/changepassword" class="form-inline" role="form">
									<fieldset>
										<div class="form-group">
											<label class="sr-only" for="exampleInputPassword2">Password</label>
											<input type="password" class="form-control" id="exampleInputPassword2" name="old_password" placeholder="Current Password">
										</div>
										<div class="form-group">
											<label class="sr-only" for="exampleInputPassword2">New Password</label>
											<input type="password" class="form-control" id="exampleInputPassword2" name="password" placeholder="New Password">
										</div>										
										<div class="form-group">
											<label class="sr-only" for="exampleInputPassword2">Retype Password</label>
											<input type="password" class="form-control" id="exampleInputPassword2" name="retype_password" placeholder="Retype New Password">
										</div>										
										<button type="submit" class="btn btn-primary">Change Password</button>
									</fieldset>
								</form>
							</div>														
						</div>
					</div>
				</div>
			</div>

		</div>
		<!-- end widget content -->

	</div>
	<!-- end widget div -->

</div>
<!-- end widget -->
<script type="text/javascript">
$(document).ready(function() {
	pageSetUp();	
    $('.EdiTables').editable({
        url: '<?= site_url("controlpanel/profile/ajax_update"); ?>',
        type: 'text',
        pk: $(this).attr('pk'),
        name: $(this).attr('name'),
        title: 'Enter username',
        success: function(response, newValue) {
            processJson(response);
        }		        
    });
  
	$("#validate-changepassword").submit(function (event) {
		event.preventDefault();
		var values = $("#validate-changepassword").serializeArray(); values = jQuery.param(values);		
		$.ajax({async: false, type:'POST', url: '<?= site_url('controlpanel/profile/changepassword');?>', data:values, success: function(response) {
		  	processJson(response);
		}});
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
    } 

});
</script>
