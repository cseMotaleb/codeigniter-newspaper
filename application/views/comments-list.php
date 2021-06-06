<style type="text/css">

</style>
<div>
	<h3>পাঠকের মন্তব্য (<?= $this->bangla_number->convert(count($comments)); ?>)</h3>
</div>
<div class="blog-comment">
	<ul class="comments">
		<?php
			foreach ($comments as $key => $row) {
		?>
		<li class="clearfix">
		  	<img src="<?= base_url(); ?>img/avatars/picture.jpg" class="avatar" alt="">
		  	<div class="post-comments">
		      	<p class="meta">
		      		<?= $this->bangla_number->convert(date("Y-m-d h:i", $row['time'])); ?> 
		      		<a href="#"><?= $row['name']; ?></a> says : 
		      		<span class="pull-right"><button data-id="<?= $row['id']; ?>" class="btn btn-default btn-xs btn-like"><i class="fa fa-thumbs-o-up"></i>&nbsp;&nbsp;&nbsp;<span id="like-details<?= $row['id']; ?>"><?= $this->bangla_number->convert($row['total_like']); ?></span></button><button data-id="<?= $row['id']; ?>" class="btn btn-default btn-xs btn-dislike"><i class="fa fa-thumbs-o-down"></i>&nbsp;&nbsp;&nbsp;<span  id="dislike-details<?= $row['id']; ?>"><?= $this->bangla_number->convert($row['total_dislike']); ?></span></button></span>
		      	</p>
		      	<p>
		         	<?= nl2br($row['comment']); ?>
		      	</p>
		  	</div>

			<?php /*
		  	<ul class="comments">
		      	<li class="clearfix">
		          	<img src="http://bootdey.com/img/Content/user_3.jpg" class="avatar" alt="">
		          	<div class="post-comments">
		              	<p class="meta">Dec 20, 2014 <a href="#">JohnDoe</a> says : <i class="pull-right"><a href="#"><small>Reply</small></a></i></p>
		              	<p>
		                  	Lorem ipsum dolor sit amet, consectetur adipiscing elit.
		                  	Etiam a sapien odio, sit amet
		             	</p>
		          	</div>
		      	</li>
		  	</ul> */ ?>
		</li>
		<?php } ?>
	</ul>
</div>