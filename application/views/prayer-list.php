
<?php /*
<div class="cat-heading">
	<h3>নামাজের সময়সূচী (ঢাকা ওয়াক্ত শুরু)</h3>
</div>

<img class="img-responsive" src="<?= base_url(); ?>img/namaj.png" />

<table class="table table-bordered">
	<tbody>
		<tr>
			<td width="30%">
				<div class="text-center">
					<span style="font-size: 22px;">ফজর</span>
				</div>
			</td>
			<td>
				<div class="text-center">
					<span style="font-size: 22px;"><?php if(isset($prayer_data['prayer1'])) echo $prayer_data['prayer1']; else echo "ভোর ৫টা ৪০ মিনিট"; ?></span>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="text-center">
					<span style="font-size: 22px;">জোহর</span>
				</div>
			</td>
			<td>
				<div class="text-center">
					<span style="font-size: 22px;"><?php if(isset($prayer_data['prayer2'])) echo $prayer_data['prayer2']; else echo "দুপুর ১টা ১৫ মিনিট"; ?></span>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="text-center">
					<span style="font-size: 22px;">আসর</span>
				</div>
			</td>
			<td>
				<div class="text-center">
					<span style="font-size: 22px;"><?php if(isset($prayer_data['prayer3'])) echo $prayer_data['prayer3']; else echo "বিকেল ৮টা ৩০ মিনিট"; ?></span>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="text-center">
					<span style="font-size: 22px;">মাগরিব</span>
				</div>
			</td>
			<td>
				<div class="text-center">
					<span style="font-size: 22px;"><?php if(isset($prayer_data['prayer4'])) echo $prayer_data['prayer4']; else echo "সন্ধ্যা ৬টা ১৫ মিনিট"; ?></span>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="text-center">
					<span style="font-size: 22px;">এশা</span>
				</div>
			</td>
			<td>
				<div class="text-center">
					<span style="font-size: 22px;"><?php if(isset($prayer_data['prayer5'])) echo $prayer_data['prayer5']; else echo "রাত ৮টা"; ?></span>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="text-center">
					<span style="font-size: 22px;">জুম’আ</span>
				</div>
			</td>
			<td>
				<div class="text-center">
					<span style="font-size: 22px;"><?php if(isset($prayer_data['prayer6'])) echo $prayer_data['prayer6']; else echo "দুপুর ১টা ৩০ মিনিট"; ?></span>
				</div>
			</td>
		</tr>
	</tbody>
</table> */ ?>


<div class="prayerTimePanel">
	<div class="prayerTimeTitle"></div>
	<div class="dateShow">
		<?php
         	$week_day = $this->bangla_week_day->get_dayname();
			$month = $this->bangla_week_day->get_monthname(date("F"));
			echo $this->bangla_number->convert(date("{$week_day}, d {$month} Y ইং"));
		?>
	</div>
	<div class="prayerTimeTable">
		<table width="100%" cellspacing="1" cellpadding="1">
			<tbody>
				<tr>
					<td><span class="prayerName">ফজর</span></td>
					<td><span class="prayerTime"><?php if(isset($prayer_data['prayer1'])) echo $prayer_data['prayer1']; else echo "ভোর ৫টা ৪০ মিনিট"; ?></span></td>
				</tr>
				<tr>
					<td><span class="prayerName">যোহর</span></td>
					<td><span class="prayerTime"><?php if(isset($prayer_data['prayer2'])) echo $prayer_data['prayer2']; else echo "দুপুর ১টা ১৫ মিনিট"; ?></span></td>
				</tr>
				<tr>
					<td><span class="prayerName">আসর</span></td>
					<td><span class="prayerTime"><?php if(isset($prayer_data['prayer3'])) echo $prayer_data['prayer3']; else echo "বিকেল ৮টা ৩০ মিনিট"; ?></span></td>
				</tr>
				<tr>
					<td><span class="prayerName">মাগরিব</span></td>
					<td><span class="prayerTime"><?php if(isset($prayer_data['prayer4'])) echo $prayer_data['prayer4']; else echo "সন্ধ্যা ৬টা ১৫ মিনিট"; ?></span></td>
				</tr>
				<tr>
					<td><span class="prayerName">এশা</span></td>
					<td><span class="prayerTime"><?php if(isset($prayer_data['prayer5'])) echo $prayer_data['prayer5']; else echo "রাত ৮টা"; ?></span></td>
				</tr>
				<?php /*
				<tr>
					<td><span class="prayerName">জুম’আ</span></td>
					<td><span class="prayerTime"><?php if(isset($prayer_data['prayer6'])) echo $prayer_data['prayer6']; else echo "দুপুর ১টা ৩০ মিনিট"; ?></span></td>
				</tr> */ ?>
			</tbody>
		</table>
	</div>
	<?php /* <div class="nonPrayTime"><span class="sunrise">সূর্যোদয় - ০৫:৩০</span><span class="sunset">সূর্যাস্ত - ০৬:৩৮</span></div> */ ?>
</div>
<br />