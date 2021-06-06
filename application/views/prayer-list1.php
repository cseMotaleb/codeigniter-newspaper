<div class="cat-heading">
	<h3>নামাজের সময়সূচী (ঢাকা ওয়াক্ত শুরু)</h3>
</div>

<img class="img-responsive" src="<?= base_url(); ?>img/namaj.png" />

<table class="table table-bordered">
	<tbody>
		<tr>
			<td width="30%">
				<div class="text-center">
					<span>ফজর</span>
				</div>
			</td>
			<td>
				<div class="text-center">
					<span><?php if(isset($prayer_data['prayer1'])) echo $prayer_data['prayer1']; else echo "ভোর ৫টা ৪০ মিনিট"; ?></span>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="text-center">
					<span>জোহর</span>
				</div>
			</td>
			<td>
				<div class="text-center">
					<span><?php if(isset($prayer_data['prayer2'])) echo $prayer_data['prayer2']; else echo "দুপুর ১টা ১৫ মিনিট"; ?></span>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="text-center">
					<span>আসর</span>
				</div>
			</td>
			<td>
				<div class="text-center">
					<span><?php if(isset($prayer_data['prayer3'])) echo $prayer_data['prayer3']; else echo "বিকেল ৮টা ৩০ মিনিট"; ?></span>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="text-center">
					<span>মাগরিব</span>
				</div>
			</td>
			<td>
				<div class="text-center">
					<span><?php if(isset($prayer_data['prayer4'])) echo $prayer_data['prayer4']; else echo "সন্ধ্যা ৬টা ১৫ মিনিট"; ?></span>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="text-center">
					<span>এশা</span>
				</div>
			</td>
			<td>
				<div class="text-center">
					<span><?php if(isset($prayer_data['prayer5'])) echo $prayer_data['prayer5']; else echo "রাত ৮টা"; ?></span>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="text-center">
					<span>জুম’আ</span>
				</div>
			</td>
			<td>
				<div class="text-center">
					<span><?php if(isset($prayer_data['prayer6'])) echo $prayer_data['prayer6']; else echo "দুপুর ১টা ৩০ মিনিট"; ?></span>
				</div>
			</td>
		</tr>
	</tbody>
</table>