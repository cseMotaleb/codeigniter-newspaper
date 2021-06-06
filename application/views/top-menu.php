<?php
  $cover_image = get_rows(array("table" => "media", "limit" => 1), array("type" => "Slider Image"));
  $cover_image = (isset($cover_image['id']) && file_exists("./{$cover_image['url']}")) ? base_url() . "{$cover_image['url']}" : base_url() . "img/cover.png";
  ?>
 <div id="main_header">
	<div class="container">
		<div class="row">
		<nav class="navbar navbar-default custom-menu">
			<div class="col-xs-6 col-sm-6 col-md-2">
			    <!-- BRAND -->
			    <div class="navbar-header">
			     
			      <a class="navbar-brand" href="<?= base_url(); ?>"> <img class="logo" alt="Logo" src="<?= $cover_image; ?>"/> </a>
			    </div>
		    </div>
		    <div class="col-md-8 hidden-xs hidden-sm">
		    <!-- COLLAPSIBLE NAVBAR -->
		    <div class="collapse navbar-collapse" id="alignment-example">
		      <!-- Links -->
		      <ul class="nav navbar-nav">
		      	
		   

		 	<?php
	    		$i= 0;
				$current_cat = "";
	    		$list_category = array();
	    		

    		foreach ($categories as $key => $category) :
    			//if($i == 0) { $list_category = $category['parent']; $current_cat = $category['category_url']; }
				if(isset($category_data['id']) && ($category_data['id'] == $category['id'])) { $list_category = $category['parent']; /*$current_cat = $category['category_url'];*/ }
    			$url = site_url("category/{$category['category_url']}");
				$total_parent = count($category['parent']);
			
    		?>
    		

    		<?php if($total_parent > 0) :?>

		        <li class="dropdown">
		          	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= $category['category']; ?><span class="caret"></span></a>
			        <ul class="dropdown-menu">
			        	<!-- <li><a href="<?= $url; ?>"><?= $category['category']; ?></a></li> -->
			        	<?php
						foreach ($category['parent'] as $key => $parent) :
							$url = site_url("category/{$category['category_url']}/{$parent['category_url']}");
						?>
			            <li><a href="<?= $url; ?>"><?= $parent['category']; ?></a></li>
			        	<?php endforeach;?>
			        </ul>
		        </li>
	        <?php else : ?>
	        	
	        		<li><a href="<?= $url; ?>"><?= $category['category']; ?></a></li>


	    	
	    	<?php endif;?>
	    	<?php endforeach;?>
	    	

		        <!-- <li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">কোভিড-১৯<span class="caret"></span></a>
		          <ul class="dropdown-menu">
		           
		            <li><a href="<?= $url; ?>">জাতীয়</a></li>
		          
		          </ul>
		        </li>
		      
		        <li><a href="<?= $url; ?>">রাজনীতি</a></li>
		        <li><a href="<?= $url; ?>">অর্থনীতি</a></li>
		        <li><a href="<?= $url; ?>">আন্তর্জাতিক</a></li>
		        <li><a href="<?= $url; ?>">সারাদেশ</a></li>
		        <li><a href="<?= $url; ?>">খেলা</a></li>
		        <li><a href="<?= $url; ?>">সারাদেশ</a></li> -->
		      <!--   <li><a href="<?= $url; ?>">বিনোদন</a></li>
		        <li><a href="<?= $url; ?>">শিক্ষাঙ্গন</a></li>
		        <li><a href="<?= $url; ?>">লাইফ স্টাইল</a></li> -->
		      </ul>
		      
		    </div>
		</div>
		<div class="col-xs-6 col-sm-6 col-md-2">

			<!-- Right -->
		      	<div class="navbar-right right-catmenu">
		      		<ul class="menu-cat">
			      		<li><a href="">
			      			<div id="masthead">
				      	 	  <button class="hamburger hamburger--boring" type="button">
						          <span class="hamburger-box">
						            <span class="hamburger-inner"></span>
						          </span>
						          <span class="hamburger-label">আরও</span>
						        </button>
						    </div>
						    </a>
			      	 	</li>
			      	 	<li>
			      	 		<div class="search-box">
			      	 			<div class="dropdown">
									<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fas fa-search"></i>
									<span class="caret"></span></button>
									<ul class="dropdown-menu">
									<li>
										<form method="get" action="<?= site_url("search"); ?>">
				                            <div id="imaginary_container" style="margin-top:0">
				                                <div class="input-group stylish-input-group" style="padding:0;">
				                                    <input type="text" name="q" class="form-control" value="" placeholder="Search">
				                                    <span class="input-group-addon">
										                        <button type="submit">
										                            <span class="fa fa-search"></span>
										                        </button>  
										                    </span>
				                                </div>
				                            </div>
				                        </form>
								    </li>
									</ul>
								</div>
				      	 	
				      	 	</div> 

			      	 	</li>
			      	</ul>
				</div>
				<!-- Right -->
		</div>
		
		</nav>

		<nav id="site-nav" role="navigation">
           <div class="container">
                <?php
                $top_menu = $this->blog_model->categories(array("bottom_menu" => 1, "enabled" => 1));

                $i = 0;
                $count = 0;
                ?>
                <div class="row">
                    <?php if (is_countable($top_menu) && count($top_menu) > 0): ?>
                        <?php foreach ($top_menu as $fmenu) :
                            $url = base_url() . 'category/' . $fmenu['category_url'];
                            $i++;
                            $count++;
                            if ($count == 19) {
                                break;
                            }
                            if ($i == 1) {
                                echo "<div class='col-xs-6 col-sm-4 col-md-2'>";
                            }
                            ?>
                            <ul class="footer_menu">
                                <li>
                                    <a href="<?= $url; ?>"><?= $fmenu['category'];; ?></a>
                                </li>
                            </ul>
                            <?php
                            if ($i == 3) {
                                echo "</div>";
                                $i = 0;
                            }
                            ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
		</div>
	</div>
</div>
<script>
 $(function() {
    $('body').addClass('js');
  
    var $hamburger = $('.hamburger'),
        $nav = $('#site-nav'),
        $masthead = $('#masthead');
  
    $hamburger.click(function() {
      $(this).toggleClass('is-active');
      $nav.toggleClass('is-active');
      $masthead.toggleClass('is-active');
      return false; 
    })

   
});

  
  
</script>