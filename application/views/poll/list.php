<br /><br />
<div class="cat-heading">
	<h3>জরিপ</h3>
</div>

<div id="pre_poll_result">
	<div id="pre_poll_result_block">

		<?php
		foreach ($poll_rows as $key => $row) {
			$url = non_english_url_title(strip_tags($row['poll']));
			$url = site_url("poll/{$row['id']}/{$url}");
		?>
		<div class="poll_list">
			<div class="poll_date">
				<?php
					$month = $this->bangla_week_day->get_monthname(date("F", strtotime($row['date'])));
					$day = $this->bangla_week_day->get_dayname(date("w", strtotime($row['date'])));
					echo $this->bangla_number->convert(date("{$day}, d {$month} Y", strtotime($row['date'])));
				?>
			</div>
			<div class="poll_ques"><p><?= nl2br($row['poll']); ?></p></div>
			<div class="res_summary">
				<div class="row">
					<div class="col-md-9 col-sm-9">
						<div class="total_voter">ভোটদাতা <?= $this->bangla_number->convert($row['total_vote']); ?> জন</div>
					</div><!--end col-md-9-->
					<div class="col-md-3 col-sm-3">
						<a href="<?= $url; ?>">
							<div class="dtl_btn">জরিপের ফল</div>
						</a>
					</div><!--end col-md-3-->
				</div><!--end row-->
			</div>
		</div>
		<?php } ?>
	</div>
</div>