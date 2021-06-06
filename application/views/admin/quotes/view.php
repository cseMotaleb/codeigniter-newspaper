<div class="row">
	<div class="col-lg-6">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa-fw fa fa-pencil-square-o"></i> View Quote
		</h1>
	</div>
	<div class="col-lg-6">
		<div class="btn-group btn-sm pull-right">
			<button class="btn btn-success changeURL" data-url="#quotes/reply/<?= $row_data['id']; ?>"><i class="fa fa-envelope-o"></i> Reply</button>
			<button class="btn btn-danger changeURL" data-url="#quotes/manage/edit/<?= $row_data['id']; ?>"><i class="fa fa-plus-circle"></i> Edit Quote</button>
			<button class="btn btn-success changeURL" data-url="#quotes/"><i class="fa fa-list"></i> Quote List</button>
			<button class="btn btn-danger changeURL" data-url="#quotes/manage/"><i class="fa fa-plus-circle"></i> Add Quote</button>
		</div>
	</div>
</div>


<div class="row">
	<div class="col-md-6">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h4>Property Information</h4>
			</div>
			<div class="panel-body">
				<table class="table table-bordered">
					<tbody>
						<tr>
							<th width="35%">Roof Type</th>
							<td width="5%">:</td>
							<td><?= $row_data['roof_type']; ?></td>
						</tr>
						<tr>
							<th>Stories</th>
							<td>:</td>
							<td><?= $row_data['stories']; ?></td>
						</tr>
						<tr>
							<th>System Size</th>
							<td>:</td>
							<td><?= $row_data['system_size']; ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

		<div class="panel panel-primary">
			<div class="panel-heading">
				<h4>Security Information</h4>
			</div>
			<div class="panel-body">
				<table class="table table-bordered">
					<tbody>
						<tr>
							<th width="35%">IP</th>
							<td width="5%">:</td>
							<td><?= $row_data['ip']; ?></td>
						</tr>
						<tr>
							<th>Browser</th>
							<td>:</td>
							<td><?= $row_data['browser']; ?></td>
						</tr>
						<tr>
							<th>Timestamp</th>
							<td>:</td>
							<td><?= $row_data['date_timestamp']; ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	
	<div class="col-md-6">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h4>Personal Details</h4>
			</div>
			<div class="panel-body">
				<table class="table table-bordered">
					<tbody>
						<tr>
							<th width="35%">Name</th>
							<td width="5%">:</td>
							<td><?= "{$row_data['first_name']} {$row_data['last_name']}"; ?></td>
						</tr>
						<tr>
							<th>Contact Number</th>
							<td>:</td>
							<td><?php if(!empty($row_data['contact_number'])) echo $row_data['contact_number']; else echo "N/A"; ?></td>
						</tr>
						<tr>
							<th>Phone</th>
							<td>:</td>
							<td><?php if(!empty($row_data['phone'])) echo $row_data['phone']; else echo "N/A"; ?></td>
						</tr>
						<tr>
							<th>E-mail</th>
							<td>:</td>
							<td><?php if(!empty($row_data['email'])) echo $row_data['email']; else echo "N/A"; ?></td>
						</tr>
						<tr>
							<th>Street Address</th>
							<td>:</td>
							<td><?php if(!empty($row_data['street_address'])) echo $row_data['street_address']; else echo "N/A"; ?></td>
						</tr>
						<tr>
							<th>Suburb</th>
							<td>:</td>
							<td><?php if(!empty($row_data['suburb'])) echo $row_data['suburb']; else echo "N/A"; ?></td>
						</tr>
						<tr>
							<th>State</th>
							<td>:</td>
							<td><?php if(!empty($row_data['state'])) echo $row_data['state']; else echo "N/A"; ?></td>
						</tr>
						<tr>
							<th>Postcode</th>
							<td>:</td>
							<td><?php if(!empty($row_data['postcode'])) echo $row_data['postcode']; else echo "N/A"; ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


<div class="panel panel-primary">
	<div class="panel-heading">
		<h4>Details</h4>
	</div>
	<div class="panel-body">
		<?php if(!empty($row_data['details'])) echo nl2br($row_data['details']); else echo "N/A"; ?>
	</div>
</div>

<div class="panel panel-primary">
	<div class="panel-heading">
		<h4>Internal Details</h4>
	</div>
	<div class="panel-body">
		<?php if(!empty($row_data['internal_details'])) echo nl2br($row_data['internal_details']); else echo "N/A"; ?>
	</div>
</div>


<script src="<?= base_url(); ?>assets/admin/js/custom.js"></script>
<script type="text/javascript">
	pageSetUp();
</script>