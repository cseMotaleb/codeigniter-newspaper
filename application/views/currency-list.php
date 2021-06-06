<?php
$currency_rows = get_rows(array("table"=>"currency", "limit"=>200), array());
?>

<div class="new-title">
	<div class="title-left">
		<a href="#">মুদ্রামান</a>
	</div>
	<div class="title-border"></div>
	<div class="title-right">
		<div class="pull-right">
			<img style="width: 24px" class="img-responsive" src="<?= base_url(); ?>img/money.png" />
		</div>
	</div>
</div>
<table class="table table-striped table-bordered table-currency">
	<thead>
		<tr>
			<th style="font-size: 20px;" class="text-center">মুদ্রা</th>
			<th style="font-size: 20px;" class="text-center">বিক্রয়</th>
			<th style="font-size: 20px;" class="text-center">ক্রয়</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($currency_rows as $key => $row) { ?>
		<tr>
			<td><?= $row['currency']; ?></td>
			<td class="text-center"><?= $row['sale']; ?></td>
			<td class="text-center"><?= $row['purchase']; ?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>