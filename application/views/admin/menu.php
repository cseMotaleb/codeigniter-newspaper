<?php
$user_type = $this->session->userdata("user_type");
?>
<ul>
	<li class="">
		<a href="dashboard" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Dashboard</span></a>
	</li>

	<?php if($user_type == "Admin") { ?>
	<li>
		<a href="#"><i class="fa fa-lg fa-fw fa-file-text"></i> <span class="menu-item-parent">Pages</span></a>
		<ul>
			<li><a href="pages">Page List</a></li>
			<?php // <li><a href="pages/manage">Add Page</a></li> ?>
		</ul>
	</li>
	<?php } ?>

	<li><a href="#"><i class="fa fa-lg fa-fw fa-file-image-o"></i> Media Manager</a>
		<ul>
			<li><a href="media">Media Images</a></li>
			<li><a href="media_manager">Library Images</a></li>
		</ul>
	</li>

	<?php if($user_type == "Admin") { ?>
	<li>
		<a href="#"><i class="fa fa-lg fa-fw fa-file-text"></i> <span class="menu-item-parent">Website</span></a>
		<ul>
			<?php /*
			<li><a href="#">Menu Builder</a>
				<ul>
					<li><a href="menu_builder"><i class="fa fa-list"></i> Menu Builder</a></li>
					<li><a href="menu_builder/manage"><i class="fa fa-edit"></i> Add</a></li>
				</ul>
			</li>
			<li><a href="feedback">Feedback</a></li> */ ?>
			<li><a href="widgets">Widgets</a></li>	
			<li><a href="prayers">Prayers</a></li>	
			<li><a href="currency">Currency</a></li>	
		</ul>
	</li>
	<?php } ?>

	<li>
		<a href="#"><i class="fa fa-lg fa-fw fa-rss"></i> <span class="menu-item-parent">News</span></a>
		<ul>
			<li><a href="news"><i class="fa fa-list"></i> News List</a></li>
                        <?php if($user_type == 'Admin') { ?>
                        <li><a href="news/pending"><i class="fa fa-list"></i> Pending News List</a></li>
                        <?php } ?>
			<li><a href="news/manage"><i class="fa fa-plus-circle"></i> Add News</a></li>
			<li><a href="news/images"><i class="fa fa-picture-o"></i> Image Gallery</a></li>
			<li><a href="news/manage?type=image"><i class="fa fa-plus-circle"></i> Add Image Gallery</a></li>
			<li><a href="news/video"><i class="fa fa-file-video-o"></i> Video Gallery</a></li>
			<li><a href="news/manage?type=video"><i class="fa fa-plus-circle"></i> Add Video Gallery</a></li>
			<li><a href="news/categories"><i class="fa fa-list"></i> Categories</a></li>
			<li><a href="news/category"><i class="fa fa-plus-circle"></i> Add Category</a></li>
			<li><a href="news/highlight"><i class="fa fa-list"></i> Home 9 news position</a></li>
			<li><a href="news/comments"><i class="fa fa-comment-o"></i> Comments</a></li>
			<?php /* <li><a href="news/agents"><i class="fa fa-user"></i> Agents</a></li> */ ?>
		</ul>
	</li>

	<li>
		<a href="#"><i class="fa fa-lg fa-fw fa-question-circle-o"></i> <span class="menu-item-parent">Polls</span></a>
		<ul>
			<li><a href="polls"><i class="fa fa-list"></i> Poll List</a></li>
			<li><a href="polls/manage"><i class="fa fa-plus-circle"></i> Create New Poll</a></li>
		</ul>
	</li>
	
	<?php if($user_type == "Admin") { ?>
	<li><a href="advertisement"><i class="fa fa-lg fa-fw fa-camera"></i> <span class="menu-item-parent">Advertisement</span></a></li>
	<?php } ?>
<?php /*
	<li>
		<a href="#"><i class="fa fa-lg fa-fw fa-camera"></i> <span class="menu-item-parent">Advertisement</span></a>
		<ul>
			<li><a href="advertisement"><i class="fa fa-list"></i> Advertise List</a></li>
			<li><a href="advertisement/manage"><i class="fa fa-plus-circle"></i> Create New Advertise</a></li>
		</ul>
	</li>
*/ ?>
	
	<li>
		<a href="#"><i class="fa fa-lg fa-fw fa-cog"></i> <span class="menu-item-parent">Settings</span></a>
		<ul>
			<?php if($user_type == "Admin") { ?>
			<li><a href="users/userlist">Users</a></li>
			<?php } ?>
			<li><a href="config">Variables</a></li>
			<li><a target="_blank" href="<?= site_url("admin/backup"); ?>">Backup Database</a></li>
		</ul>
	</li>
</ul>