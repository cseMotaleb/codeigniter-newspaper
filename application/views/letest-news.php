<html>
	<head>
		<title>Letest News</title>
		<meta charset="utf-8">
		
	</head>
	<body>
		<div>
			<div id="">
				<div class="ticker_widget widget">
					<div class="ticker_holder" id="ticker_widget_47647">
						<div class="ticker_heading">
							শিরোনাম :
						</div>
						<div class="ticker_slider widget_marquee">
							<marquee truespeed="truespeed" scrolldelay="30" scrollamount="1" onmouseover="this.stop();" onmouseout="this.start();" direction="left" behavior="scroll" align="top">
			    				<?php $top_letest_news = top_letest_news(array("blog.enabled"=>1, "blog.recent"=>1), 8); ?>
			    				<?= $top_letest_news; ?>
			    			</marquee>
			    		</div>
			    	</div>
			    </div>

				<script type="text/javascript">
					var mode='1';if(mode=='1'){}
					else{new fadeAppear({container:'#ticker_widget_47647 .ticker_slider',slide:'.each_slide',paginContainer:'#ticker_widget_47647 .page_list',paginElem:'a',fadeTime:0.5,waitTime:5.0,next:'#ticker_widget_47647 .next',previous:'#ticker_widget_47647 .prev',isRandom:false,noAutoSlide:false,topBottom:true,transition:'slide',pauseToggle:'#ticker_widget_47647 .play_pause',});}
					function get_clone_gap(){var sum_li=0;var clone_gap=10;$('#ticker_widget_47647 .widget_marquee li').each(function(index,element){sum_li+=$(this).outerWidth(true);});if($('#ticker_widget_47647 .ticker_slider').width()&gt;sum_li)
					clone_gap=$('#ticker_widget_47647 .ticker_slider').width()-sum_li;return clone_gap;}
				</script>
				
				<?php /*
				<ul id="js-news" class="js-hidden">
					<?= $top_letest_news; ?>
				</ul>
				<script type="text/javascript">
				    $(function () {
				        $('#js-news').ticker({
				        	controls: true,
				        	pauseOnItems: 2000,
				        	titleText: 'সর্বশেষ'
				        });
				    });
				</script> */ ?>
			</div>
		</div>
	</body>
</html>