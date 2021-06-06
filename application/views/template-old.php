<!doctype html>
<html>
<head prefix="og: http://ogp.me/ns#">
<title>NTV: Latest Bangla News, Infotainment, Online & Live Tv</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content="NTV, bangla news, current News, News, Infotainment, videos, photos, live news, live tv, broadcasting, news for india, pakistan, usa, uk, iraq,  breaking news, bangla newspaper, bangladesh news, online newspaper, bangladeshi newspaper, bangladesh newspapers, all bangla news, bd news, news paper, daily News, bangla paper, election, news website, politics, world news, business news, bollywood news, cricket news, sports, lifestyle, gadgets, tech news, video news,video song, music, film, drama, talk show, reciepe, sports news, celebrity photo, picture, automible news, travel news, healthcare news, welness news, travel news, fashion news, education news, অনলাইন, বাংলাদেশ, আজকের সংবাদ/খবর , আন্তর্জাতিক, অর্থনীতি, খেলা, বিনোদন, ফিচার, বিজ্ঞান ও প্রযুক্তি, চলচ্চিত্র, ঢালিউড, বলিউড, হলিউড, বাংলা গান, মঞ্চ, টেলিভিশন, কম্পিউটার, মোবাইল ফোন, অটোমোবাইল, মহাকাশ, গেমস, মাল্টিমিডিয়া, রাজনীতি, সরকার, অপরাধ, আইন ও বিচার, পরিবেশ, দুর্ঘটনা, সংসদ, রাজধানী, শেয়ার বাজার, বাণিজ্য, পোশাক শিল্প, ক্রিকেট, ফুটবল, লাইভ স্কোর"/>
<meta name="description" content="NTV Online, a bilingual (Bangla & English) infotainment portal covering latest news, entertainment program, sports, tech, travel, automobile, lifestyle, education news with photo and video. এনটিভি বাংলা অনলাইনে আপনাদের জন্য থাকছে ছবি ও ভিডিও সহ জাতীয়, বিনোদন, খেলা, ক্রিকেট, ফুটবল, দুনিয়ার সর্বশেষ ও সাম্প্রতিক খবরাখবর।"/>


<!-- Placed js at the end of the document so the pages load faster -->
<script type="text/javascript" src="//cdn.bn.ntvbd.com/js/jquery-1.11.1.min.js"></script>

<script type="text/javascript" src="//cdn.bn.ntvbd.com/js/bootstrap-3.3.0.min.js"></script>
<script type="text/javascript" src="//cdn.bn.ntvbd.com/js/canvasjs.min.js"></script>
<script type="text/javascript" src="//cdn.bn.ntvbd.com/js/pie-chart.js"></script>
<script type="text/javascript" src="//cdn.bn.ntvbd.com/js/phoneticunicode.js"></script>
<script type="text/javascript" src="//cdn.bn.ntvbd.com/js/unijoy.js"></script>
<script type="text/javascript" src="//cdn.bn.ntvbd.com/js/jquery.gdocsviewer.min.js"></script>
<script type="text/javascript" src="//cdn.bn.ntvbd.com/js/custom-language.js"></script>
<script type="text/javascript" src="//cdn.bn.ntvbd.com/js/login.js"></script>

<script>
    function mega_menu_summary(cat_id,pid){
        var URL = 'http://www.ntvbd.com/templates/ntv-v1/ajax/mega_menu_summary.php';

        // Load mega data summary
        $.ajax({
            url:URL,
            type:"POST",
            data:{cat_id:cat_id},
            beforeSend:function(){
                $('div.mega_list_block > #sub_mega_sum-'+pid).html('<div style="padding:10px; text-align:left">লোডিং...</div>');
            },
            success:function(msg){
                $('div.mega_list_block > #sub_mega_sum-'+pid).html(msg);
            },
            error:function(jqXHR, textStatus, errorMessage) {
            	
            }
        });
    }

    /**
     * MEGA DIST SUMMARY BLOCK FUNCTION
     */
    function mega_dist_summary(dist_title,pid){
        var URL = 'http://www.ntvbd.com/templates/ntv-v1/ajax/mega_dist_summary.php';

        // Load mega data summary
        $.ajax({
            url:URL,
            type:"POST",
            data:{dist_title:dist_title},
            beforeSend:function(){
                $('div.mega_list_block > #dis_mega_sum-'+pid).html('<div style="padding:10px; text-align:left">লোডিং...</div>');
            },
            success:function(msg){
                $('div.mega_list_block > #dis_mega_sum-'+pid).html(msg);
            },
            error:function(jqXHR, textStatus, errorMessage){
            }
        });
    }

    /**
     * NTV MOST VIEW FUNCTIONS
     */
    function most_viewed_list(){
        if($('.most_view_tab_block .second-layer .btn.active').hasClass('news')) var URL = 'http://www.ntvbd.com/templates/ntv-v1/ajax/most_viewed_news.php?cat_id=';
        else if($('.most_view_tab_block .second-layer .btn.active').hasClass('videos')) var URL = 'http://www.ntvbd.com/templates/ntv-v1/ajax/most_viewed_videos.php';
        else if($('.most_view_tab_block .second-layer .btn.active').hasClass('photos')) var URL = 'http://www.ntvbd.com/templates/ntv-v1/ajax/most_viewed_photos.php';

        if($('.most_view_tab_block .third-layer .btn.active').hasClass('todays')) var data = 'todays';
        else if($('.most_view_tab_block .third-layer .btn.active').hasClass('one_month')) var data = 'one_month';
        else if($('.most_view_tab_block .third-layer .btn.active').hasClass('three_month')) var data = 'three_month';
        // Load cart data update
        $.ajax({
            url:URL,
            type:"POST",
            data:{data:data},
            beforeSend:function(){
                $('.most_view_tab_block .most_viewed_display_block').html('<div style="padding:5px 0">লোডিং...</div>');
            },
            success:function(msg){
                $('.most_view_tab_block .most_viewed_display_block').html(msg);
            },
            error:function(jqXHR, textStatus, errorMessage){
            }
        });
    }

    /**
     * NTV MOST VIEW FUNCTIONS
     */
    function most_commented_list(){
        if($('.most_view_tab_block .second-layer .btn.active').hasClass('news')) var URL = 'http://www.ntvbd.com/templates/ntv-v1/ajax/most_commented_news.php?host=www.ntvbd.com&cat_id=';
        else if($('.most_view_tab_block .second-layer .btn.active').hasClass('videos')) var URL = 'http://www.ntvbd.com/templates/ntv-v1/ajax/most_commented_news.php?host=video.ntvbd.com';
        else if($('.most_view_tab_block .second-layer .btn.active').hasClass('photos')) var URL = 'http://www.ntvbd.com/templates/ntv-v1/ajax/most_commented_news.php?host=photo.ntvbd.com';

        if($('.most_view_tab_block .third-layer .btn.active').hasClass('todays')) var data = 'todays';
        else if($('.most_view_tab_block .third-layer .btn.active').hasClass('one_month')) var data = 'one_month';
        else if($('.most_view_tab_block .third-layer .btn.active').hasClass('three_month')) var data = 'three_month';
        // Load cart data update
        $.ajax({
            url:URL,
            type:"POST",
            data:{data:data},
            beforeSend:function(){
                $('.most_view_tab_block .most_viewed_display_block').html('<div style="padding:5px 0">লোডিং...</div>');
            },
            success:function(msg){
                $('.most_view_tab_block .most_viewed_display_block').html(msg);
            },
            error:function(jqXHR, textStatus, errorMessage){
            }
        });
    }

    /**
     * NTV SEARCH FUNCTION
     */
    function ntv_search(srchInputElm){
        var keyword = srchInputElm.val().trim().toLowerCase().replace(/\s/g,'+');
        if(keyword==''){
            srchInputElm.css({'background':'#FF9','color':'#444'}).focus()
        }else{
            var srch_type = $('input[name="srch_type"]:checked').val();
            if(srch_type=='google'){
                var URL = 'http://www.ntvbd.com/search/google/?q='+keyword+'&cx='+encodeURIComponent('partner-pub-2048928514082800:7777012178')+'&cof='+encodeURIComponent('FORID:10')+'&ie=UTF-8&sa=Search';
                window.location.href = URL;
            }else if(srch_type=='youtube'){
                var URL = 'http://www.ntvbd.com/search/youtube/?q='+keyword+'';
                window.location.href = URL;
            }
            else{
                /*var URL = ''+keyword;*/
                var URL = 'http://www.ntvbd.com/search/google/?q='+keyword+'&cx='+encodeURIComponent('partner-pub-2048928514082800:7777012178')+'&cof='+encodeURIComponent('FORID:10')+'&ie=UTF-8&sa=Search';
                window.location.href = URL;
            }
        }
    }

    $(function(){
        /**
         * Mega Menu Dipslay
         */
        $('#menu_category div.mega_list_block > div.sub_mega_list > ul > li').hover(function(){
            if(!$(this).hasClass('active')){
                var cat_id 	= $(this).attr('data-val');
                var pid		= $(this).attr('parent-data');
                $('#menu_category div.mega_list_block > div.sub_mega_list > ul > li').removeClass('active');
                $(this).addClass('active');
                if(cat_id>0) mega_menu_summary(cat_id,pid);
            }
        });

        $('#menu_category > ul > li.mega_parent').hover(function(){
            /**
             * SETUP CURRECT POSITION
             */
            // get the current position
            var pos = $('div.mega_list_block',this).position();
            // setup compare position
            var com_pos = pos.left+450, limit_pos = 990;
            if(com_pos>limit_pos){
                var diff_pos = com_pos - limit_pos;
                $('div.mega_list_block',this).css('margin-left','-'+diff_pos+'px');
            }

            $('div.mega_list_block > div.sub_mega_list > ul > li').removeClass('active');
            var cat_id 	= $('div.mega_list_block > div.sub_mega_list > ul > li:first-child',this).addClass('active').attr('data-val');
            var pid 	= $('div.mega_list_block > div.sub_mega_list > ul > li:first-child',this).addClass('active').attr('parent-data');
            if(cat_id>0) mega_menu_summary(cat_id,pid);
        });

        /**
         * Mega District Dipslay
         */
        $('#division_list div.mega_list_block > div.sub_mega_list > ul > li').hover(function(){
            if(!$(this).hasClass('active')){
                var dist_title 	= $(this).attr('data-val');
                var pid			= $(this).attr('parent-data');
                $('#division_list div.mega_list_block > div.sub_mega_list > ul > li').removeClass('active');
                $(this).addClass('active');
                if(dist_title!='') mega_dist_summary(dist_title,pid);
            }
        });

        $('#division_list > ul > li').hover(function(){
            /**
             * SETUP CURRECT POSITION
             */
            // get the current position
            var pos = $('div.mega_list_block',this).position();
            // setup compare position
            var com_pos = pos.left+450, limit_pos = 990;

            if(com_pos>limit_pos){
                var diff_pos = com_pos - limit_pos;
                $('div.mega_list_block',this).css('margin-left','-'+diff_pos+'px');
            }

            $('#division_list div.mega_list_block > div.sub_mega_list > ul > li').removeClass('active');
            var dist_title 	= $('div.mega_list_block > div.sub_mega_list > ul > li:first-child',this).addClass('active').attr('data-val');
            var pid 	= $('div.mega_list_block > div.sub_mega_list > ul > li:first-child',this).addClass('active').attr('parent-data');
            if(dist_title!='') mega_dist_summary(dist_title,pid);
        });

        /**
         * Corner news display
         */
        var corner_index = 0;
        var last_index = $('#top_content .top_corner_news > ul > li:last-child').index();

        var corner_news_interval = setInterval(function(){
            var cur_index = $('#top_content .top_corner_news > ul > li:visible').index();
            var nxt_index = cur_index + 1;
            if(nxt_index>last_index) nxt_index = 0;
            $('#top_content .top_corner_news > ul > li:eq('+(cur_index)+')').fadeOut();
            $('#top_content .top_corner_news > ul > li:eq('+(nxt_index)+')').fadeIn();
        },1000*5);

        /**
         * Breaking list section
         */
        var brk_list_width = 0;
        $('.headlines li').each(function(index, element) {
            brk_list_width = brk_list_width + $(this).innerWidth() + 25;
        });
        //alert(total_hl_list_width);
        $('.headlines ul').css('width',brk_list_width);

        /**
         * Healine list section
         */
        var total_hl_list_width = 0;
        $('.hl_list li').each(function(index, element) {
            total_hl_list_width = total_hl_list_width + $(this).innerWidth() + 25;
        });
        //alert(total_hl_list_width);
        $('.hl_list ul').css('width',total_hl_list_width);

        /**
         * Details page more reporter display
         */
        $('#details_content .rpt_info_section > div.rpt_more').click(function(){
            if($('i',this).hasClass('fa-arrow-circle-o-down')){
                $('i',this).removeClass('fa-arrow-circle-o-down').addClass('fa-arrow-circle-o-up');
                $('#details_content .rpt_info_section > div.rpt_more_list_block').slideDown();
            }else{
                $('i',this).removeClass('fa-arrow-circle-o-up').addClass('fa-arrow-circle-o-down');
                $('#details_content .rpt_info_section > div.rpt_more_list_block').slideUp();
            }
        });

        /**
         * Details photo slider
         */
        var cur_dtl_font_size = 15, dtl_font_low_limit = 15, dtl_font_high_limit = 30;
        $('#details_content .smallFontIcon').click(function(){
            if((cur_dtl_font_size - 1) >= dtl_font_low_limit){
                cur_dtl_font_size 		= cur_dtl_font_size - 1;
                var line_hght_size 		= cur_dtl_font_size + 4;
                $('#details_content .dtl_section').css({
                    'font-size' 	: cur_dtl_font_size + 'px',
                    'line-height'	: line_hght_size + 'px'
                });
            }
        });

        $('#details_content .bigFontIcon').click(function(){
            if((cur_dtl_font_size + 1) <= dtl_font_high_limit){
                cur_dtl_font_size 		= cur_dtl_font_size + 1;
                var line_hght_size 		= cur_dtl_font_size + 4;
                $('#details_content .dtl_section').css({
                    'font-size' 	: cur_dtl_font_size + 'px',
                    'line-height'	: line_hght_size + 'px'
                });
            }
        });

        $('#details_content .dtl_section > .dtl_img_section > ul > li.pre-photo,#details_content .dtl_section > .dtl_full_img_section > ul > li.pre-photo').click(function(){
            var cur_photo_obj = $('#details_content .dtl_section > .dtl_img_section > ul > li.pre-photo,#details_content .dtl_section > .dtl_full_img_section > ul > li.active');
            var cur_photo_index = cur_photo_obj.index();
            var pre_photo_obj = $('#details_content .dtl_section > .dtl_img_section > ul > li.pre-photo,#details_content .dtl_section > .dtl_full_img_section > ul > li.photo:nth-child('+(cur_photo_index)+')');
            if(pre_photo_obj.hasClass('photo')){
                $(cur_photo_obj).removeClass('active').fadeOut();
                $(pre_photo_obj).addClass('active').fadeIn();
            }else{
                var album_url = $(this).attr('data-album-url');
                window.location.href = album_url;
            }
        });

        $('#details_content .dtl_section > .dtl_img_section > ul > li.nxt-photo,#details_content .dtl_section > .dtl_full_img_section > ul > li.nxt-photo').click(function(){
            var cur_photo_obj = $('#details_content .dtl_section > .dtl_img_section > ul > li.nxt-photo,#details_content .dtl_section > .dtl_full_img_section > ul > li.active');
            var cur_photo_index = cur_photo_obj.index();
            var nxt_photo_obj = $('#details_content .dtl_section > .dtl_img_section > ul > li.nxt-photo,#details_content .dtl_section > .dtl_full_img_section > ul > li.photo:nth-child('+(cur_photo_index+2)+')');
            if(nxt_photo_obj.hasClass('photo')){
                $(cur_photo_obj).removeClass('active').fadeOut();
                $(nxt_photo_obj).addClass('active').fadeIn();
            }else{
                var album_url = $(this).attr('data-album-url');
                window.location.href = album_url;
            }
        });

        /**
         * MOST VIEWED OR HITS DISPLAY SECTION
         */
        $('.most_view_tab_block .first-layer .btn').click(function(){
            $('.most_view_tab_block .first-layer .btn').removeClass('active');
            $(this).addClass('active');

            if($('.most_view_tab_block .most_clicks').hasClass('active')) most_viewed_list();
            else if($('.most_view_tab_block .most_comments').hasClass('active')) most_commented_list();
        });
        $('.most_view_tab_block .second-layer .btn').click(function(){
            var rpt_type = '';
            if($('.most_view_tab_block .most_clicks').hasClass('active')){
                if(!$(this).hasClass('active')){
                    $('.most_view_tab_block .second-layer .btn').removeClass('active');
                    $(this).addClass('active');

                    most_viewed_list();
                }
            }else if($('.most_view_tab_block .most_comments').hasClass('active')){
                if(!$(this).hasClass('active')){
                    $('.most_view_tab_block .second-layer .btn').removeClass('active');
                    $(this).addClass('active');

                    most_commented_list();
                }
            }
        });

        $('.most_view_tab_block .third-layer .btn').click(function(){
            var rpt_type = '';
            if($('.most_view_tab_block .most_clicks').hasClass('active')){
                if(!$(this).hasClass('active')){
                    $('.most_view_tab_block .third-layer .btn').removeClass('active');
                    $(this).addClass('active');

                    most_viewed_list();
                }
            }else if($('.most_view_tab_block .most_comments').hasClass('active')){
                if(!$(this).hasClass('active')){
                    $('.most_view_tab_block .third-layer .btn').removeClass('active');
                    $(this).addClass('active');

                    most_commented_list();
                }
            }
        });

        // default load
        var URL = 'http://www.ntvbd.com/templates/ntv-v1/ajax/most_viewed_news.php?cat_id=';
        var data = 'todays';

        // Load cart data update
        $.ajax({
            url:URL,
            type:"POST",
            data:{data:data},
            beforeSend:function(){
                $('.most_view_tab_block .most_viewed_display_block').html('<div style="padding:5px 0">লোডিং...</div>');
            },
            success:function(msg){
                $('.most_view_tab_block .most_viewed_display_block').html(msg);
            },
            error:function(jqXHR, textStatus, errorMessage){
            }
        });


        /**
         * MOBILE MENU BAR LINK
         */
        if($("#mobile_header .cat_collapse_bar").is(':visible')){

            $("#mobile_header .cat_collapse_bar").click(function(){
                $('#mobile_menu_category > div').slideToggle();
            });

        }

        /**
         * FOOTER MORE LINK FOR MOBILE
         */
        if($("#mobile_footer .footer-morelink-bar").is(':visible')){

            $("#mobile_footer .footer-morelink-bar").click(function(){
                $('#mobile_footer .moreLinks').slideToggle();
            });

        }

        /**
         * SEARCH BUTTON ACTION
         */
        if($('#ntv_srch_keyword').is(':visible')){
            var topSrchBtnInterval = '',top_btn_click_val = 0;
            $('.top_srch_entry_type > .bn_entry_type').click(function(){
                $('#ntv_srch_keyword').focus(); top_btn_click_val = 1;
            });
            $('#ntv_srch_keyword').on('focus',function(){
                $('.top_srch_entry_type').show();
            });
            $('#ntv_srch_keyword').on('blur',function(){
                var topSrchBtnInterval = setInterval(function(){
                    if(top_btn_click_val==0){
                        $('.top_srch_entry_type').hide();
                    }else top_btn_click_val = 0;
                    clearInterval(topSrchBtnInterval);
                },200);
            });
            makeUnijoyEditor('ntv_srch_keyword');
        }
        if($('#ntv_bottom_srch_keyword').is(':visible')){
            var bottomSrchBtnInterval = '',bottom_btn_click_val = 0;
            $('.bottom_srch_entry_type > .bn_entry_type').click(function(){
                $('#ntv_bottom_srch_keyword').focus(); bottom_btn_click_val = 1;
            });
            $('#ntv_bottom_srch_keyword').on('focus',function(){
                $('.bottom_srch_entry_type').show();
            });
            $('#ntv_bottom_srch_keyword').on('blur',function(){
                var bottomSrchBtnInterval = setInterval(function(){
                    if(bottom_btn_click_val==0){
                        $('.bottom_srch_entry_type').hide();
                    }else bottom_btn_click_val = 0;
                    clearInterval(bottomSrchBtnInterval);
                },200);
            });
            makeUnijoyEditor('ntv_bottom_srch_keyword');
        }

        if($('#srch_keyword').is(':visible')) makeUnijoyEditor('srch_keyword');
        $('.ntv-srch-btn').click(function(){
            var keyword = $('.srch_keyword').val().trim().toLowerCase().replace(/\s/g,'+');
            var category = $('.srch_category').val();
            if(keyword==''){
                $('.srch_keyword').css('background','#FF9').focus()
            }else{
                var URL = 'http://www.ntvbd.com/search/?q='+keyword;
                if(category!='') URL = URL + '&category=' + category;
                window.location.href = URL;
            }
        });

        $('.google-srch-btn').on('click', function(e){
            var category = $('.srch_category').val();
            var keyword = $('.srch_keyword').val().trim().toLowerCase().replace(/\s/g,'+');
            if(category!='') keyword = keyword + ' site:http://www.ntvbd.com/'+category;
            if(keyword==''){
                $('.srch_keyword').css('background','#FF9').focus()
            }else{
                var URL = 'http://www.ntvbd.com/search/google/?q='+encodeURIComponent(keyword)+'&cx='+encodeURIComponent('partner-pub-2048928514082800:7777012178')+'&cof='+encodeURIComponent('FORID:10')+'&ie=UTF-8&sa=Search';
                window.location.href = URL;
            }
        });

        $('.searchIcon').click(function(){
            ntv_search($('.srch_keyword'));
        });

        $('#ntv_srch_keyword,#ntv_bottom_srch_keyword,#srch_keyword').keypress(function(e) {
            var p = e.which;
            if(p==13){
                ntv_search($(this));
            }
        });

        $('.srch_keyword').keyup(function(){
            var str = $(this).val().toLowerCase();
            $('.srch_keyword').val(str);
        });

        $('.bn_entry_type').click(function(){
            $('.bn_entry_type').removeClass('active');
            if($(this).hasClass('unijoy')){
                $('.bn_entry_type.unijoy').addClass('active');
                makeUnijoyEditor('ntv_srch_keyword');
                makeUnijoyEditor('ntv_bottom_srch_keyword');
            }else if($(this).hasClass('phonetic')){
                $('.bn_entry_type.phonetic').addClass('active');
                makePhoneticEditor('ntv_srch_keyword');
                makePhoneticEditor('ntv_bottom_srch_keyword');
                if($('#srch_keyword').is('visible')) makePhoneticEditor('srch_keyword');
            }else if($(this).hasClass('english')){
                $('.bn_entry_type.english').addClass('active');
            }
        });

        /**
         * TOOLTIPS SETUP
         */
        $(".tooltips").tooltip({placement : 'top'});
        $(".tooltips-bottom").tooltip({placement : 'bottom'});

        
        /**
         * ARCHIVE SUBMIT SECTION
         */
        if($('select[name="calendar_month"]').is(':visible')){
            $('select[name="calendar_month"]').on('change', function(){
                var URL = 'http://www.ntvbd.com/templates/ntv-v1/ajax/archive_calendar.php';
                var data = $('select[name="calendar_year"]').val() + '-' + $(this).val() + '-01';

                // Load cart data update
                $.ajax({
                    url:URL,
                    type:"POST",
                    data:{data:data},
                    beforeSend:function(){
                        //$('.schedules_block').html('Loading...');
                    },
                    success:function(msg){
                        $('#arch_calendar').html(msg);
                    },
                    error:function(jqXHR, textStatus, errorMessage){
                    }
                });
            });
        }
        if($('select[name="calendar_year"]').is(':visible')){
            $('select[name="calendar_year"]').on('change', function(){
                var URL = 'http://www.ntvbd.com/templates/ntv-v1/ajax/archive_calendar.php';
                var data = $(this).val() + '-' + $('select[name="calendar_month"]').val() + '-01';

                // Load cart data update
                $.ajax({
                    url:URL,
                    type:"POST",
                    data:{data:data},
                    beforeSend:function(){
                        //$('.schedules_block').html('Loading...');
                    },
                    success:function(msg){
                        $('#arch_calendar').html(msg);
                    },
                    error:function(jqXHR, textStatus, errorMessage){
                    }
                });
            });
        }
        if($('.archive_submit').is(':visible')){
            $('.archive_submit').click(function(){
                var sel_day = $('select[name="arch_day"]').val();
                var sel_month = $('select[name="arch_month"]').val();
                var sel_year = $('select[name="arch_year"]').val();

                if(sel_day==''){
                    $('select[name="arch_day"]').css('background','#FF9').focus();
                }else if(sel_month==''){
                    $('select[name="arch_month"]').css('background','#FF9').focus();
                }else if(sel_year==''){
                    $('select[name="arch_year"]').css('background','#FF9').focus();
                }else{
                    var sel_date = sel_year + '/' + sel_month + '/' + sel_day;
                    var URL = 'http://www.ntvbd.com/archive/' + sel_date;
                    window.location.href = URL;
                }
            });
        }

        /*Home Page Photo Slider*/
        var currentLeadNews = 1;
        var totalLeadNews = $('.photo_slider_block .img a').length;
        $('.pre_btn').click(function(){

            $('.photo_slider_block .img a:nth-child('+(currentLeadNews+1)+')').hide();
            if(currentLeadNews==totalLeadNews)
            {
                var url = $('.photo_slider_block .album_title a').attr('href');
                window.location = url;
            }
            if(currentLeadNews>1)
            {
                currentLeadNews = currentLeadNews - 1;
                $('.photo_slider_block .img a:nth-child('+(currentLeadNews+1)+')').fadeIn(100);
            }
            else
            {
                currentLeadNews = 2;
                $('.photo_slider_block .img a:nth-child('+(currentLeadNews+1)+')').fadeIn(100);
            }
        });

        $('.nxt_btn').click(function(){

            $('.photo_slider_block .img a:nth-child('+(currentLeadNews+1)+')').hide();
            if(currentLeadNews==totalLeadNews)
            {
                var url = $('.photo_slider_block .album_title a').attr('href');
                window.location = url;
            }
            if(currentLeadNews<totalLeadNews)
            {
                currentLeadNews = currentLeadNews + 1;
                $('.photo_slider_block .img a:nth-child('+(currentLeadNews+1)+')').fadeIn(100);
            }
            else
            {
                currentLeadNews = 1;
                $('.photo_slider_block .img a:nth-child('+(currentLeadNews+1)+')').fadeIn(100);
            }
        });

        /*Home Page Photo Slider*/

        /**
         * Poll section
         * Poll result display with pie-chart
         * parameters (dataClass,displayId,headerText,chartType[pie,doughnut],backgroundColor)
         */
        $('input[name="poll_ans"]').click(function(){
            $('.simple_poll .err_msg').fadeOut().html('');
        });
        $('.simple_poll .poll_submit').click(function(){
            var vote_index = $('input[name="poll_ans"]:checked').val();
            if(vote_index>=0){
                $('#poll_form').submit();
            }else{
                $('.simple_poll .err_msg').fadeIn().html('<i class="fa fa-info"></i>অনুগ্রহ করে আপনার পছন্দ নির্বাচন করুন।');
            }
        });

            });
</script><link rel="stylesheet" href="//cdn.bn.ntvbd.com/css/bootstrap-3.3.0.min.css" media="all">
<!--<link rel="stylesheet" href="/css/font-awesome-4.2.0.min.css" media="all">-->
<link rel="stylesheet" href="http://ntv-bn-cdn.s3.amazonaws.com/css/font-awesome-4.2.0.min.css" media="all">
<link rel="stylesheet" href="//cdn.bn.ntvbd.com/css/stylesheet-site.css" media="all">
<link rel="stylesheet" href="//cdn.bn.ntvbd.com/css/stylesheet-site-header.css" media="all">
<link rel="stylesheet" href="//cdn.bn.ntvbd.com/css/online-poll/simple_poll.css" media="all">
<link rel="stylesheet" href="//cdn.bn.ntvbd.com/css/login.css" media="all">
<link rel="stylesheet" href="//cdn.bn.ntvbd.com/css/dseshare.css" media="all">
			<script>
			$(document).ready(function(){
				$('.comments_box, .signoutButton, #loginButton').click(function(){
					showLogin();
					return false;
				});
			});
		</script>
		<style>
    #top_content .top_ads{
	text-align:center;
	border: 1px solid #ccc;
	margin-bottom: 4px;
	margin-left: 0;
	background-color: #fff;
}
#election{max-width:990px;height:148px;background-image: url("http://ntv-bn-cdn.s3.amazonaws.com/images/bg-election.jpg")}
#election-first ul li{display:inline-block;color:#fff;}
#election-first ul li a{color:#fff;}
#election-second ul li{display:inline-block;color:#fff;}
#election-second ul li a{color:#fff}
</style>
    </head>
    <body>
					<center>
    		
        <div id="mobile_header" class="visible-xs"><style type="text/css">
	.adspace-300x100{
		background:#eee;
		width:100%;
		height:100px;
	}
	#mobile_header{
		padding:10px;
		background:#016938;
		color:#fff
	}
	#mobile_header a{
		color:#fff
	}
	#mobile_header .beta_caption{
		background:#CD0000; color:#fff; padding:0 10px; margin:-10px 0 0 -10px; font-size:11px;
	}
	#mobile_header .cat_collapse_bar{
		font-size:16px; margin-top:3px; margin-left:-10px
	}
	#mobile_header .logo{		
   	 	margin-left:5px;
    	height: 33px;
	}
	.live-tv-btn{
		padding: 5px;
		background: #CD0000;
		color: #fff;
		font-size: 10px;
		width: 33px;
		height: 33px;
		line-height: 11px;
	}
	.eng-ver-btn{
		padding:0 10px; padding-top:7px; height:33px; font-size:12px; border-left:1px solid #030
	}
</style>
<div class="pull-left">
    <div class="beta_caption eng-font">Beta</div>
    <div class="cat_collapse_bar"><i class="fa fa-bars fa-lg"></i></div>
</div>
<div class="pull-left">    
    <div class="logo"><a href="http://www.ntvbd.com"><img src="http://ntv-bn-cdn.s3.amazonaws.com/images/footer-logo.png" height="100%" border="0" /></a></div>
</div>
<div class="pull-right live-tv-btn eng-font"><a href="http://www.ntvbd.com/livetv">Live Tv</a></div>
<div class="pull-right eng-ver-btn eng-font"><a href="http://en.ntvbd.com">English</a></div>
<div class="clr"></div>
</div><!--end mobile_header-->
        
                    <div id="_header" class="hidden-xs"><div class="header">
	    
    <div class="space"></div>
    
    <div class="userPanel themeBlack">
    	<div class="wrapper">
            <div class="row">
                <div class="col-xs-2 col-md-2 col-sm-2" align="left">
                	<!--<div style="color:#FFF; float:left; font-size:14px; margin:0px 0px 0px 5px; display:inline-block; background:#cd0000; padding:3px 10px 3px 10px">Beta</div>-->
                    	<div class="englishVersion"><a href="http://en.ntvbd.com" target="_blank"><span class="themeGreen engFont">English</span></a></div>
                </div>
                
                <div class="col-xs-10 col-md-6 col-sm-6 col-md-offset-4" align="right">
                <div class="right signoutButton engFont"><a id="loginButton">Sign In</a></div>                    <a href="http://ntv-bn-cdn.s3.amazonaws.com/SolaimanLipi.ttf" target="_blank"><img style="margin:0px 5px 0px 0px" class="right" src = "http://ntv-bn-cdn.s3.amazonaws.com/images/bangla_font.png" /></a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="space"></div>
    
    <div class="themeGreen headerPanel">
    	<div class="wrapper">
            <div class="row">
                <div class="col-xs-4 col-md-2 col-sm-2" align="left">
                    <a href="http://www.ntvbd.com"><img class="topLogo" src="http://ntv-bn-cdn.s3.amazonaws.com/images/main-logo.png" title="NTV: Latest Bangla News, Infotainment, Online & Live Tv" alt="NTV: Latest Bangla News, Infotainment, Online & Live Tv"/></a>
                </div>
                
                <div class="col-xs-12 col-md-10 col-sm-10">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="pull-right headerSearch themeLightGreen">
                                <div class="searchIcon icon right"></div>
                                <input name="q" type="text" id="ntv_srch_keyword" class="pull-right bn-font srch_keyword" placeholder="কি খুঁজতে চান?" value="" />
                                <div class="top_srch_entry_type">
					<span class="bn_entry_type active unijoy tooltips-bottom" data-toggle="tooltip" data-placement="top" data-original-title="ইউনিজয়" onClick="switched=false;">অ</span>
					<span class="bn_entry_type phonetic tooltips-bottom" data-toggle="tooltip" data-placement="top" data-original-title="ফনেটিক" onClick="switched=false;">ফ</span>
					<span class="bn_entry_type english eng-font tooltips-bottom" data-toggle="tooltip" data-placement="top" data-original-title="English" onclick="switched=true;">A</span>
                                </div>
                            </div>
                                                    </div>
                    </div><!--end row-->
                    
                    <div class="row">                    
                        <div class="col-md-12 col-sm-12">
                            <div class="dateDesc pull-left">ঢাকা, শুক্রবার, ১৫ এপ্রিল ২০১৬ | ০২ বৈশাখ ১৪২৩ | ০৭ রজব ১৪৩৭ | আপডেট ১ মি. আগে</div>
							                            <div class="home_page_social_img pull-right"><a class="pull-right pinitIcon icon" href="http://www.pinterest.com/ntvdigital/" target="_blank"></a><a class="pull-right inIcon icon" href="https://www.linkedin.com/company/international-television-channel-ltd.-ntv-?trk=biz-companies-cym" target="_blank"></a><a class="pull-right youtubeIcon icon" href="https://www.youtube.com/channel/UCYqujAD5831EywH1jldBu5w?sub_confirmation=1" target="_blank"></a><a class="pull-right googlePlusIcon icon" href="https://google.com/+Ntvbd" target="_blank"></a><a class="pull-right twitterIcon icon" href="https://twitter.com/ntvdigitals" target="_blank"></a><a class="pull-right facebookIcon icon" href="https://www.facebook.com/ntvdigital" target="_blank"></a></div>                        </div>
                    </div><!--end row-->
    
                </div><!--end col-md-10-->
            </div><!--end row-->
		</div><!--end wrapper-->
    </div>
</div>
</div><!--end header-->
                
        <div class="visible-xs">
		<div id="mobile_menu_category"><div style="display:none"><ul class="header_top_menu"><li><a class="active" href="http://www.ntvbd.com" title="Home"><i class="fa fa-home fa-lg"></i></a></li><li><a  href="http://www.ntvbd.com/bangladesh">বাংলাদেশ</a></li><li><a  href="http://www.ntvbd.com/world">বিশ্ব</a></li><li><a  href="http://www.ntvbd.com/economy">অর্থনীতি</a></li><li><a  href="http://www.ntvbd.com/sports">খেলাধুলা</a></li><li><a  href="http://www.ntvbd.com/entertainment">বিনোদন</a></li><li><a  href="http://www.ntvbd.com/tech">বিজ্ঞান ও প্রযুক্তি</a></li><li><a  href="http://www.ntvbd.com/opinion">মত-দ্বিমত</a></li><li><a  href="http://www.ntvbd.com/arts-and-literature">শিল্প ও সাহিত্য</a></li><li><a  href="http://www.ntvbd.com/education">শিক্ষা</a></li></ul><ul class="header_bottom_menu"><li class="mega_parent"><a  href="http://www.ntvbd.com/priyo-probashi">প্রিয় প্রবাসী</a><div class="mega_list_block"><div class="sub_mega_list pull-left"><ul><li class="active" data-val="10" parent-data="10"><a href="http://www.ntvbd.com/priyo-probashi">প্রিয় প্রবাসী</a></li><li data-val="146" parent-data="10"><a href="http://www.ntvbd.com/priyo-probashi/news-from-abroad">প্রবাসের খবর</a></li><li data-val="147" parent-data="10"><a href="http://www.ntvbd.com/priyo-probashi/life-abroad">প্রবাসজীবন</a></li><li data-val="148" parent-data="10"><a href="http://www.ntvbd.com/priyo-probashi/achievement">সাফল্য</a></li><li data-val="149" parent-data="10"><a href="http://www.ntvbd.com/priyo-probashi/challenges">সমস্যা</a></li><li data-val="150" parent-data="10"><a href="http://www.ntvbd.com/priyo-probashi/suggestion">পরামর্শ</a></li><li data-val="151" parent-data="10"><a href="http://www.ntvbd.com/priyo-probashi/others">অন্যান্য</a></li><li data-val="223" parent-data="10"><a href="http://www.ntvbd.com/priyo-probashi/australia">অস্ট্রেলিয়া</a></li></ul></div><div class="sub_mega_sum pull-left" id="sub_mega_sum-10"></div><div class="clr"></div></div></li><li class="mega_parent"><a  href="http://www.ntvbd.com/lifestyle">জীবনধারা</a><div class="mega_list_block"><div class="sub_mega_list pull-left"><ul><li class="active" data-val="11" parent-data="11"><a href="http://www.ntvbd.com/lifestyle">জীবনধারা</a></li><li data-val="20" parent-data="11"><a href="http://www.ntvbd.com/lifestyle/fashion">ফ্যাশন</a></li><li data-val="93" parent-data="11"><a href="http://www.ntvbd.com/lifestyle/beauty-tips">রূপচর্চা</a></li><li data-val="94" parent-data="11"><a href="http://www.ntvbd.com/lifestyle/recipe-and-restaurant">রেসিপি ও রেস্তোরাঁ</a></li><li data-val="95" parent-data="11"><a href="http://www.ntvbd.com/lifestyle/interior">গৃহসজ্জা</a></li><li data-val="96" parent-data="11"><a href="http://www.ntvbd.com/lifestyle/relationship">সম্পর্ক</a></li><li data-val="97" parent-data="11"><a href="http://www.ntvbd.com/lifestyle/manner-and-etiquette">আদবকেতা</a></li><li data-val="98" parent-data="11"><a href="http://www.ntvbd.com/lifestyle/hobby-and-collection">শখ ও সংগ্রহ</a></li><li data-val="99" parent-data="11"><a href="http://www.ntvbd.com/lifestyle/shopping">কেনাকাটা</a></li><li data-val="100" parent-data="11"><a href="http://www.ntvbd.com/lifestyle/horoscope">রাশিফল</a></li><li data-val="101" parent-data="11"><a href="http://www.ntvbd.com/lifestyle/others">অন্যান্য</a></li></ul></div><div class="sub_mega_sum pull-left" id="sub_mega_sum-11"></div><div class="clr"></div></div></li><li class="mega_parent"><a  href="http://www.ntvbd.com/health">স্বাস্থ্য</a><div class="mega_list_block"><div class="sub_mega_list pull-left"><ul><li class="active" data-val="12" parent-data="12"><a href="http://www.ntvbd.com/health">স্বাস্থ্য</a></li><li data-val="102" parent-data="12"><a href="http://www.ntvbd.com/health/diet">ডায়েট</a></li><li data-val="103" parent-data="12"><a href="http://www.ntvbd.com/health/fitness">ফিটনেস</a></li><li data-val="104" parent-data="12"><a href="http://www.ntvbd.com/health/women-health">নারীস্বাস্থ্য</a></li><li data-val="105" parent-data="12"><a href="http://www.ntvbd.com/health/child-health">শিশুস্বাস্থ্য</a></li><li data-val="106" parent-data="12"><a href="http://www.ntvbd.com/health/elders">প্রবীণ</a></li><li data-val="107" parent-data="12"><a href="http://www.ntvbd.com/health/psychology">মন</a></li><li data-val="108" parent-data="12"><a href="http://www.ntvbd.com/health/herbal">ভেষজ</a></li><li data-val="109" parent-data="12"><a href="http://www.ntvbd.com/health/health-tips">স্বাস্থ্যকথা</a></li><li data-val="110" parent-data="12"><a href="http://www.ntvbd.com/health/diseases">রোগব্যাধি</a></li><li data-val="111" parent-data="12"><a href="http://www.ntvbd.com/health/medical-advice">প্রতিকার চাই</a></li><li data-val="197" parent-data="12"><a href="http://www.ntvbd.com/health/others">অন্যান্য</a></li><li data-val="198" parent-data="12"><a href="http://www.ntvbd.com/health/quality-of-food">খাবারের গুণাগুণ</a></li></ul></div><div class="sub_mega_sum pull-left" id="sub_mega_sum-12"></div><div class="clr"></div></div></li><li class="mega_parent"><a  href="http://www.ntvbd.com/travel">ভ্রমণ</a><div class="mega_list_block"><div class="sub_mega_list pull-left"><ul><li class="active" data-val="13" parent-data="13"><a href="http://www.ntvbd.com/travel">ভ্রমণ</a></li><li data-val="130" parent-data="13"><a href="http://www.ntvbd.com/travel/travelogue">ট্রাভেলগ</a></li><li data-val="131" parent-data="13"><a href="http://www.ntvbd.com/travel/where-when">কোথায়, কীভাবে</a></li><li data-val="132" parent-data="13"><a href="http://www.ntvbd.com/travel/tourist-spot">দর্শনীয় স্থান</a></li><li data-val="133" parent-data="13"><a href="http://www.ntvbd.com/travel/tips">টিপস</a></li></ul></div><div class="sub_mega_sum pull-left" id="sub_mega_sum-13"></div><div class="clr"></div></div></li><li class="mega_parent"><a  href="http://www.ntvbd.com/automobile">অটোমোবাইল</a><div class="mega_list_block"><div class="sub_mega_list pull-left"><ul><li class="active" data-val="14" parent-data="14"><a href="http://www.ntvbd.com/automobile">অটোমোবাইল</a></li><li data-val="120" parent-data="14"><a href="http://www.ntvbd.com/automobile/car">গাড়ি</a></li><li data-val="121" parent-data="14"><a href="http://www.ntvbd.com/automobile/motorcycle">মোটরসাইকেল</a></li><li data-val="122" parent-data="14"><a href="http://www.ntvbd.com/automobile/bicycle">সাইকেল</a></li><li data-val="123" parent-data="14"><a href="http://www.ntvbd.com/automobile/machine-tool">যন্ত্রপাতি</a></li><li data-val="124" parent-data="14"><a href="http://www.ntvbd.com/automobile/machine-menace">যন্ত্রের যন্ত্রণা</a></li><li data-val="125" parent-data="14"><a href="http://www.ntvbd.com/automobile/others">অন্যান্য</a></li></ul></div><div class="sub_mega_sum pull-left" id="sub_mega_sum-14"></div><div class="clr"></div></div></li><li class="mega_parent"><a  href="http://www.ntvbd.com/law-and-order">আইন-কানুন</a><div class="mega_list_block"><div class="sub_mega_list pull-left"><ul><li class="active" data-val="15" parent-data="15"><a href="http://www.ntvbd.com/law-and-order">আইন-কানুন</a></li><li data-val="126" parent-data="15"><a href="http://www.ntvbd.com/law-and-order/laws">আইনি কথা</a></li><li data-val="127" parent-data="15"><a href="http://www.ntvbd.com/law-and-order/legal-query">জিজ্ঞাসা</a></li><li data-val="128" parent-data="15"><a href="http://www.ntvbd.com/law-and-order/advice">পরামর্শ</a></li><li data-val="129" parent-data="15"><a href="http://www.ntvbd.com/law-and-order/others">অন্যান্য</a></li></ul></div><div class="sub_mega_sum pull-left" id="sub_mega_sum-15"></div><div class="clr"></div></div></li><li class="mega_parent"><a  href="http://www.ntvbd.com/kids">শিশু-কিশোর</a><div class="mega_list_block"><div class="sub_mega_list pull-left"><ul><li class="active" data-val="17" parent-data="17"><a href="http://www.ntvbd.com/kids">শিশু-কিশোর</a></li><li data-val="152" parent-data="17"><a href="http://www.ntvbd.com/kids/amazing-news">জবর খবর</a></li><li data-val="153" parent-data="17"><a href="http://www.ntvbd.com/kids/wonders">আজব</a></li><li data-val="154" parent-data="17"><a href="http://www.ntvbd.com/kids/mystery">রহস্য</a></li><li data-val="156" parent-data="17"><a href="http://www.ntvbd.com/kids/puzzle">ধাঁধা</a></li><li data-val="157" parent-data="17"><a href="http://www.ntvbd.com/kids/you-know">জানো কি</a></li><li data-val="159" parent-data="17"><a href="http://www.ntvbd.com/kids/your-writing">তোমাদের জন্য</a></li></ul></div><div class="sub_mega_sum pull-left" id="sub_mega_sum-17"></div><div class="clr"></div></div></li><li class="mega_parent"><a  href="http://www.ntvbd.com/religion-and-life">ধর্ম ও জীবন</a><div class="mega_list_block"><div class="sub_mega_list pull-left"><ul><li class="active" data-val="18" parent-data="18"><a href="http://www.ntvbd.com/religion-and-life">ধর্ম ও জীবন</a></li><li data-val="160" parent-data="18"><a href="http://www.ntvbd.com/religion-and-life/islam">ইসলাম</a></li><li data-val="161" parent-data="18"><a href="http://www.ntvbd.com/religion-and-life/sanatan">সনাতন</a></li><li data-val="162" parent-data="18"><a href="http://www.ntvbd.com/religion-and-life/buddhism">বৌদ্ধ</a></li><li data-val="163" parent-data="18"><a href="http://www.ntvbd.com/religion-and-life/christian">খ্রিস্টান</a></li><li data-val="164" parent-data="18"><a href="http://www.ntvbd.com/religion-and-life/others">অন্যান্য</a></li></ul></div><div class="sub_mega_sum pull-left" id="sub_mega_sum-18"></div><div class="clr"></div></div></li><li class="mega_parent"><a  href="http://www.ntvbd.com/job-circular">চাকরি চাই</a><div class="mega_list_block"><div class="sub_mega_list pull-left"><ul><li class="active" data-val="239" parent-data="239"><a href="http://www.ntvbd.com/job-circular">চাকরি চাই</a></li><li data-val="240" parent-data="239"><a href="http://www.ntvbd.com/job-circular/government-jobs">সরকারি</a></li><li data-val="241" parent-data="239"><a href="http://www.ntvbd.com/job-circular/banking-and-insurance">ব্যাংক-বিমা</a></li><li data-val="242" parent-data="239"><a href="http://www.ntvbd.com/job-circular/marketing-and-sales">মার্কেটিং-সেলস্</a></li><li data-val="244" parent-data="239"><a href="http://www.ntvbd.com/job-circular/it-and-telecommunication">আইটি</a></li><li data-val="245" parent-data="239"><a href="http://www.ntvbd.com/job-circular/medical-and-pharmaceutical">মেডিকেল</a></li><li data-val="246" parent-data="239"><a href="http://www.ntvbd.com/job-circular/ngo">এনজিও</a></li><li data-val="248" parent-data="239"><a href="http://www.ntvbd.com/job-circular/garments-textile">গার্মেন্টস-টেক্সটাইল</a></li><li data-val="251" parent-data="239"><a href="http://www.ntvbd.com/job-circular/media">মিডিয়া</a></li><li data-val="252" parent-data="239"><a href="http://www.ntvbd.com/job-circular/education">শিক্ষা</a></li><li data-val="253" parent-data="239"><a href="http://www.ntvbd.com/job-circular/armed-forces">সশস্ত্র বাহিনী</a></li><li data-val="256" parent-data="239"><a href="http://www.ntvbd.com/job-circular/international-organization">আন্তর্জাতিক সংস্থা</a></li><li data-val="257" parent-data="239"><a href="http://www.ntvbd.com/job-circular/others">বিবিধ</a></li></ul></div><div class="sub_mega_sum pull-left" id="sub_mega_sum-239"></div><div class="clr"></div></div></li><li class="mega_parent"><a  href="http://www.ntvbd.com/comedy">হাস্যরস</a><div class="mega_list_block"><div class="sub_mega_list pull-left"><ul><li class="active" data-val="260" parent-data="260"><a href="http://www.ntvbd.com/comedy">হাস্যরস</a></li><li data-val="261" parent-data="260"><a href="http://www.ntvbd.com/comedy/besh-boleche">বেশ বলেছে</a></li><li data-val="262" parent-data="260"><a href="http://www.ntvbd.com/comedy/shobdo-kolpo-droom">শব্দ-কল্প-দ্রুম</a></li><li data-val="263" parent-data="260"><a href="http://www.ntvbd.com/comedy/chobir-khocha">ছবির খোঁচা</a></li><li data-val="264" parent-data="260"><a href="http://www.ntvbd.com/comedy/abol-tabol">আবোলতাবোল</a></li></ul></div><div class="sub_mega_sum pull-left" id="sub_mega_sum-260"></div><div class="clr"></div></div></li></ul></div>
<style type="text/css">
	#mobile_menu_category > div{
		position:relative; display:table; width:100%; background:#666; margin-top:1px
	}
	#mobile_menu_category ul{
		display:table-cell; margin:0; width:50%; text-align:left;
	}
	#mobile_menu_category ul > li{
		list-style:none; border-bottom:1px soid #eee; border-bottom:1px solid #666
	}
	#mobile_menu_category ul > li > a{
		display:block; padding:8px 10px; color:#fff
	}	
	#mobile_menu_category ul.header_top_menu{
		font-size:16px; background:#1e1e1e; border-right:3px solid #016938;
	}
	#mobile_menu_category ul.header_bottom_menu{
		font-size:14px; background:#b4b4b5;
	}
	#mobile_menu_category ul.header_bottom_menu > li > a{
		color:#444
	}
	#mobile_menu_category ul > li > a.active,
	#mobile_menu_category ul.header_bottom_menu > li > a.active{
		background:#016938; color:#fff
	}
</style></div><!--end mobile_menu_category-->
        </div>
        
                
        <div class="container-fluid">        	
            <!--end top_header row-->                        
            
            	            <div class="row hidden-xs">
	                <div id="menu_category" class="topMenu"><ul class="list-inline header_top_menu"><li><a class="active" href="http://www.ntvbd.com" title="Home"><i class="fa fa-home fa-lg"></i></a></li><li><a  href="http://www.ntvbd.com/livetv" >টিভি<sub>&bull;LIVE</sub></a></li><li><a  href="http://video.ntvbd.com" target="_blank">ভিডিও</a></li><li><a  href="http://photo.ntvbd.com" target="_blank">ছবি</a></li><li class="mega_parent"><a  href="http://www.ntvbd.com/bangladesh">বাংলাদেশ</a><div class="mega_list_block"><div class="sub_mega_list pull-left"><ul><li class="active" data-val="1" parent-data="1"><a href="http://www.ntvbd.com/bangladesh">বাংলাদেশ</a></li><li data-val="21" parent-data="1"><a href="http://www.ntvbd.com/bangladesh/politics">রাজনীতি</a></li><li data-val="22" parent-data="1"><a href="http://www.ntvbd.com/bangladesh/government">সরকার</a></li><li data-val="23" parent-data="1"><a href="http://www.ntvbd.com/bangladesh/crime">অপরাধ</a></li><li data-val="24" parent-data="1"><a href="http://www.ntvbd.com/bangladesh/law-and-rules">আইন ও বিচার</a></li><li data-val="25" parent-data="1"><a href="http://www.ntvbd.com/bangladesh/accident">দুর্ঘটনা</a></li><li data-val="26" parent-data="1"><a href="http://www.ntvbd.com/bangladesh/good-news">সুখবর</a></li><li data-val="27" parent-data="1"><a href="http://www.ntvbd.com/bangladesh/others">অন্যান্য</a></li><li data-val="28" parent-data="1"><a href="http://www.ntvbd.com/bangladesh/obituary">শোক</a></li><li data-val="29" parent-data="1"><a href="http://www.ntvbd.com/bangladesh/death-anniversary">মৃত্যুবার্ষিকী</a></li><li data-val="30" parent-data="1"><a href="http://www.ntvbd.com/bangladesh/qulkhwani">কুলখানি</a></li><li data-val="31" parent-data="1"><a href="http://www.ntvbd.com/bangladesh/chehlum">চেহলাম</a></li><li data-val="32" parent-data="1"><a href="http://www.ntvbd.com/bangladesh/funeral">শ্রাদ্ধ</a></li><li data-val="33" parent-data="1"><a href="http://www.ntvbd.com/bangladesh/help">হাত বাড়িয়ে দাও</a></li><li data-val="34" parent-data="1"><a href="http://www.ntvbd.com/bangladesh/lost">নিখোঁজ</a></li></ul></div><div class="sub_mega_sum pull-left" id="sub_mega_sum-1"></div><div class="clr"></div></div></li><li class="mega_parent"><a  href="http://www.ntvbd.com/world">বিশ্ব</a><div class="mega_list_block"><div class="sub_mega_list pull-left"><ul><li class="active" data-val="2" parent-data="2"><a href="http://www.ntvbd.com/world">বিশ্ব</a></li><li data-val="35" parent-data="2"><a href="http://www.ntvbd.com/world/united-states">যুক্তরাষ্ট্র</a></li><li data-val="36" parent-data="2"><a href="http://www.ntvbd.com/world/united-kingdom">যুক্তরাজ্য</a></li><li data-val="37" parent-data="2"><a href="http://www.ntvbd.com/world/canada">কানাডা</a></li><li data-val="38" parent-data="2"><a href="http://www.ntvbd.com/world/india">ভারত</a></li><li data-val="39" parent-data="2"><a href="http://www.ntvbd.com/world/pakistan">পাকিস্তান</a></li><li data-val="40" parent-data="2"><a href="http://www.ntvbd.com/world/arab-world">আরব দুনিয়া</a></li><li data-val="41" parent-data="2"><a href="http://www.ntvbd.com/world/asia">এশিয়া</a></li><li data-val="42" parent-data="2"><a href="http://www.ntvbd.com/world/europe">ইউরোপ</a></li><li data-val="43" parent-data="2"><a href="http://www.ntvbd.com/world/latin-america">লাতিন আমেরিকা</a></li><li data-val="44" parent-data="2"><a href="http://www.ntvbd.com/world/africa">আফ্রিকা</a></li><li data-val="45" parent-data="2"><a href="http://australia.ntvbd.com/">অস্ট্রেলিয়া</a></li><li data-val="46" parent-data="2"><a href="http://www.ntvbd.com/world/others">অন্যান্য</a></li></ul></div><div class="sub_mega_sum pull-left" id="sub_mega_sum-2"></div><div class="clr"></div></div></li><li class="mega_parent"><a  href="http://www.ntvbd.com/economy">অর্থনীতি</a><div class="mega_list_block"><div class="sub_mega_list pull-left"><ul><li class="active" data-val="3" parent-data="3"><a href="http://www.ntvbd.com/economy">অর্থনীতি</a></li><li data-val="47" parent-data="3"><a href="http://www.ntvbd.com/economy/share-market">শেয়ারবাজার</a></li><li data-val="48" parent-data="3"><a href="http://www.ntvbd.com/economy/garment-industry">পোশাকশিল্প</a></li><li data-val="49" parent-data="3"><a href="http://www.ntvbd.com/economy/bank-insurance">ব্যাংক ও বিমা</a></li><li data-val="50" parent-data="3"><a href="http://www.ntvbd.com/economy/tourism">পর্যটন ও সেবা</a></li><li data-val="51" parent-data="3"><a href="http://www.ntvbd.com/economy/analysis">বিশ্লেষণ</a></li><li data-val="53" parent-data="3"><a href="http://www.ntvbd.com/economy/export-import">আমদানি-রপ্তানি</a></li><li data-val="54" parent-data="3"><a href="http://www.ntvbd.com/economy/revenue">রাজস্ব</a></li><li data-val="55" parent-data="3"><a href="http://www.ntvbd.com/economy/corporate-news">করপোরেট নিউজ</a></li><li data-val="56" parent-data="3"><a href="http://www.ntvbd.com/economy/entrepreneurship">উদ্যোক্তার কথা</a></li><li data-val="57" parent-data="3"><a href="http://www.ntvbd.com/economy/commodity-market">পণ্যবাজার</a></li><li data-val="58" parent-data="3"><a href="http://www.ntvbd.com/economy/others">অন্যান্য</a></li></ul></div><div class="sub_mega_sum pull-left" id="sub_mega_sum-3"></div><div class="clr"></div></div></li><li class="mega_parent"><a  href="http://www.ntvbd.com/sports">খেলাধুলা</a><div class="mega_list_block"><div class="sub_mega_list pull-left"><ul><li class="active" data-val="4" parent-data="4"><a href="http://www.ntvbd.com/sports">খেলাধুলা</a></li><li data-val="59" parent-data="4"><a href="http://www.ntvbd.com/sports/cricket">ক্রিকেট</a></li><li data-val="60" parent-data="4"><a href="http://www.ntvbd.com/sports/football">ফুটবল</a></li><li data-val="61" parent-data="4"><a href="http://www.ntvbd.com/sports/tennis">টেনিস</a></li><li data-val="62" parent-data="4"><a href="http://www.ntvbd.com/sports/athletics">অ্যাথলেটিকস</a></li><li data-val="63" parent-data="4"><a href="http://www.ntvbd.com/sports/hockey">হকি</a></li><li data-val="67" parent-data="4"><a href="http://www.ntvbd.com/sports/others">অন্যান্য</a></li></ul></div><div class="sub_mega_sum pull-left" id="sub_mega_sum-4"></div><div class="clr"></div></div></li><li class="mega_parent"><a  href="http://www.ntvbd.com/entertainment">বিনোদন</a><div class="mega_list_block"><div class="sub_mega_list pull-left"><ul><li class="active" data-val="5" parent-data="5"><a href="http://www.ntvbd.com/entertainment">বিনোদন</a></li><li data-val="68" parent-data="5"><a href="http://www.ntvbd.com/entertainment/dhallywood">ঢালিউড</a></li><li data-val="69" parent-data="5"><a href="http://www.ntvbd.com/entertainment/bollywood-and-others-">বলিউড ও অন্যান্য</a></li><li data-val="70" parent-data="5"><a href="http://www.ntvbd.com/entertainment/hollywood-and-others">হলিউড ও অন্যান্য</a></li><li data-val="71" parent-data="5"><a href="http://www.ntvbd.com/entertainment/face-to-face">মুখোমুখি</a></li><li data-val="72" parent-data="5"><a href="http://www.ntvbd.com/entertainment/tv">টিভি</a></li><li data-val="73" parent-data="5"><a href="http://www.ntvbd.com/entertainment/shooting-spot">শুটিং স্পট</a></li><li data-val="74" parent-data="5"><a href="http://www.ntvbd.com/entertainment/music">সংগীত</a></li><li data-val="75" parent-data="5"><a href="http://www.ntvbd.com/entertainment/dance">নৃত্য</a></li><li data-val="76" parent-data="5"><a href="http://www.ntvbd.com/entertainment/theatre">মঞ্চ</a></li><li data-val="77" parent-data="5"><a href="http://www.ntvbd.com/entertainment/film-review">ফিল্ম রিভিউ</a></li><li data-val="78" parent-data="5"><a href="http://www.ntvbd.com/entertainment/recognition">স্বীকৃতি</a></li><li data-val="80" parent-data="5"><a href="http://www.ntvbd.com/entertainment/others">অন্যান্য</a></li></ul></div><div class="sub_mega_sum pull-left" id="sub_mega_sum-5"></div><div class="clr"></div></div></li><li class="mega_parent"><a  href="http://www.ntvbd.com/tech">বিজ্ঞান ও প্রযুক্তি</a><div class="mega_list_block"><div class="sub_mega_list pull-left"><ul><li class="active" data-val="6" parent-data="6"><a href="http://www.ntvbd.com/tech">বিজ্ঞান ও প্রযুক্তি</a></li><li data-val="82" parent-data="6"><a href="http://www.ntvbd.com/tech/technology-news">প্রযুক্তির খবর</a></li><li data-val="83" parent-data="6"><a href="http://www.ntvbd.com/tech/mobile-and-tablet">মোবাইল ও ট্যাব</a></li><li data-val="84" parent-data="6"><a href="http://www.ntvbd.com/tech/computer">কম্পিউটার</a></li><li data-val="85" parent-data="6"><a href="http://www.ntvbd.com/tech/website">ওয়েবসাইট</a></li><li data-val="86" parent-data="6"><a href="http://www.ntvbd.com/tech/social-media">সামাজিক মাধ্যম</a></li><li data-val="87" parent-data="6"><a href="http://www.ntvbd.com/tech/gaming-and-gadgets">গেমিং ও গেজেট</a></li><li data-val="88" parent-data="6"><a href="http://www.ntvbd.com/tech/apps">অ্যাপস</a></li><li data-val="89" parent-data="6"><a href="http://www.ntvbd.com/tech/camera">ক্যামেরা</a></li><li data-val="90" parent-data="6"><a href="http://www.ntvbd.com/tech/invention">উদ্ভাবন</a></li><li data-val="91" parent-data="6"><a href="http://www.ntvbd.com/tech/research">গবেষণা</a></li><li data-val="92" parent-data="6"><a href="http://www.ntvbd.com/tech/others">অন্যান্য</a></li><li data-val="224" parent-data="6"><a href="http://www.ntvbd.com/tech/tutorial">টিউটোরিয়াল</a></li></ul></div><div class="sub_mega_sum pull-left" id="sub_mega_sum-6"></div><div class="clr"></div></div></li><li class="mega_parent"><a  href="http://www.ntvbd.com/opinion">মত-দ্বিমত</a><div class="mega_list_block"><div class="sub_mega_list pull-left"><ul><li class="active" data-val="7" parent-data="7"><a href="http://www.ntvbd.com/opinion">মত-দ্বিমত</a></li><li data-val="226" parent-data="7"><a href="http://www.ntvbd.com/opinion/reaction">প্রতিক্রিয়া</a></li><li data-val="227" parent-data="7"><a href="http://www.ntvbd.com/opinion/current-affairs">সমসাময়িক</a></li><li data-val="228" parent-data="7"><a href="http://www.ntvbd.com/opinion/international">বহির্বিশ্ব</a></li><li data-val="229" parent-data="7"><a href="http://www.ntvbd.com/opinion/satire">ব্যঙ্গ রঙ্গে</a></li><li data-val="230" parent-data="7"><a href="http://www.ntvbd.com/opinion/look-back">ফিরে দেখা</a></li><li data-val="231" parent-data="7"><a href="http://www.ntvbd.com/opinion/in-memory">স্মরণ</a></li><li data-val="232" parent-data="7"><a href="http://www.ntvbd.com/opinion/foreign-column">বিদেশি কলাম</a></li><li data-val="233" parent-data="7"><a href="http://www.ntvbd.com/opinion/city-mirror">নগর দর্পণ</a></li><li data-val="234" parent-data="7"><a href="http://www.ntvbd.com/opinion/guest-column">অতিথি কলাম</a></li><li data-val="235" parent-data="7"><a href="http://www.ntvbd.com/opinion/sports">খেলাধূলা</a></li><li data-val="236" parent-data="7"><a href="http://www.ntvbd.com/opinion/readers-column">পাঠকের কলাম</a></li><li data-val="237" parent-data="7"><a href="http://www.ntvbd.com/opinion/other-columns">বিবিধ</a></li></ul></div><div class="sub_mega_sum pull-left" id="sub_mega_sum-7"></div><div class="clr"></div></div></li><li class="mega_parent"><a  href="http://www.ntvbd.com/arts-and-literature">শিল্প ও সাহিত্য</a><div class="mega_list_block"><div class="sub_mega_list pull-left"><ul><li class="active" data-val="8" parent-data="8"><a href="http://www.ntvbd.com/arts-and-literature">শিল্প ও সাহিত্য</a></li><li data-val="134" parent-data="8"><a href="http://www.ntvbd.com/arts-and-literature/prose">গদ্য</a></li><li data-val="135" parent-data="8"><a href="http://www.ntvbd.com/arts-and-literature/poetry">কবিতা</a></li><li data-val="137" parent-data="8"><a href="http://www.ntvbd.com/arts-and-literature/interview">সাক্ষাৎকার</a></li><li data-val="138" parent-data="8"><a href="http://www.ntvbd.com/arts-and-literature/book-review">গ্রন্থ আলোচনা</a></li><li data-val="139" parent-data="8"><a href="http://www.ntvbd.com/arts-and-literature/book-fair">বইমেলা</a></li><li data-val="140" parent-data="8"><a href="http://www.ntvbd.com/arts-and-literature/fine-arts">চিত্রকলা</a></li><li data-val="141" parent-data="8"><a href="http://www.ntvbd.com/arts-and-literature/news">শিল্পসাহিত্যের খবর</a></li><li data-val="142" parent-data="8"><a href="http://www.ntvbd.com/arts-and-literature/awards-and-events">পুরস্কার ও অনুষ্ঠান</a></li><li data-val="144" parent-data="8"><a href="http://www.ntvbd.com/arts-and-literature/movie">চলচ্চিত্র</a></li><li data-val="145" parent-data="8"><a href="http://www.ntvbd.com/arts-and-literature/photography">আলোকচিত্র</a></li></ul></div><div class="sub_mega_sum pull-left" id="sub_mega_sum-8"></div><div class="clr"></div></div></li><li class="mega_parent"><a  href="http://www.ntvbd.com/education">শিক্ষা</a><div class="mega_list_block"><div class="sub_mega_list pull-left"><ul><li class="active" data-val="9" parent-data="9"><a href="http://www.ntvbd.com/education">শিক্ষা</a></li><li data-val="112" parent-data="9"><a href="http://www.ntvbd.com/education/admission-and-examination">ভর্তি ও পরীক্ষা</a></li><li data-val="113" parent-data="9"><a href="http://www.ntvbd.com/education/scholarship">বৃত্তি</a></li><li data-val="114" parent-data="9"><a href="http://www.ntvbd.com/education/achievement">সাফল্য</a></li><li data-val="115" parent-data="9"><a href="http://www.ntvbd.com/education/studying-abroad">বিদেশে পড়াশোনা</a></li><li data-val="116" parent-data="9"><a href="http://www.ntvbd.com/education/campus">ক্যাম্পাস</a></li><li data-val="117" parent-data="9"><a href="http://www.ntvbd.com/education/career">ক্যারিয়ার</a></li><li data-val="118" parent-data="9"><a href="http://www.ntvbd.com/education/institution-profile">প্রতিষ্ঠান পরিচিতি</a></li><li data-val="119" parent-data="9"><a href="http://www.ntvbd.com/education/others">অন্যান্য</a></li><li data-val="211" parent-data="9"><a href="http://www.ntvbd.com/education/hsc-result">ফলাফল</a></li></ul></div><div class="sub_mega_sum pull-left" id="sub_mega_sum-9"></div><div class="clr"></div></div></li></ul><style>
		.header_bottom_menu li:nth-child(10){
			background:#7ad000;
		}
		</style><ul class="list-inline header_bottom_menu"><li class="mega_parent"><a  href="http://www.ntvbd.com/priyo-probashi">প্রিয় প্রবাসী</a><div class="mega_list_block"><div class="sub_mega_list pull-left"><ul><li class="active" data-val="10" parent-data="10"><a href="http://www.ntvbd.com/priyo-probashi">প্রিয় প্রবাসী</a></li><li data-val="146" parent-data="10"><a href="http://www.ntvbd.com/priyo-probashi/news-from-abroad">প্রবাসের খবর</a></li><li data-val="147" parent-data="10"><a href="http://www.ntvbd.com/priyo-probashi/life-abroad">প্রবাসজীবন</a></li><li data-val="148" parent-data="10"><a href="http://www.ntvbd.com/priyo-probashi/achievement">সাফল্য</a></li><li data-val="149" parent-data="10"><a href="http://www.ntvbd.com/priyo-probashi/challenges">সমস্যা</a></li><li data-val="150" parent-data="10"><a href="http://www.ntvbd.com/priyo-probashi/suggestion">পরামর্শ</a></li><li data-val="151" parent-data="10"><a href="http://www.ntvbd.com/priyo-probashi/others">অন্যান্য</a></li><li data-val="223" parent-data="10"><a href="http://www.ntvbd.com/priyo-probashi/australia">অস্ট্রেলিয়া</a></li></ul></div><div class="sub_mega_sum pull-left" id="sub_mega_sum-10"></div><div class="clr"></div></div></li><li class="mega_parent"><a  href="http://www.ntvbd.com/lifestyle">জীবনধারা</a><div class="mega_list_block"><div class="sub_mega_list pull-left"><ul><li class="active" data-val="11" parent-data="11"><a href="http://www.ntvbd.com/lifestyle">জীবনধারা</a></li><li data-val="20" parent-data="11"><a href="http://www.ntvbd.com/lifestyle/fashion">ফ্যাশন</a></li><li data-val="93" parent-data="11"><a href="http://www.ntvbd.com/lifestyle/beauty-tips">রূপচর্চা</a></li><li data-val="94" parent-data="11"><a href="http://www.ntvbd.com/lifestyle/recipe-and-restaurant">রেসিপি ও রেস্তোরাঁ</a></li><li data-val="95" parent-data="11"><a href="http://www.ntvbd.com/lifestyle/interior">গৃহসজ্জা</a></li><li data-val="96" parent-data="11"><a href="http://www.ntvbd.com/lifestyle/relationship">সম্পর্ক</a></li><li data-val="97" parent-data="11"><a href="http://www.ntvbd.com/lifestyle/manner-and-etiquette">আদবকেতা</a></li><li data-val="98" parent-data="11"><a href="http://www.ntvbd.com/lifestyle/hobby-and-collection">শখ ও সংগ্রহ</a></li><li data-val="99" parent-data="11"><a href="http://www.ntvbd.com/lifestyle/shopping">কেনাকাটা</a></li><li data-val="100" parent-data="11"><a href="http://www.ntvbd.com/lifestyle/horoscope">রাশিফল</a></li><li data-val="101" parent-data="11"><a href="http://www.ntvbd.com/lifestyle/others">অন্যান্য</a></li></ul></div><div class="sub_mega_sum pull-left" id="sub_mega_sum-11"></div><div class="clr"></div></div></li><li class="mega_parent"><a  href="http://www.ntvbd.com/health">স্বাস্থ্য</a><div class="mega_list_block"><div class="sub_mega_list pull-left"><ul><li class="active" data-val="12" parent-data="12"><a href="http://www.ntvbd.com/health">স্বাস্থ্য</a></li><li data-val="102" parent-data="12"><a href="http://www.ntvbd.com/health/diet">ডায়েট</a></li><li data-val="103" parent-data="12"><a href="http://www.ntvbd.com/health/fitness">ফিটনেস</a></li><li data-val="104" parent-data="12"><a href="http://www.ntvbd.com/health/women-health">নারীস্বাস্থ্য</a></li><li data-val="105" parent-data="12"><a href="http://www.ntvbd.com/health/child-health">শিশুস্বাস্থ্য</a></li><li data-val="106" parent-data="12"><a href="http://www.ntvbd.com/health/elders">প্রবীণ</a></li><li data-val="107" parent-data="12"><a href="http://www.ntvbd.com/health/psychology">মন</a></li><li data-val="108" parent-data="12"><a href="http://www.ntvbd.com/health/herbal">ভেষজ</a></li><li data-val="109" parent-data="12"><a href="http://www.ntvbd.com/health/health-tips">স্বাস্থ্যকথা</a></li><li data-val="110" parent-data="12"><a href="http://www.ntvbd.com/health/diseases">রোগব্যাধি</a></li><li data-val="111" parent-data="12"><a href="http://www.ntvbd.com/health/medical-advice">প্রতিকার চাই</a></li><li data-val="197" parent-data="12"><a href="http://www.ntvbd.com/health/others">অন্যান্য</a></li><li data-val="198" parent-data="12"><a href="http://www.ntvbd.com/health/quality-of-food">খাবারের গুণাগুণ</a></li></ul></div><div class="sub_mega_sum pull-left" id="sub_mega_sum-12"></div><div class="clr"></div></div></li><li class="mega_parent"><a  href="http://www.ntvbd.com/travel">ভ্রমণ</a><div class="mega_list_block"><div class="sub_mega_list pull-left"><ul><li class="active" data-val="13" parent-data="13"><a href="http://www.ntvbd.com/travel">ভ্রমণ</a></li><li data-val="130" parent-data="13"><a href="http://www.ntvbd.com/travel/travelogue">ট্রাভেলগ</a></li><li data-val="131" parent-data="13"><a href="http://www.ntvbd.com/travel/where-when">কোথায়, কীভাবে</a></li><li data-val="132" parent-data="13"><a href="http://www.ntvbd.com/travel/tourist-spot">দর্শনীয় স্থান</a></li><li data-val="133" parent-data="13"><a href="http://www.ntvbd.com/travel/tips">টিপস</a></li></ul></div><div class="sub_mega_sum pull-left" id="sub_mega_sum-13"></div><div class="clr"></div></div></li><li class="mega_parent"><a  href="http://www.ntvbd.com/automobile">অটোমোবাইল</a><div class="mega_list_block"><div class="sub_mega_list pull-left"><ul><li class="active" data-val="14" parent-data="14"><a href="http://www.ntvbd.com/automobile">অটোমোবাইল</a></li><li data-val="120" parent-data="14"><a href="http://www.ntvbd.com/automobile/car">গাড়ি</a></li><li data-val="121" parent-data="14"><a href="http://www.ntvbd.com/automobile/motorcycle">মোটরসাইকেল</a></li><li data-val="122" parent-data="14"><a href="http://www.ntvbd.com/automobile/bicycle">সাইকেল</a></li><li data-val="123" parent-data="14"><a href="http://www.ntvbd.com/automobile/machine-tool">যন্ত্রপাতি</a></li><li data-val="124" parent-data="14"><a href="http://www.ntvbd.com/automobile/machine-menace">যন্ত্রের যন্ত্রণা</a></li><li data-val="125" parent-data="14"><a href="http://www.ntvbd.com/automobile/others">অন্যান্য</a></li></ul></div><div class="sub_mega_sum pull-left" id="sub_mega_sum-14"></div><div class="clr"></div></div></li><li class="mega_parent"><a  href="http://www.ntvbd.com/law-and-order">আইন-কানুন</a><div class="mega_list_block"><div class="sub_mega_list pull-left"><ul><li class="active" data-val="15" parent-data="15"><a href="http://www.ntvbd.com/law-and-order">আইন-কানুন</a></li><li data-val="126" parent-data="15"><a href="http://www.ntvbd.com/law-and-order/laws">আইনি কথা</a></li><li data-val="127" parent-data="15"><a href="http://www.ntvbd.com/law-and-order/legal-query">জিজ্ঞাসা</a></li><li data-val="128" parent-data="15"><a href="http://www.ntvbd.com/law-and-order/advice">পরামর্শ</a></li><li data-val="129" parent-data="15"><a href="http://www.ntvbd.com/law-and-order/others">অন্যান্য</a></li></ul></div><div class="sub_mega_sum pull-left" id="sub_mega_sum-15"></div><div class="clr"></div></div></li><li class="mega_parent"><a  href="http://www.ntvbd.com/kids">শিশু-কিশোর</a><div class="mega_list_block"><div class="sub_mega_list pull-left"><ul><li class="active" data-val="17" parent-data="17"><a href="http://www.ntvbd.com/kids">শিশু-কিশোর</a></li><li data-val="152" parent-data="17"><a href="http://www.ntvbd.com/kids/amazing-news">জবর খবর</a></li><li data-val="153" parent-data="17"><a href="http://www.ntvbd.com/kids/wonders">আজব</a></li><li data-val="154" parent-data="17"><a href="http://www.ntvbd.com/kids/mystery">রহস্য</a></li><li data-val="156" parent-data="17"><a href="http://www.ntvbd.com/kids/puzzle">ধাঁধা</a></li><li data-val="157" parent-data="17"><a href="http://www.ntvbd.com/kids/you-know">জানো কি</a></li><li data-val="159" parent-data="17"><a href="http://www.ntvbd.com/kids/your-writing">তোমাদের জন্য</a></li></ul></div><div class="sub_mega_sum pull-left" id="sub_mega_sum-17"></div><div class="clr"></div></div></li><li class="mega_parent"><a  href="http://www.ntvbd.com/religion-and-life">ধর্ম ও জীবন</a><div class="mega_list_block"><div class="sub_mega_list pull-left"><ul><li class="active" data-val="18" parent-data="18"><a href="http://www.ntvbd.com/religion-and-life">ধর্ম ও জীবন</a></li><li data-val="160" parent-data="18"><a href="http://www.ntvbd.com/religion-and-life/islam">ইসলাম</a></li><li data-val="161" parent-data="18"><a href="http://www.ntvbd.com/religion-and-life/sanatan">সনাতন</a></li><li data-val="162" parent-data="18"><a href="http://www.ntvbd.com/religion-and-life/buddhism">বৌদ্ধ</a></li><li data-val="163" parent-data="18"><a href="http://www.ntvbd.com/religion-and-life/christian">খ্রিস্টান</a></li><li data-val="164" parent-data="18"><a href="http://www.ntvbd.com/religion-and-life/others">অন্যান্য</a></li></ul></div><div class="sub_mega_sum pull-left" id="sub_mega_sum-18"></div><div class="clr"></div></div></li><li class="mega_parent"><a  href="http://www.ntvbd.com/job-circular">চাকরি চাই</a><div class="mega_list_block"><div class="sub_mega_list pull-left"><ul><li class="active" data-val="239" parent-data="239"><a href="http://www.ntvbd.com/job-circular">চাকরি চাই</a></li><li data-val="240" parent-data="239"><a href="http://www.ntvbd.com/job-circular/government-jobs">সরকারি</a></li><li data-val="241" parent-data="239"><a href="http://www.ntvbd.com/job-circular/banking-and-insurance">ব্যাংক-বিমা</a></li><li data-val="242" parent-data="239"><a href="http://www.ntvbd.com/job-circular/marketing-and-sales">মার্কেটিং-সেলস্</a></li><li data-val="244" parent-data="239"><a href="http://www.ntvbd.com/job-circular/it-and-telecommunication">আইটি</a></li><li data-val="245" parent-data="239"><a href="http://www.ntvbd.com/job-circular/medical-and-pharmaceutical">মেডিকেল</a></li><li data-val="246" parent-data="239"><a href="http://www.ntvbd.com/job-circular/ngo">এনজিও</a></li><li data-val="248" parent-data="239"><a href="http://www.ntvbd.com/job-circular/garments-textile">গার্মেন্টস-টেক্সটাইল</a></li><li data-val="251" parent-data="239"><a href="http://www.ntvbd.com/job-circular/media">মিডিয়া</a></li><li data-val="252" parent-data="239"><a href="http://www.ntvbd.com/job-circular/education">শিক্ষা</a></li><li data-val="253" parent-data="239"><a href="http://www.ntvbd.com/job-circular/armed-forces">সশস্ত্র বাহিনী</a></li><li data-val="256" parent-data="239"><a href="http://www.ntvbd.com/job-circular/international-organization">আন্তর্জাতিক সংস্থা</a></li><li data-val="257" parent-data="239"><a href="http://www.ntvbd.com/job-circular/others">বিবিধ</a></li></ul></div><div class="sub_mega_sum pull-left" id="sub_mega_sum-239"></div><div class="clr"></div></div></li><li class="mega_parent"><a  href="http://www.ntvbd.com/comedy">হাস্যরস</a><div class="mega_list_block"><div class="sub_mega_list pull-left"><ul><li class="active" data-val="260" parent-data="260"><a href="http://www.ntvbd.com/comedy">হাস্যরস</a></li><li data-val="261" parent-data="260"><a href="http://www.ntvbd.com/comedy/besh-boleche">বেশ বলেছে</a></li><li data-val="262" parent-data="260"><a href="http://www.ntvbd.com/comedy/shobdo-kolpo-droom">শব্দ-কল্প-দ্রুম</a></li><li data-val="263" parent-data="260"><a href="http://www.ntvbd.com/comedy/chobir-khocha">ছবির খোঁচা</a></li><li data-val="264" parent-data="260"><a href="http://www.ntvbd.com/comedy/abol-tabol">আবোলতাবোল</a></li></ul></div><div class="sub_mega_sum pull-left" id="sub_mega_sum-260"></div><div class="clr"></div></div></li><li><a  href="http://www.ntvbd.com/economy/share-market" >শেয়ারবাজার</a></li><li><a  href="http://www.ntvbd.com/citizen-journalism" >আমিই সাংবাদিক</a></li><li><a  href="http://malaysia.ntvbd.com" >মালয়েশিয়া</a></li></ul></div><!--end menu_category-->
	            </div><!--end menu_category row-->
	    
	            <div class="row hidden-xs">
	                <div id="top_content"><div class="top_ads adsSpace970x90" align="center" style="background-color:#EBEBEB;border-style:none"><!-- Ntv_home_728x90_468x60_320x100_T1 -->
<div id='div-gpt-ad-1422078900996-4'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1422078900996-4'); });
</script>
</div>
</div><!--end top_ads-->

<div class="clr"></div>
</div><!--end top_content-->
	            </div><!--end top_content row-->
                            
                <div class="row">
                    <div id="just_now_content"><style type="text/css">
.just_now_caption h4 a{
	color:#fff !important;
}
.just_now_caption h4 a:hover{
	color:red !important;
}
.more_caption a:hover{
	color:black !important;
}
</style></div><!--end just_now_content-->
                </div><!--end just_now_content row-->
                
                                
                	                <div class="row hidden-xs">
	                    <div><div id="headline_section">
<div class="row">
	<div class="col-xs-3 col-md-1 col-sm-1">
    	<div class="headline_caption">শিরোনাম</div>
    </div><!--end col-md-2-->
    
    <div class="col-xs-6 col-md-9 col-sm-9">
    	<div class="hl_list"><marquee behavior="scroll" scrollamount="3" scrolldelay="30" direction="left" onMouseOver="stop();" onMouseOut="start();">
        	<ul class="list-inline"><li><a href="http://www.ntvbd.com/bangladesh/46122/ছিনতাইকারীর-ছুরিকাঘাতে-রাজধানীতে-যুবক-খুন"><i class="fa fa-angle-right fa_headline"></i>&nbsp;ছিনতাইকারীর ছুরিকাঘাতে রাজধানীতে যুবক খুন</a></li><li><a href="http://www.ntvbd.com/bangladesh/46110/চুয়েটের-ভারপ্রাপ্ত-উপাচার্য-ড.-রফিকুল"><i class="fa fa-angle-right fa_headline"></i>&nbsp;চুয়েটের ভারপ্রাপ্ত উপাচার্য ড. রফিকুল</a></li><li><a href="http://www.ntvbd.com/world/46104/জাপানে-শক্তিশালী-ভূমিকম্পে-নিহত-নয়-আহত-আড়াইশর-বেশি"><i class="fa fa-angle-right fa_headline"></i>&nbsp;জাপানে শক্তিশালী ভূমিকম্পে নিহত নয়, আহত আড়াইশর বেশি</a></li><li><a href="http://www.ntvbd.com/sports/46100/সহজ-গ্রুপে-ব্রাজিল-আর্জেন্টিনার-প্রতিপক্ষ-পর্তুগাল"><i class="fa fa-angle-right fa_headline"></i>&nbsp;সহজ গ্রুপে ব্রাজিল, আর্জেন্টিনার প্রতিপক্ষ পর্তুগাল</a></li><li><a href="http://www.ntvbd.com/bangladesh/46094/চায়ের-কাপে-কীটনাশক-২৬-জন-হাসপাতালে"><i class="fa fa-angle-right fa_headline"></i>&nbsp;চায়ের কাপে কীটনাশক, ২৬ জন হাসপাতালে</a></li></ul><!--end ul-->
		</marquee></div><!--end hl_list-->
    </div><!--end col-md-10-->
	
	<div style="col-xs-3 col-md-2 col-sm-2">
    	<div class="headline_caption"><a href="http://www.ntvbd.com/breaking-news">এইমাত্র পাওয়া</a></div>
    </div><!--end col-md-2-->
</div><!--end row-->
</div>
</div><!--end headline_section-->
	                </div><!--end headline_section row-->
	    			
			            <div class="row">
							</div>
            <div class="row">
                <div id="main_content">
<!----------------------------------------------------------------------
| HOME PAGE CONTENT SETUP
----------------------------------------------------------------------->
<div class="left_content">
    <!--call lead_one_content-->
    <div id="lead_one_content"><!----------------------------------------------------------------------
| TOP LEAD CONTENTS SETUP
----------------------------------------------------------------------->
<div class="row">
	<div class="col-md-6 col-sm-6">
		<div class="home_top_lead_content">        	
            <a href="http://www.ntvbd.com/bangladesh/46140/নতুন-করে-শিলাবৃষ্টিতে-হাওরের-ফসলের-ক্ষতি">
            
                <div class="img lazy"><img src="//cdn.bn.ntvbd.com/site/photo-1460718201?width=305&height=275" alt="নতুন করে শিলাবৃষ্টিতে হাওরের ফসলের ক্ষতি"  title="নতুন করে শিলাবৃষ্টিতে হাওরের ফসলের ক্ষতি"/></div>
                
               	                
                <div class="hl"><h2>নতুন করে শিলাবৃষ্টিতে হাওরের ফসলের ক্ষতি</h2></div><!--end hl-->
                
                <div class="sum">টানা বৃষ্টি ও শিলাবৃষ্টিতে সুনামগঞ্জ জেলার বিভিন্ন হাওরের বেশ কিছু জমির বোরো ফসলের ক্ষতি হয়েছে। জেলার সদর, জামালগঞ্জ, বিশ্বম্বরপুর ও তাহেরপুর উপজেলায় দুদিন ধরে বৃষ্টি ও শিলাবৃষ্টি হয়।

এর আগে গত এক সপ্তাহে জেলার বিভিন্ন হাওরের বেড়িবাঁধ ভেঙে কয়েক হাজার হেক্টর জমির বোরো ফসল তলিয়ে যায়। এরপর দ্বিতীয় দফায় শিলাবৃষ্টিতে ফসলের...</div><!--end sum-->
            
            </a>
            
        </div><!--end home_top_lead_content-->
    </div><!--end col-md-8-->
    
    <div class="col-md-6 col-sm-6"><a href="http://www.ntvbd.com/bangladesh/46144/মাদারীপুরে-আ.-লীগের-দুই-পক্ষের-সংঘর্ষে-৫-জন-গুলিবিদ্ধ"><div class="home_top_lead_more_content"><div class="img pull-left lazy"><img src="//cdn.bn.ntvbd.com/site/photo-1460721263?width=100&height=65" alt="মাদারীপুরে আ. লীগের দুই পক্ষের সংঘর্ষে ৫ জন গুলিবিদ্ধ" title="মাদারীপুরে আ. লীগের দুই পক্ষের সংঘর্ষে ৫ জন গুলিবিদ্ধ"/></div><div class="hl"><h4>মাদারীপুরে আ. লীগের দুই পক্ষের সংঘর্ষে ৫ জন গুলিবিদ্ধ</h4></div><!--end hl--><div class="clr"></div></div><!--end home_top_lead_more_content--></a><a href="http://www.ntvbd.com/bangladesh/46146/কাশিয়ানীতে-আ.-লীগের-দুই-পক্ষে-সংঘর্ষ-পুলিশের-গুলি"><div class="home_top_lead_more_content"><div class="img pull-left lazy"><img src="//cdn.bn.ntvbd.com/site/photo-1460721807?width=100&height=65" alt="কাশিয়ানীতে আ. লীগের দুই পক্ষে সংঘর্ষ, পুলিশের গুলি" title="কাশিয়ানীতে আ. লীগের দুই পক্ষে সংঘর্ষ, পুলিশের গুলি"/></div><div class="hl"><h4>কাশিয়ানীতে আ. লীগের দুই পক্ষে সংঘর্ষ, পুলিশের গুলি</h4></div><!--end hl--><div class="clr"></div></div><!--end home_top_lead_more_content--></a><a href="http://www.ntvbd.com/bangladesh/46128/আ.লীগের-গঠনতন্ত্রে-ইতিবাচক-পরিবর্তন-আসবে"><div class="home_top_lead_more_content"><div class="img pull-left lazy"><img src="//cdn.bn.ntvbd.com/site/photo-1460708663?width=100&height=65" alt="আ.লীগের গঠনতন্ত্রে ইতিবাচক পরিবর্তন আসবে" title="আ.লীগের গঠনতন্ত্রে ইতিবাচক পরিবর্তন আসবে"/></div><div class="hl"><h4>আ.লীগের গঠনতন্ত্রে ইতিবাচক পরিবর্তন আসবে</h4></div><!--end hl--><div class="clr"></div></div><!--end home_top_lead_more_content--></a><a href="http://www.ntvbd.com/bangladesh/46137/দেশে-আইএসের-অস্তিত্ব-নেই-এটা-বিদেশি-ষড়যন্ত্র--স্বরাষ্ট্রমন্ত্রী"><div class="home_top_lead_more_content"><div class="img pull-left lazy"><img src="//cdn.bn.ntvbd.com/site/photo-1460714421?width=100&height=65" alt="দেশে আইএসের অস্তিত্ব নেই, এটা বিদেশি ষড়যন্ত্র : স্বরাষ্ট্রমন্ত্রী" title="দেশে আইএসের অস্তিত্ব নেই, এটা বিদেশি ষড়যন্ত্র : স্বরাষ্ট্রমন্ত্রী"/></div><div class="hl"><h4>দেশে আইএসের অস্তিত্ব নেই, এটা বিদেশি ষড়যন্ত্র : স্বরাষ্ট্রমন্ত্রী</h4></div><!--end hl--><div class="clr"></div></div><!--end home_top_lead_more_content--></a><a href="http://www.ntvbd.com/bangladesh/46121/খালেদা-জিয়ার-সঙ্গে-কোনো-ঐক্য-নয়--হানিফ"><div class="home_top_lead_more_content"><div class="img pull-left lazy"><img src="//cdn.bn.ntvbd.com/site/photo-1460706532?width=100&height=65" alt="খালেদা জিয়ার সঙ্গে কোনো ঐক্য নয় : হানিফ" title="খালেদা জিয়ার সঙ্গে কোনো ঐক্য নয় : হানিফ"/></div><div class="hl"><h4>খালেদা জিয়ার সঙ্গে কোনো ঐক্য নয় : হানিফ</h4></div><!--end hl--><div class="clr"></div></div><!--end home_top_lead_more_content--></a><a href="http://www.ntvbd.com/bangladesh/46107/বৈশাখে-পান্তা-ইলিশ-খেয়ে-২৫-জন-হাসপাতালে"><div class="home_top_lead_more_content"><div class="img pull-left lazy"><img src="//cdn.bn.ntvbd.com/site/photo-1460698819?width=100&height=65" alt="বৈশাখে পান্তা-ইলিশ খেয়ে ২৫ জন হাসপাতালে" title="বৈশাখে পান্তা-ইলিশ খেয়ে ২৫ জন হাসপাতালে"/></div><div class="hl"><h4>বৈশাখে পান্তা-ইলিশ খেয়ে ২৫ জন হাসপাতালে</h4></div><!--end hl--><div class="clr"></div></div><!--end home_top_lead_more_content--></a></div><!--end col-md-6-->
</div><!--end row-->
</div>
    
        
    <!--call lead_selected_content-->
    <div id="lead_selected_content"><!----------------------------------------------------------------------
| TOP SELECTED CONTENTS SETUP
----------------------------------------------------------------------->
<div class="row">
	<div class="col-md-6 col-sm-6">
		<div class="elected_content_caption">
        	<h4>নির্বাচিত</h4>
        </div><!--end elected_content_caption-->
        
        <div class="elected_content_block"><a href="http://www.ntvbd.com/health/46141/দীর্ঘমেয়াদি-ব্যথা-দূর-করবে-যেসব-খাবার"><div class="elected_content"><div class="img pull-left lazy"><img src="//cdn.bn.ntvbd.com/site/photo-1460718767?width=100&height=65" alt="দীর্ঘমেয়াদি ব্যথা দূর করবে যেসব খাবার" title="দীর্ঘমেয়াদি ব্যথা দূর করবে যেসব খাবার" /></div><div class="hl"><h4>দীর্ঘমেয়াদি ব্যথা দূর করবে যেসব খাবার</h4></div><!--end hl--><div class="clr"></div></div><!--end home_top_lead_more_content--></a><a href="http://www.ntvbd.com/sports/46134/ভাষা-সমস্যায়-মুস্তাফিজ"><div class="elected_content"><div class="img pull-left lazy"><img src="//cdn.bn.ntvbd.com/site/photo-1460713352?width=100&height=65" alt="ভাষা সমস্যায় মুস্তাফিজ" title="ভাষা সমস্যায় মুস্তাফিজ" /></div><div class="hl"><h4>ভাষা সমস্যায় মুস্তাফিজ</h4></div><!--end hl--><div class="clr"></div></div><!--end home_top_lead_more_content--></a><a href="http://www.ntvbd.com/lifestyle/46133/হবু-বরকে-মেয়েরা-যে-১০-প্রশ্ন-করতে-চায়-কিন্তু-করে-না"><div class="elected_content"><div class="img pull-left lazy"><img src="//cdn.bn.ntvbd.com/site/photo-1460712764?width=100&height=65" alt="হবু বরকে মেয়েরা যে ১০ প্রশ্ন করতে চায়, কিন্তু করে না!" title="হবু বরকে মেয়েরা যে ১০ প্রশ্ন করতে চায়, কিন্তু করে না!" /></div><div class="hl"><h4>হবু বরকে মেয়েরা যে ১০ প্রশ্ন করতে চায়, কিন্তু করে না!</h4></div><!--end hl--><div class="clr"></div></div><!--end home_top_lead_more_content--></a><a href="http://www.ntvbd.com/world/46129/৭৮-কোটি-টাকায়-গোটা-গ্রাম-বিক্রি"><div class="elected_content"><div class="img pull-left lazy"><img src="//cdn.bn.ntvbd.com/site/photo-1460708928?width=100&height=65" alt="৭৮ কোটি টাকায় গোটা গ্রাম বিক্রি!" title="৭৮ কোটি টাকায় গোটা গ্রাম বিক্রি!" /></div><div class="hl"><h4>৭৮ কোটি টাকায় গোটা গ্রাম বিক্রি!</h4></div><!--end hl--><div class="clr"></div></div><!--end home_top_lead_more_content--></a></div><!--end elected_content_block-->
    </div><!--end col-md-8-->
    
    <div class="col-md-6 col-sm-6 hidden-xs">
		<div class="selected_content_caption">
        	<h4>আরও খবর</h4>
        </div><!--end elected_content_caption-->
        
        <div class="selected_content_block"><ul><li><div class="more_selected_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/bangladesh/46132/ঝিনাইদহে-দুই-যুবক-আটক-অস্ত্র-ও-গুলি-উদ্ধার">ঝিনাইদহে দুই যুবক আটক, অস্ত্র ও গুলি উদ্ধার</a></span></div></li><li><div class="more_selected_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/world/46102/উত্তর-কোরিয়ার-ক্ষেপণাস্ত্র-পরীক্ষা-ব্যর্থ-দাবি-দক্ষিণের">উত্তর কোরিয়ার ক্ষেপণাস্ত্র পরীক্ষা ব্যর্থ, দাবি দক্ষিণের</a></span></div></li><li><div class="more_selected_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/bangladesh/46122/ছিনতাইকারীর-ছুরিকাঘাতে-রাজধানীতে-যুবক-খুন">ছিনতাইকারীর ছুরিকাঘাতে রাজধানীতে যুবক খুন</a></span></div></li><li><div class="more_selected_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/world/46104/জাপানে-শক্তিশালী-ভূমিকম্পে-নিহত-নয়-আহত-আড়াইশর-বেশি">জাপানে শক্তিশালী ভূমিকম্পে নিহত নয়, আহত আড়াইশর বেশি</a></span></div></li><li><div class="more_selected_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/bangladesh/46094/চায়ের-কাপে-কীটনাশক-২৬-জন-হাসপাতালে">চায়ের কাপে কীটনাশক, ২৬ জন হাসপাতালে</a></span></div></li><li><div class="more_selected_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/sports/46100/সহজ-গ্রুপে-ব্রাজিল-আর্জেন্টিনার-প্রতিপক্ষ-পর্তুগাল">সহজ গ্রুপে ব্রাজিল, আর্জেন্টিনার প্রতিপক্ষ পর্তুগাল</a></span></div></li><li><div class="more_selected_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/bangladesh/46110/চুয়েটের-ভারপ্রাপ্ত-উপাচার্য-ড.-রফিকুল">চুয়েটের ভারপ্রাপ্ত উপাচার্য ড. রফিকুল</a></span></div></li><li><div class="more_selected_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/world/46097/মার্কিন-যুদ্ধজাহাজের-কাছে-রুশ-যুদ্ধবিমান">মার্কিন যুদ্ধজাহাজের কাছে রুশ যুদ্ধবিমান</a></span></div></li><li><div class="more_selected_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/world/46098/যা-বলেছি-বেশ-করেছি-আমি-মমতা">'যা বলেছি বেশ করেছি, আমি মমতা'</a></span></div></li><li><div class="more_selected_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/bangladesh/46080/নববর্ষে-ঐক্যের-ডাক-খালেদা-জিয়ার">নববর্ষে ঐক্যের ডাক খালেদা জিয়ার</a></span></div></li><li><div class="more_selected_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/bangladesh/46085/নানা-আয়োজনে-পয়লা-বৈশাখ-উদযাপিত">নানা আয়োজনে পয়লা বৈশাখ উদযাপিত</a></span></div></li><li><div class="more_selected_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/bangladesh/46083/বৈশাখে-ঘুরতে-এসে-লাশ-হয়ে-ফিরল-দুই-যুবক">বৈশাখে ঘুরতে এসে লাশ হয়ে ফিরল দুই যুবক</a></span></div></li><li><div class="more_selected_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/education/46091/ঢাবি-ছাত্রীর-গায়ে-পুলিশের-হাত-পরে-ক্ষমা-প্রার্থনা">ঢাবি ছাত্রীর গায়ে পুলিশের হাত, পরে ক্ষমা প্রার্থনা</a></span></div></li></ul></div><!--end elected_content_block-->
        
        <div class="more_news_btn_block">
        	<div class="latest_news_btn col-md-6 col-sm-6"><a href="http://www.ntvbd.com/all-news">সর্বশেষ সব খবর</a></div><!--end latest_news_btn-->
                        <div class="elected_allnews_btn col-md-6 col-sm-6"><a href="http://www.ntvbd.com/all-news/selected-news">নির্বাচিত সব খবর</a></div><!--end latest_news_btn-->
        </div><!--end more_news_btn_block-->
    </div><!--end col-md-6-->
</div><!--end row-->
</div>
     
    	    <!--call ver_ads_space-->
	    <div class="space"></div>
	    <div align="center">
	        <div class="adsSpace650x100 hidden-xs"><!-- Ntv_home_600x150_320x100_320x50_M1 -->
<div id='div-gpt-ad-1422078900996-2'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1422078900996-2'); });
</script>
</div>
</div><!--end adsSpace650x100-->
	    </div>
        <div class="space"></div>
    <div id="union_parishad_content"><style>
.union_parishad_section{width:100%;height:auto;background-color:#fff;border-left:7px solid #dd2c2c;border-right:7px solid #dd2c2c;border-bottom:7px solid #dd2c2c}
.union_parishad_header{width:100%;height:52px;background:url("http://ntv-bn-cdn.s3.amazonaws.com/images/NTV-union-prishod-nibachan.png");background-repeat:repeat}
.union_logo{float:left;margin-left:10px}
.union_text{float:left;margin-left:10px}
.union_text p{color:#fff;font-size:20px;padding-top: 20px;}
.union_parishad_content{width:100%;}
.union_parishad_content .left{width:47%;float:left;margin-left:10px;border-right:1px solid #ccc;padding-right: 17px;}
.union_parishad_content .left .top{width:100%;}
.union_parishad_content .left .top ul{list-style-type:none}
.union_parishad_content .left .top ul li{clear:both;border-bottom:1px solid #ccc;margin-bottom:10px;padding:0;padding-bottom:10px;}
.union_parishad_content .left .top ul li img{}
.union_parishad_content .left .top .headline_text{padding:0;padding-left: 10px}
.union_parishad_content .left .bottom{width:100%;}
.union_parishad_content .left .bottom .most_click{border-bottom:3px solid #ee2f2f;background-color:#dcdcdc;padding: 6px;}
.union_parishad_content .left .bottom .most_click p{margin:0}
.union_parishad_content .left .bottom ul{list-style-type:none;padding-top:5px}
.union_parishad_content .left .bottom ul li{clear:both;border-bottom:1px solid #ccc;margin-bottom:10px;padding:0;padding-bottom:10px;}
.union_parishad_content .left .bottom .headline_text{padding:0;padding-left: 10px}
.union_parishad_content .right{width:47%;float:right;margin-right:10px}
.union_parishad_content .right .union_right_content{width:100%;}
.union_parishad_content .right .union_right_content .most_click{border-bottom:3px solid #ee2f2f}
.union_parishad_content .right .union_right_content ul{list-style-type:none;padding-top:5px}
.union_parishad_content .right .union_right_content ul li{clear:both;border-bottom:1px solid #ccc;margin-bottom:10px;padding:0;padding-bottom:10px;}
.union_parishad_content .right .union_right_content .headline_text{padding:0;padding-left: 10px}
.union_parishad_section .space{width:100%;height:30px}
</style>
<div class="union_parishad_section">
<div class="union_parishad_header">
<div class="union_logo">
<a href="http://www.ntvbd.com/up-election" target="_blank"><img src="http://ntv-bn-cdn.s3.amazonaws.com/images/union-logo.png" alt="union-logo" title="union-logo" /></a>
</div>
<div class="union_text">
<a href="http://www.ntvbd.com/up-election" target="_blank" style="color:#fff"><p>ইউনিয়ন পরিষদ নির্বাচন-২০১৬</p></a>
</div>
</div>
<div class="space"></div>
<div class="union_parishad_content">
<div class="left">
<div class="top">
<ul>
<li class="col-xs-12 col-md-12">  
<a href="http://www.ntvbd.com/election/up-election/46146/কাশিয়ানীতে-আ.-লীগের-দুই-পক্ষে-সংঘর্ষ,-পুলিশের-গুলি">
  <div class="col-xs-4 col-md-4" style="padding: 0">
<img width="100px" height="65px" style="" title="কাশিয়ানীতে আ. লীগের দুই পক্ষে সংঘর্ষ, পুলিশের গুলি" alt="কাশিয়ানীতে আ. লীগের দুই পক্ষে সংঘর্ষ, পুলিশের গুলি" src="//cdn.bn.ntvbd.com/site/photo-1460721807" />
  </div>
<div class="headline_text col-xs-8 col-md-8">কাশিয়ানীতে আ. লীগের দুই পক্ষে সংঘর্ষ, পুলিশের গুলি</div>
  </a>
</li>
<li class="col-xs-12 col-md-12">  
<a href="http://www.ntvbd.com/election/up-election/46144/মাদারীপুরে-আ.-লীগের-দুই-পক্ষের-সংঘর্ষে-৫-জন-গুলিবিদ্ধ">
  <div class="col-xs-4 col-md-4" style="padding: 0">
<img width="100px" height="65px" style="" title="মাদারীপুরে আ. লীগের দুই পক্ষের সংঘর্ষে ৫ জন গুলিবিদ্ধ" alt="মাদারীপুরে আ. লীগের দুই পক্ষের সংঘর্ষে ৫ জন গুলিবিদ্ধ" src="//cdn.bn.ntvbd.com/site/photo-1460721263" />
  </div>
<div class="headline_text col-xs-8 col-md-8">মাদারীপুরে আ. লীগের দুই পক্ষের সংঘর্ষে ৫ জন গুলিবিদ্ধ</div>
  </a>
</li>
<li class="col-xs-12 col-md-12">  
<a href="http://www.ntvbd.com/election/up-election/46086/নির্বাচনী-কর্মকর্তার-বিরুদ্ধে-টাকা-নেওয়ার-অভিযোগ">
  <div class="col-xs-4 col-md-4" style="padding: 0">
<img width="100px" height="65px" style="" title="নির্বাচনী কর্মকর্তার বিরুদ্ধে টাকা নেওয়ার অভিযোগ" alt="নির্বাচনী কর্মকর্তার বিরুদ্ধে টাকা নেওয়ার অভিযোগ" src="//cdn.bn.ntvbd.com/site/photo-1460648118" />
  </div>
<div class="headline_text col-xs-8 col-md-8">নির্বাচনী কর্মকর্তার বিরুদ্ধে টাকা নেওয়ার অভিযোগ</div>
  </a>
</li>
</ul>
<div style="clear:both"></div>
</div>
<div class="bottom">
<div class="most_click"><p style="font-size:18px">সর্বাধিক ক্লিক</p></div>
<div>
<ul>
<li class="col-xs-12 col-md-12">  
<a href="http://www.ntvbd.com/election/up-election/46086/নির্বাচনী-কর্মকর্তার-বিরুদ্ধে-টাকা-নেওয়ার-অভিযোগ">
<div class="headline_text col-xs-12 col-md-12"><i class="fa fa-angle-right fa_headline"></i>নির্বাচনী কর্মকর্তার বিরুদ্ধে টাকা নেওয়ার অভিযোগ</div>
  </a>
</li>
<li class="col-xs-12 col-md-12">  
<a href="http://www.ntvbd.com/election/up-election/46079/নীলফামারীতে-প্রচারের-সময়-সাবেক-সংসদ-সদস্যের-ওপর-হামলা">
<div class="headline_text col-xs-12 col-md-12"><i class="fa fa-angle-right fa_headline"></i>নীলফামারীতে প্রচারের সময় সাবেক সংসদ সদস্যের ওপর হামলা</div>
  </a>
</li>
<li class="col-xs-12 col-md-12">  
<a href="http://www.ntvbd.com/election/up-election/46060/রঙিন-পোস্টারে-প্রচার,-পার্বতীপুরে-প্রার্থীকে-জরিমানা">
<div class="headline_text col-xs-12 col-md-12"><i class="fa fa-angle-right fa_headline"></i>রঙিন পোস্টারে প্রচার, পার্বতীপুরে প্রার্থীকে জরিমানা</div>
  </a>
</li>
</ul>
</div>
</div>
</div>
<div class="right">
<div class="union_right_content">
<ul>
<li class="col-xs-12 col-md-12">  
<a href="http://www.ntvbd.com/election/up-election/46079/নীলফামারীতে-প্রচারের-সময়-সাবেক-সংসদ-সদস্যের-ওপর-হামলা">
<div class="headline_text col-xs-12 col-md-12"><i class="fa fa-angle-right fa_headline"></i>নীলফামারীতে প্রচারের সময় সাবেক সংসদ সদস্যের ওপর হামলা</div>
  </a>
</li>
<li class="col-xs-12 col-md-12">  
<a href="http://www.ntvbd.com/election/up-election/46071/‘নির্বাচনীবিরোধে’-নান্দাইলে-যুবক-জখম">
<div class="headline_text col-xs-12 col-md-12"><i class="fa fa-angle-right fa_headline"></i>‘নির্বাচনীবিরোধে’ নান্দাইলে যুবক জখম</div>
  </a>
</li>
<li class="col-xs-12 col-md-12">  
<a href="http://www.ntvbd.com/election/up-election/46060/রঙিন-পোস্টারে-প্রচার,-পার্বতীপুরে-প্রার্থীকে-জরিমানা">
<div class="headline_text col-xs-12 col-md-12"><i class="fa fa-angle-right fa_headline"></i>রঙিন পোস্টারে প্রচার, পার্বতীপুরে প্রার্থীকে জরিমানা</div>
  </a>
</li>
<li class="col-xs-12 col-md-12">  
<a href="http://www.ntvbd.com/election/up-election/45998/রামগঞ্জে-বিএনপি-প্রার্থীর-বাড়িতে-হামলা,-ভাঙচুর">
<div class="headline_text col-xs-12 col-md-12"><i class="fa fa-angle-right fa_headline"></i>রামগঞ্জে বিএনপি প্রার্থীর বাড়িতে হামলা, ভাঙচুর</div>
  </a>
</li>
<li class="col-xs-12 col-md-12">  
<a href="http://www.ntvbd.com/election/up-election/45991/মাধবপুরে-আ.-লীগের-১৬-নেতাকে-শোকজ">
<div class="headline_text col-xs-12 col-md-12"><i class="fa fa-angle-right fa_headline"></i>মাধবপুরে আ. লীগের ১৬ নেতাকে শোকজ</div>
  </a>
</li>
<li class="col-xs-12 col-md-12">  
<a href="http://www.ntvbd.com/election/up-election/45983/শ্রীবরদীর-মেয়রকে-বরখাস্তের-সুপারিশ,-মামলার-নির্দেশ">
<div class="headline_text col-xs-12 col-md-12"><i class="fa fa-angle-right fa_headline"></i>শ্রীবরদীর মেয়রকে বরখাস্তের সুপারিশ, মামলার নির্দেশ</div>
  </a>
</li>
<li class="col-xs-12 col-md-12">  
<a href="http://www.ntvbd.com/election/up-election/45973/রূপগঞ্জে-নির্বাচনী-সহিংসতায়-একজন-নিহত">
<div class="headline_text col-xs-12 col-md-12"><i class="fa fa-angle-right fa_headline"></i>রূপগঞ্জে নির্বাচনী সহিংসতায় একজন নিহত</div>
  </a>
</li>
<li class="col-xs-12 col-md-12">  
<a href="http://www.ntvbd.com/election/up-election/45931/ক্ষমতাসীন-দলের-তাণ্ডবে-গ্রামে-গ্রামে-আতঙ্ক-:-রিজভী">
<div class="headline_text col-xs-12 col-md-12"><i class="fa fa-angle-right fa_headline"></i>ক্ষমতাসীন দলের তাণ্ডবে গ্রামে গ্রামে আতঙ্ক : রিজভী</div>
  </a>
</li>
<li class="col-xs-12 col-md-12">  
<a href="http://www.ntvbd.com/election/up-election/45911/অনিয়মের-অভিযোগ,-ঝালকাঠি-পৌর-নির্বাচন-বাতিল-চেয়ে-মামলা">
<div class="headline_text col-xs-12 col-md-12"><i class="fa fa-angle-right fa_headline"></i>অনিয়মের অভিযোগ, ঝালকাঠি পৌর নির্বাচন বাতিল চেয়ে মামলা</div>
  </a>
</li>
<li class="col-xs-12 col-md-12">  
<a href="http://www.ntvbd.com/election/up-election/45858/মশাল-থাকছে-ইনুর-হাতেই!">
<div class="headline_text col-xs-12 col-md-12"><i class="fa fa-angle-right fa_headline"></i>মশাল থাকছে ইনুর হাতেই!</div>
  </a>
</li>
</ul>
</div>
<div style="text-align:right;margin-bottom:10px"><a href="http://www.ntvbd.com/up-election" style="color:#ef3d3d;">আরও খবর</a></div>
</div>
</div>
<div style="clear:both"></div>
</div></div>
    <!--call video_content-->
    <div id="video_content"><!----------------------------------------------------------------------
| VIDEO CONTENTS SETUP
----------------------------------------------------------------------->
<div class="video_content_caption">
    <h4><a href="http://video.ntvbd.com" target="_blank">ভিডিও</a></h4>
    <a href="https://www.facebook.com/ntvvideo" target="_blank"><span class="icon smallFacebookIcon facebook"></span></a>
    <a href="https://www.youtube.com/channel/UCYqujAD5831EywH1jldBu5w?sub_confirmation=1" target="_blank"><span class="icon smallYoutubeIcon youtube"></span></a>
    <a href="http://www.dailymotion.com/ntv" target="_blank"><span class="icon smallDailyMotionIcon dailymotion"></span></a>
    <a href="http://video.ntvbd.com" target="_blank"><i class="fa fa-angle-down"></i></a>
</div>
<div class="row"><div class="col-md-6 col-sm-6"><div class="video_content_block"><div class="img"><iframe width="100%" height="210" src="https://www.youtube.com/embed/hPQrsdBNjBM?autoplay=0" frameborder="0" allowfullscreen></iframe></div><div class="hl"><h4><a href="http://www.ntvbd.com/livetv" target="_blank" style="color:red">এনটিভি সরাসরি সম্প্রচার</a></h4></div></div></div><div class="col-md-6 col-sm-6"><div class="video_content_block"><div class="img"><i class="fa fa-play"></i><a href="http://video.ntvbd.com/ntv-news/dupurer-khobor/dupurer-khobor-15-april-2016/1460712127.ntv"><div class="lazy" style="background-image:url(//cdn.bn.ntvbd.com/video/1460712127?width=300&height=210);  background-size:cover; width:300px; height:210px"></div></a></div><div class="hl"><h4><a href="http://video.ntvbd.com/ntv-news/dupurer-khobor/dupurer-khobor-15-april-2016/1460712127.ntv"><span class="preFix"></span>দুপুরের খবর : ১৫ এপ্রিল, ২০১৬</a></h4></div></div></div><div class="clr"></div><div class="col-xs-6 col-md-3 col-sm-3"><div class="more_video_content_block"><div class="img"><i class="fa fa-play"></i><a href="http://video.ntvbd.com/bangladesh/dhaka/one-knifed-to-death-in-capital/1460706183.ntv"><div class="lazy" style="background-image:url(//cdn.bn.ntvbd.com/video/1460706183?width=138&height=104);  background-size:cover; width:138px; height:104px"></div></a></div><div class="hl"><h5><a href="http://video.ntvbd.com/bangladesh/dhaka/one-knifed-to-death-in-capital/1460706183.ntv"><span class="preFix"></span>রাজধানীতে ছিনতাইকারীর ছুরিকাঘাতে একজন নিহত</a></h5></div></div></div><div class="col-xs-6 col-md-3 col-sm-3"><div class="more_video_content_block"><div class="img"><i class="fa fa-play"></i><a href="http://video.ntvbd.com/bangladesh/dhaka/blissful-mangal-shobhayatra/1460617266.ntv"><div class="lazy" style="background-image:url(//cdn.bn.ntvbd.com/video/1460617266?width=138&height=104);  background-size:cover; width:138px; height:104px"></div></a></div><div class="hl"><h5><a href="http://video.ntvbd.com/bangladesh/dhaka/blissful-mangal-shobhayatra/1460617266.ntv"><span class="preFix"></span>মঙ্গলময় মঙ্গলশোভাযাত্রা</a></h5></div></div></div><div class="col-xs-6 col-md-3 col-sm-3"><div class="more_video_content_block"><div class="img"><i class="fa fa-play"></i><a href="http://video.ntvbd.com/bangladesh/dhaka/chayanat-celebrate-bangla-noboborsho-with-music/1460624469.ntv"><div class="lazy" style="background-image:url(//cdn.bn.ntvbd.com/video/1460624469?width=138&height=104);  background-size:cover; width:138px; height:104px"></div></a></div><div class="hl"><h5><a href="http://video.ntvbd.com/bangladesh/dhaka/chayanat-celebrate-bangla-noboborsho-with-music/1460624469.ntv"><span class="preFix"></span>সুরের মূর্ছনায় ছায়ানটের বর্ষবরণ</a></h5></div></div></div><div class="col-xs-6 col-md-3 col-sm-3"><div class="more_video_content_block"><div class="img"><i class="fa fa-play"></i><a href="http://video.ntvbd.com/religion/dorse-hadis/dorse-hadis-episode-330-islamic-show/1460711953.ntv"><div class="lazy" style="background-image:url(//cdn.bn.ntvbd.com/video/1460711953?width=138&height=104);  background-size:cover; width:138px; height:104px"></div></a></div><div class="hl"><h5><a href="http://video.ntvbd.com/religion/dorse-hadis/dorse-hadis-episode-330-islamic-show/1460711953.ntv"><span class="preFix"></span>দরসে হাদিস, পর্ব ৩৩০</a></h5></div></div></div><div class="col-xs-6 col-md-3 col-sm-3"><div class="more_video_content_block"><div class="img"><i class="fa fa-play"></i><a href="http://video.ntvbd.com/religion/apnar-jiggasha/apnar-jiggasa-friday-live-episode-470/1460712323.ntv"><div class="lazy" style="background-image:url(//cdn.bn.ntvbd.com/video/1460712323?width=138&height=104);  background-size:cover; width:138px; height:104px"></div></a></div><div class="hl"><h5><a href="http://video.ntvbd.com/religion/apnar-jiggasha/apnar-jiggasa-friday-live-episode-470/1460712323.ntv"><span class="preFix"></span>আপনার জিজ্ঞাসা : পর্ব ৪৭০</a></h5></div></div></div><div class="col-xs-6 col-md-3 col-sm-3"><div class="more_video_content_block"><div class="img"><i class="fa fa-play"></i><a href="http://video.ntvbd.com/bangladesh/dhaka/hurting-religious-sentiments-will-not-be-tolerated:-pm/1460624352.ntv"><div class="lazy" style="background-image:url(//cdn.bn.ntvbd.com/video/1460624352?width=138&height=104);  background-size:cover; width:138px; height:104px"></div></a></div><div class="hl"><h5><a href="http://video.ntvbd.com/bangladesh/dhaka/hurting-religious-sentiments-will-not-be-tolerated:-pm/1460624352.ntv"><span class="preFix"></span>ধর্মীয় অনুভূতিতে আঘাত সহ্য করা হবে না: প্রধানমন্ত্রী</a></h5></div></div></div><div class="col-xs-6 col-md-3 col-sm-3"><div class="more_video_content_block"><div class="img"><i class="fa fa-play"></i><a href="http://video.ntvbd.com/world/north-america/united-states-concerned-about-human-rights-in-bangladesh/1460624595.ntv"><div class="lazy" style="background-image:url(//cdn.bn.ntvbd.com/video/1460624595?width=138&height=104);  background-size:cover; width:138px; height:104px"></div></a></div><div class="hl"><h5><a href="http://video.ntvbd.com/world/north-america/united-states-concerned-about-human-rights-in-bangladesh/1460624595.ntv"><span class="preFix"></span>মানবাধিকার প্রশ্নে বাংলাদেশ নিয়ে উদ্বিগ্ন যুক্তরাষ্ট্র</a></h5></div></div></div><div class="col-xs-6 col-md-3 col-sm-3"><div class="more_video_content_block"><div class="img"><i class="fa fa-play"></i><a href="http://video.ntvbd.com/discussion/ei-shomoy/ei-somoy-episode-2094-talk-show/1460579044.ntv"><div class="lazy" style="background-image:url(//cdn.bn.ntvbd.com/video/1460579044?width=138&height=104);  background-size:cover; width:138px; height:104px"></div></a></div><div class="hl"><h5><a href="http://video.ntvbd.com/discussion/ei-shomoy/ei-somoy-episode-2094-talk-show/1460579044.ntv"><span class="preFix">টক শো : </span>এই সময়, পর্ব ২০৯৪</a></h5></div></div></div></div>
</div>
        
    <!--call cat_summary_content-->
    <div id="cat_summary_content"><!----------------------------------------------------------------------
| CATEGORY SUMMARY CONTENTS SETUP
----------------------------------------------------------------------->
<div class="row"><div class="col-md-4 col-sm-4"><div class="cat_summary_block"><a href="http://www.ntvbd.com/bangladesh"><div class="cat_summary_title" style="background:#630933"><h4>বাংলাদেশ</h4><i class="fa_arrbot"><img src="http://www.ntvbd.com/templates/ntv-v1/images/arrow.png" border="0" /></i></div><!--end cat_summary_title--></a><a href="http://www.ntvbd.com/bangladesh/46143/মেহেরপুরে-দোকানে-অগ্নিকাণ্ড"><div class="img lazy" style="border-top-color:#630933"><img src="//cdn.bn.ntvbd.com/site/photo-1460720082?width=213&height=145" alt="মেহেরপুরে দোকানে অগ্নিকাণ্ড" title="মেহেরপুরে দোকানে অগ্নিকাণ্ড" width="100%" /></div><div class="hl"><h4>মেহেরপুরে দোকানে অগ্নিকাণ্ড</h4></div></a><div class="more_hl"><ul><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/bangladesh/46096/সিলেটে-পরিবহন-ধর্মঘট-স্থগিত">সিলেটে পরিবহন ধর্মঘট স্থগিত</a></span></div></li><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/bangladesh/46093/মেলা-শেষে-নাতিকে-নিয়ে-বাসায়-ফেরা-হলো-না-অর্চনার">মেলা শেষে নাতিকে নিয়ে বাসায় ফেরা হলো না অর্চনার</a></span></div></li><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/bangladesh/46088/ব্রাহ্মণপাড়া-বিএনপির-কমিটি-অনুমোদন">ব্রাহ্মণপাড়া বিএনপির কমিটি অনুমোদন</a></span></div></li><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/bangladesh/46087/ভাইয়ের-স্ত্রীকে-বাঁচাতে-গিয়ে-ভাসুরেরও-মৃত্যু">ভাইয়ের স্ত্রীকে বাঁচাতে গিয়ে ভাসুরেরও মৃত্যু</a></span></div></li></ul></div><!--end more_hl--></div><!--end cat_summary_block--></div><!--end col-md-4--><div class="col-md-4 col-sm-4"><div class="cat_summary_block"><a href="http://www.ntvbd.com/world"><div class="cat_summary_title" style="background:#f47c20"><h4>বিশ্ব</h4><i class="fa_arrbot"><img src="http://www.ntvbd.com/templates/ntv-v1/images/arrow.png" border="0" /></i></div><!--end cat_summary_title--></a><a href="http://www.ntvbd.com/world/46147/মার্কিন-সরকারের-বিরুদ্ধে-মাইক্রোসফটের-মামলা"><div class="img lazy" style="border-top-color:#f47c20"><img src="//cdn.bn.ntvbd.com/site/photo-1460721975?width=213&height=145" alt="মার্কিন সরকারের বিরুদ্ধে মাইক্রোসফটের মামলা" title="মার্কিন সরকারের বিরুদ্ধে মাইক্রোসফটের মামলা" width="100%" /></div><div class="hl"><h4>মার্কিন সরকারের বিরুদ্ধে মাইক্রোসফটের মামলা</h4></div></a><div class="more_hl"><ul><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/world/46131/গরু-হারানোর-বিজ্ঞপ্তি-পেলে-৫০-হাজার-রুপি-পুরস্কার">গরু হারানোর বিজ্ঞপ্তি, পেলে ৫০ হাজার রুপি পুরস্কার</a></span></div></li><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/world/46125/ব্যবসার-স্বার্থে-দেশের-নাম-বদল">ব্যবসার স্বার্থে দেশের নাম বদল!</a></span></div></li><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/world/46120/পুতিন-ক্যাফেতে-ওবামা-টয়লেট-পেপার">পুতিন ক্যাফেতে ওবামা টয়লেট পেপার</a></span></div></li><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/world/46112/কুমিরকে-গিলে-খেল-কুমির">কুমিরকে গিলে খেল কুমির</a></span></div></li></ul></div><!--end more_hl--></div><!--end cat_summary_block--></div><!--end col-md-4--><div class="col-md-4 col-sm-4"><div class="cat_summary_block"><a href="http://www.ntvbd.com/sports"><div class="cat_summary_title" style="background:#4579bd"><h4>খেলাধুলা</h4><i class="fa_arrbot"><img src="http://www.ntvbd.com/templates/ntv-v1/images/arrow.png" border="0" /></i></div><!--end cat_summary_title--></a><a href="http://www.ntvbd.com/sports/46139/ফাইনালে-আবারও-মাদ্রিদ-ডার্বির-সম্ভাবনা"><div class="img lazy" style="border-top-color:#4579bd"><img src="//cdn.bn.ntvbd.com/site/photo-1460716878?width=213&height=145" alt="ফাইনালে আবারও মাদ্রিদ ডার্বির সম্ভাবনা" title="ফাইনালে আবারও মাদ্রিদ ডার্বির সম্ভাবনা" width="100%" /></div><div class="hl"><h4>ফাইনালে আবারও মাদ্রিদ ডার্বির সম্ভাবনা</h4></div></a><div class="more_hl"><ul><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/sports/46138/কোহলির-চোখে-ডি-ভিলিয়ার্সই-সেরা">কোহলির চোখে ডি ভিলিয়ার্সই সেরা</a></span></div></li><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/sports/46123/মুস্তাফিজের-কলকাতা-বধের-প্রস্তুতি">মুস্তাফিজের কলকাতা-বধের প্রস্তুতি</a></span></div></li><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/sports/46109/উপস্থাপিকাকে-বাংলা-শেখালেন-সাকিব">উপস্থাপিকাকে বাংলা শেখালেন সাকিব!</a></span></div></li><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/sports/46116/বার্সেলোনার-বিদায়ে-খুশি-দেল-বস্ক">বার্সেলোনার বিদায়ে খুশি দেল বস্ক</a></span></div></li></ul></div><!--end more_hl--></div><!--end cat_summary_block--></div><!--end col-md-4--></div><!--end row--><div class="row"><div class="col-md-4 col-sm-4"><div class="cat_summary_block"><a href="http://www.ntvbd.com/entertainment"><div class="cat_summary_title" style="background:#d41b5d"><h4>বিনোদন</h4><i class="fa_arrbot"><img src="http://www.ntvbd.com/templates/ntv-v1/images/arrow.png" border="0" /></i></div><!--end cat_summary_title--></a><a href="http://www.ntvbd.com/entertainment/46142/আবারও-পেছাল-পরবাসিনী-মুক্তির-তারিখ"><div class="img lazy" style="border-top-color:#d41b5d"><img src="//cdn.bn.ntvbd.com/site/photo-1460719694?width=213&height=145" alt="আবারও পেছাল ‘পরবাসিনী’ মুক্তির তারিখ" title="আবারও পেছাল ‘পরবাসিনী’ মুক্তির তারিখ" width="100%" /></div><div class="hl"><h4>আবারও পেছাল ‘পরবাসিনী’ মুক্তির তারিখ</h4></div></a><div class="more_hl"><ul><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/entertainment/46130/আমাকে-ডেকে-নিয়ে-অপমান-করা-হয়েছে--নাসরিন">আমাকে ডেকে নিয়ে অপমান করা হয়েছে : নাসরিন</a></span></div></li><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/entertainment/46117/সিনেমাকে-পুরুষ-বা-নারীকেন্দ্রিক-বলা-উচিত-নয়--আনুশকা">সিনেমাকে পুরুষ বা নারীকেন্দ্রিক বলা উচিত নয় : আনুশকা</a></span></div></li><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/entertainment/46119/নতুন-দুই-গান-নিয়ে-এসেছেন-কুমার-বিশ্বজিৎ">নতুন দুই গান নিয়ে এসেছেন কুমার বিশ্বজিৎ</a></span></div></li><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/entertainment/46108/শাহরুখের-ফ্যান-এখন-সিনেমা-হলে">শাহরুখের ‘ফ্যান’ এখন সিনেমা হলে</a></span></div></li></ul></div><!--end more_hl--></div><!--end cat_summary_block--></div><!--end col-md-4--><div class="col-md-4 col-sm-4"><div class="cat_summary_block"><a href="http://www.ntvbd.com/economy"><div class="cat_summary_title" style="background:#322a7d"><h4>অর্থনীতি</h4><i class="fa_arrbot"><img src="http://www.ntvbd.com/templates/ntv-v1/images/arrow.png" border="0" /></i></div><!--end cat_summary_title--></a><a href="http://www.ntvbd.com/economy/46027/উৎসব-ঘিরে-চাঙ্গা-হচ্ছে-কুটিরশিল্পের-অর্থনীতি"><div class="img lazy" style="border-top-color:#322a7d"><img src="//cdn.bn.ntvbd.com/site/photo-1460606226?width=213&height=145" alt="উৎসব ঘিরে চাঙ্গা হচ্ছে কুটিরশিল্পের অর্থনীতি" title="উৎসব ঘিরে চাঙ্গা হচ্ছে কুটিরশিল্পের অর্থনীতি" width="100%" /></div><div class="hl"><h4>উৎসব ঘিরে চাঙ্গা হচ্ছে কুটিরশিল্পের অর্থনীতি</h4></div></a><div class="more_hl"><ul><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/economy/45938/১০-দিনের-মধ্যে-জ্বালানি-তেলের-দাম-কমছে">১০ দিনের মধ্যে জ্বালানি তেলের দাম কমছে</a></span></div></li><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/economy/45909/গ্রামীণফোনের-পর্ষদ-সভা-১৯-এপ্রিল">গ্রামীণফোনের পর্ষদ সভা ১৯ এপ্রিল</a></span></div></li><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/economy/45894/জ্বালানি-ব্যবস্থাপনায়-বাংলাদেশের-উন্নতি">জ্বালানি ব্যবস্থাপনায় বাংলাদেশের উন্নতি</a></span></div></li><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/economy/45893/চিঠি-পাওয়ার-পরও-অর্থ-ছাড়তে-বলে-আরসিবিসি-কর্তৃপক্ষ">চিঠি পাওয়ার পরও অর্থ ছাড়তে বলে আরসিবিসি কর্তৃপক্ষ</a></span></div></li></ul></div><!--end more_hl--></div><!--end cat_summary_block--></div><!--end col-md-4--><div class="col-md-4 col-sm-4"><div class="cat_summary_block"><a href="http://www.ntvbd.com/tech"><div class="cat_summary_title" style="background:#a67d51"><h4>বিজ্ঞান ও প্রযুক্তি</h4><i class="fa_arrbot"><img src="http://www.ntvbd.com/templates/ntv-v1/images/arrow.png" border="0" /></i></div><!--end cat_summary_title--></a><a href="http://www.ntvbd.com/tech/46135/কিশোর-কিশোরীদের-মধ্যে-জনপ্রিয়-স্ন্যাপচ্যাট"><div class="img lazy" style="border-top-color:#a67d51"><img src="//cdn.bn.ntvbd.com/site/photo-1460713759?width=213&height=145" alt="কিশোর-কিশোরীদের মধ্যে জনপ্রিয় স্ন্যাপচ্যাট" title="কিশোর-কিশোরীদের মধ্যে জনপ্রিয় স্ন্যাপচ্যাট" width="100%" /></div><div class="hl"><h4>কিশোর-কিশোরীদের মধ্যে জনপ্রিয় স্ন্যাপচ্যাট</h4></div></a><div class="more_hl"><ul><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/tech/46114/এক-ঘণ্টার-জন্য-টুইটার-অচল">এক ঘণ্টার জন্য টুইটার অচল</a></span></div></li><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/tech/46106/উন্মুক্ত-হলো-এইচটিসি-১০">উন্মুক্ত হলো এইচটিসি ১০</a></span></div></li><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/tech/46075/আবহাওয়ার-পূর্বাভাস-জানাচ্ছে-ফেসবুক">আবহাওয়ার পূর্বাভাস জানাচ্ছে ফেসবুক</a></span></div></li><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/tech/46015/মিয়ানমারে-ভূমিকম্পের-পর-ফেসবুকে-সেফটি-চেক-চালু">মিয়ানমারে ভূমিকম্পের পর ফেসবুকে সেফটি চেক চালু</a></span></div></li></ul></div><!--end more_hl--></div><!--end cat_summary_block--></div><!--end col-md-4--></div><!--end row--><div class="row"><div class="col-md-4 col-sm-4"><div class="cat_summary_block"><a href="http://www.ntvbd.com/lifestyle"><div class="cat_summary_title" style="background:#0f4b91"><h4>জীবনধারা</h4><i class="fa_arrbot"><img src="http://www.ntvbd.com/templates/ntv-v1/images/arrow.png" border="0" /></i></div><!--end cat_summary_title--></a><a href="http://www.ntvbd.com/lifestyle/46145/স্বাস্থ্যকর-জাফরান-পেস্তা-মিল্কশেক"><div class="img lazy" style="border-top-color:#0f4b91"><img src="//cdn.bn.ntvbd.com/site/photo-1460721451?width=213&height=145" alt="স্বাস্থ্যকর জাফরান পেস্তা মিল্কশেক" title="স্বাস্থ্যকর জাফরান পেস্তা মিল্কশেক" width="100%" /></div><div class="hl"><h4>স্বাস্থ্যকর জাফরান পেস্তা মিল্কশেক</h4></div></a><div class="more_hl"><ul><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/lifestyle/46124/ব্রণ-দূর-করে-গ্রিন-টি">ব্রণ দূর করে গ্রিন টি</a></span></div></li><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/lifestyle/46113/ডিমের-ব্যবহারে-মাথায়-গজাবে-নতুন-চুল">ডিমের ব্যবহারে মাথায় গজাবে নতুন চুল!</a></span></div></li><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/lifestyle/46095/কাজে-উৎসাহ-পাবেন-বৃষ-ভ্রমণের-সুযোগ-পেতে-পারেন-সিংহ"><span style="color:#CD0000">রাশিফল&nbsp;:&nbsp;</span>কাজে উৎসাহ পাবেন বৃষ, ভ্রমণের সুযোগ পেতে পারেন সিংহ</a></span></div></li><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/lifestyle/46019/কেমন-যাবে-আপনার-পহেলা-বৈশাখ"><span style="color:#CD0000">রাশিফল&nbsp;:&nbsp;</span>কেমন যাবে আপনার পহেলা বৈশাখ?</a></span></div></li></ul></div><!--end more_hl--></div><!--end cat_summary_block--></div><!--end col-md-4--><div class="col-md-4 col-sm-4"><div class="cat_summary_block"><a href="http://www.ntvbd.com/health"><div class="cat_summary_title" style="background:#e63d2f"><h4>স্বাস্থ্য</h4><i class="fa_arrbot"><img src="http://www.ntvbd.com/templates/ntv-v1/images/arrow.png" border="0" /></i></div><!--end cat_summary_title--></a><a href="http://www.ntvbd.com/health/46126/শরীরের-গাঁট-বা-জয়েন্ট-ভালো-রাখবেন-যেভাবে"><div class="img lazy" style="border-top-color:#e63d2f"><img src="//cdn.bn.ntvbd.com/site/photo-1460707767?width=213&height=145" alt="শরীরের গাঁট বা জয়েন্ট ভালো রাখবেন যেভাবে" title="শরীরের গাঁট বা জয়েন্ট ভালো রাখবেন যেভাবে" width="100%" /></div><div class="hl"><h4>শরীরের গাঁট বা জয়েন্ট ভালো রাখবেন যেভাবে</h4></div></a><div class="more_hl"><ul><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/health/46118/গর্ভাবস্থায়-একলামশিয়া-কতটা-ঝুঁকিপূর্ণ">গর্ভাবস্থায় একলামশিয়া কতটা ঝুঁকিপূর্ণ?</a></span></div></li><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/health/46111/গর্ভকালীন-ডায়াবেটিস-কেন-ঝুঁকিপূর্ণ">গর্ভকালীন ডায়াবেটিস কেন ঝুঁকিপূর্ণ?</a></span></div></li><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/health/46099/সড়ক-দুর্ঘটনা--তাৎক্ষণিকভাবে-কী-করবেন">সড়ক দুর্ঘটনা : তাৎক্ষণিকভাবে কী করবেন</a></span></div></li><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/health/46061/পহেলা-বৈশাখ-কাটুক-সুস্থতায়">পহেলা বৈশাখ কাটুক সুস্থতায়</a></span></div></li></ul></div><!--end more_hl--></div><!--end cat_summary_block--></div><!--end col-md-4--><div class="col-md-4 col-sm-4"><div class="cat_summary_block"><a href="http://www.ntvbd.com/travel"><div class="cat_summary_title" style="background:#7c303f"><h4>ভ্রমণ</h4><i class="fa_arrbot"><img src="http://www.ntvbd.com/templates/ntv-v1/images/arrow.png" border="0" /></i></div><!--end cat_summary_title--></a><a href="http://www.ntvbd.com/travel/45793/পহেলা-বৈশাখে-ঢাকার-কাছাকাছি"><div class="img lazy" style="border-top-color:#7c303f"><img src="//cdn.bn.ntvbd.com/site/photo-1460450133?width=213&height=145" alt="পহেলা বৈশাখে ঢাকার কাছাকাছি" title="পহেলা বৈশাখে ঢাকার কাছাকাছি" width="100%" /></div><div class="hl"><h4>পহেলা বৈশাখে ঢাকার কাছাকাছি</h4></div></a><div class="more_hl"><ul><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/travel/45552/ঘুরে-আসুন-দক্ষিণ-বাংলার-জলের-স্বর্গ-রাজ্যে">ঘুরে আসুন দক্ষিণ বাংলার জলের স্বর্গ রাজ্যে</a></span></div></li><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/travel/45012/নওগাঁয়ের-প্রত্নতাত্ত্বিক-নিদর্শন-সোমপুর-বৌদ্ধ-বিহার">নওগাঁয়ের প্রত্নতাত্ত্বিক নিদর্শন সোমপুর বৌদ্ধ বিহার</a></span></div></li><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/travel/44851/ময়মনসিংহের-পথে-প্রান্তরে">ময়মনসিংহের পথে প্রান্তরে</a></span></div></li><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/travel/44705/মহেড়া-জমিদারবাড়িতে-একদিন">মহেড়া জমিদারবাড়িতে একদিন</a></span></div></li></ul></div><!--end more_hl--></div><!--end cat_summary_block--></div><!--end col-md-4--></div><!--end row--><div class="row"><div class="col-md-4 col-sm-4"><div class="cat_summary_block"><a href="http://www.ntvbd.com/education"><div class="cat_summary_title" style="background:#00a997"><h4>শিক্ষা</h4><i class="fa_arrbot"><img src="http://www.ntvbd.com/templates/ntv-v1/images/arrow.png" border="0" /></i></div><!--end cat_summary_title--></a><a href="http://www.ntvbd.com/bangladesh/46024/সূর্যবরণ-দিয়ে-রাবিতে-পয়লা-বৈশাখ-উদযাপন-শুরু"><div class="img lazy" style="border-top-color:#00a997"><img src="//cdn.bn.ntvbd.com/site/photo-1460603191?width=213&height=145" alt="সূর্যবরণ দিয়ে রাবিতে পয়লা বৈশাখ উদযাপন শুরু" title="সূর্যবরণ দিয়ে রাবিতে পয়লা বৈশাখ উদযাপন শুরু" width="100%" /></div><div class="hl"><h4>সূর্যবরণ দিয়ে রাবিতে পয়লা বৈশাখ উদযাপন শুরু</h4></div></a><div class="more_hl"><ul><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/education/46004/রাবিতে-বৈশাখে-ব্যাগ-যানবাহন-চলাচল-নিষিদ্ধ">রাবিতে বৈশাখে ব্যাগ-যানবাহন চলাচল নিষিদ্ধ</a></span></div></li><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/bangladesh/45974/রাবিতে-৫টার-মধ্যে-অনুষ্ঠান-শেষ-করার-নির্দেশ">রাবিতে ৫টার মধ্যে অনুষ্ঠান শেষ করার নির্দেশ</a></span></div></li><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/education/45951/বর্ষবরণে-শেষ-মুহূর্তে-তুলির-আঁচড়">বর্ষবরণে শেষ মুহূর্তে তুলির আঁচড়</a></span></div></li><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/education/45904/ঢাবিতে-প্রাধ্যক্ষকে-তিন-ঘণ্টা-অবরুদ্ধ-করল-ছাত্রলীগ">ঢাবিতে প্রাধ্যক্ষকে তিন ঘণ্টা অবরুদ্ধ করল ছাত্রলীগ</a></span></div></li></ul></div><!--end more_hl--></div><!--end cat_summary_block--></div><!--end col-md-4--><div class="col-md-4 col-sm-4"><div class="cat_summary_block"><a href="http://www.ntvbd.com/job-circular"><div class="cat_summary_title" style="background:#bd6228"><h4>চাকরি চাই</h4><i class="fa_arrbot"><img src="http://www.ntvbd.com/templates/ntv-v1/images/arrow.png" border="0" /></i></div><!--end cat_summary_title--></a><a href="http://www.ntvbd.com/job-circular/46136/অনভিজ্ঞদের-ক্যারিয়ারের-সুযোগ-দিচ্ছে-সেভ-দ্য-চিলড্রেন-বেতন-২৮-হাজার"><div class="img lazy" style="border-top-color:#bd6228"><img src="//cdn.bn.ntvbd.com/site/photo-1460714089?width=213&height=145" alt="অনভিজ্ঞদের ক্যারিয়ারের সুযোগ দিচ্ছে সেভ দ্য চিলড্রেন, বেতন ২৮ হাজার" title="অনভিজ্ঞদের ক্যারিয়ারের সুযোগ দিচ্ছে সেভ দ্য চিলড্রেন, বেতন ২৮ হাজার" width="100%" /></div><div class="hl"><h4>অনভিজ্ঞদের ক্যারিয়ারের সুযোগ দিচ্ছে সেভ দ্য চিলড্রেন, বেতন ২৮ হাজার</h4></div></a><div class="more_hl"><ul><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/job-circular/46127/গ্রামীণফোন-বাংলালিংকে-চাকরির-সুযোগ">গ্রামীণফোন-বাংলালিংকে চাকরির সুযোগ</a></span></div></li><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/job-circular/45958/বসুন্ধরা-গ্রুপে-বিভিন্ন-পদে--চাকরির-সুযোগ">বসুন্ধরা গ্রুপে বিভিন্ন পদে  চাকরির সুযোগ</a></span></div></li><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/job-circular/45946/আড়ংয়ে-আকর্ষণীয়-চাকরি">আড়ংয়ে আকর্ষণীয় চাকরি</a></span></div></li><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/job-circular/45817/বাংলাদেশে-জনবল-নিয়োগ-দিবে-দুবাইয়ের-মাশরিক-ব্যাংক">বাংলাদেশে জনবল নিয়োগ দিবে দুবাইয়ের মাশরিক ব্যাংক</a></span></div></li></ul></div><!--end more_hl--></div><!--end cat_summary_block--></div><!--end col-md-4--><div class="col-md-4 col-sm-4"><div class="cat_summary_block"><a href="http://www.ntvbd.com/priyo-probashi"><div class="cat_summary_title" style="background:#522773"><h4>প্রিয় প্রবাসী</h4><i class="fa_arrbot"><img src="http://www.ntvbd.com/templates/ntv-v1/images/arrow.png" border="0" /></i></div><!--end cat_summary_title--></a><a href="http://www.ntvbd.com/priyo-probashi/46105/কূটনীতিকদের-নিয়ে-বৈশাখ-উদযাপন-করল-মালয়েশিয়া-দূতাবাস"><div class="img lazy" style="border-top-color:#522773"><img src="//cdn.bn.ntvbd.com/site/photo-1460697726?width=213&height=145" alt="কূটনীতিকদের নিয়ে বৈশাখ উদযাপন করল মালয়েশিয়া দূতাবাস" title="কূটনীতিকদের নিয়ে বৈশাখ উদযাপন করল মালয়েশিয়া দূতাবাস" width="100%" /></div><div class="hl"><h4>কূটনীতিকদের নিয়ে বৈশাখ উদযাপন করল মালয়েশিয়া দূতাবাস</h4></div></a><div class="more_hl"><ul><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/priyo-probashi/45907/কানাডায়-বাংলা-বর্ষবরণ-উৎসব">কানাডায় বাংলা বর্ষবরণ উৎসব</a></span></div></li><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/priyo-probashi/45839/সৌদি-আরবে-বাংলাদেশির-ঝুলন্ত-লাশ-উদ্ধার">সৌদি আরবে বাংলাদেশির ঝুলন্ত লাশ উদ্ধার</a></span></div></li><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/priyo-probashi/45531/বাংলাদেশে-বাঁশ-উৎসব">বাংলাদেশে বাঁশ উৎসব!</a></span></div></li><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/priyo-probashi/45052/যুবদল-কুয়েত-শাখার-উদ্যোগে-মহান-স্বাধীনতা-দিবসে-আলোচনা">যুবদল কুয়েত শাখার উদ্যোগে মহান স্বাধীনতা দিবসে আলোচনা</a></span></div></li></ul></div><!--end more_hl--></div><!--end cat_summary_block--></div><!--end col-md-4--></div><!--end row--><div class="row"><div class="col-md-4 col-sm-4"><div class="cat_summary_block"><a href="http://www.ntvbd.com/opinion"><div class="cat_summary_title" style="background:#472d8c"><h4>মত-দ্বিমত</h4><i class="fa_arrbot"><img src="http://www.ntvbd.com/templates/ntv-v1/images/arrow.png" border="0" /></i></div><!--end cat_summary_title--></a><a href="http://www.ntvbd.com/opinion/46064/বিবর্তনে-কৃষির-বঙ্গাব্দ"><div class="img lazy" style="border-top-color:#472d8c"><img src="//cdn.bn.ntvbd.com/site/photo-1460635388?width=213&height=145" alt="বিবর্তনে কৃষির বঙ্গাব্দ" title="বিবর্তনে কৃষির বঙ্গাব্দ" width="100%" /></div><div class="hl"><h4>বিবর্তনে কৃষির বঙ্গাব্দ</h4></div></a><div class="more_hl"><ul><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/opinion/46039/মার্কিন-প্রেসিডেন্ট-নির্বাচনেও-কারচুপি">মার্কিন প্রেসিডেন্ট নির্বাচনেও কারচুপি!</a></span></div></li><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/opinion/46031/বাংলা-নববর্ষ--অর্থনৈতিক-তাৎপর্য">বাংলা নববর্ষ : অর্থনৈতিক তাৎপর্য</a></span></div></li><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/opinion/46022/পহেলা-বৈশাখ-উদযাপন-প্রসঙ্গে">পহেলা বৈশাখ উদযাপন প্রসঙ্গে</a></span></div></li><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/opinion/45913/অপূর্ণ-হালখাতায়-মুখ-ও-মুখোশ"><span style="color:#CD0000">বৈশাখ ভাবনা&nbsp;:&nbsp;</span>অপূর্ণ হালখাতায় মুখ ও মুখোশ</a></span></div></li></ul></div><!--end more_hl--></div><!--end cat_summary_block--></div><!--end col-md-4--><div class="col-md-4 col-sm-4"><div class="cat_summary_block"><a href="http://www.ntvbd.com/arts-and-literature"><div class="cat_summary_title" style="background:#392f2c"><h4>শিল্প ও সাহিত্য</h4><i class="fa_arrbot"><img src="http://www.ntvbd.com/templates/ntv-v1/images/arrow.png" border="0" /></i></div><!--end cat_summary_title--></a><a href="http://www.ntvbd.com/arts-and-literature/46115/১৬-বছরে-ঐতিহ্য-দুই-সপ্তাহব্যাপী-একক-বইমেলা"><div class="img lazy" style="border-top-color:#392f2c"><img src="//cdn.bn.ntvbd.com/site/photo-1460703840?width=213&height=145" alt="১৬ বছরে ঐতিহ্য, দুই সপ্তাহব্যাপী একক বইমেলা" title="১৬ বছরে ঐতিহ্য, দুই সপ্তাহব্যাপী একক বইমেলা" width="100%" /></div><div class="hl"><h4>১৬ বছরে ঐতিহ্য, দুই সপ্তাহব্যাপী একক বইমেলা</h4></div></a><div class="more_hl"><ul><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/arts-and-literature/46092/চিত্রকলা-পয়লা-বৈশাখ-ও-মঙ্গল-শোভাযাত্রা">চিত্রকলা, পয়লা বৈশাখ ও মঙ্গল শোভাযাত্রা</a></span></div></li><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/arts-and-literature/46052/বৈশাখী-চরণ">বৈশাখী চরণ</a></span></div></li><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/arts-and-literature/46035/চৈত্র-বৈশাখে-আদিবাসী-গ্রামে">চৈত্র-বৈশাখে আদিবাসী গ্রামে</a></span></div></li><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/arts-and-literature/46028/ওবায়েদ-আকাশের-তিনটি-কবিতা">ওবায়েদ আকাশের তিনটি কবিতা</a></span></div></li></ul></div><!--end more_hl--></div><!--end cat_summary_block--></div><!--end col-md-4--><div class="col-md-4 col-sm-4"><div class="cat_summary_block"><a href="http://www.ntvbd.com/kids"><div class="cat_summary_title" style="background:#63a844"><h4>শিশু-কিশোর</h4><i class="fa_arrbot"><img src="http://www.ntvbd.com/templates/ntv-v1/images/arrow.png" border="0" /></i></div><!--end cat_summary_title--></a><a href="http://www.ntvbd.com/kids/46029/নতুন-আলোয়"><div class="img lazy" style="border-top-color:#63a844"><img src="//cdn.bn.ntvbd.com/site/photo-1460606742?width=213&height=145" alt="নতুন আলোয়" title="নতুন আলোয়" width="100%" /></div><div class="hl"><h4>নতুন আলোয়</h4></div></a><div class="more_hl"><ul><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/kids/46021/মেলার-গল্প">মেলার গল্প</a></span></div></li><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/kids/45999/নারীজাতির-সব-চিহ্ন-মুছে-ফেলতে-চাইছিল"><span style="color:#CD0000">আমি মালালা বলছি&nbsp;:&nbsp;</span>নারীজাতির সব চিহ্ন মুছে ফেলতে চাইছিল</a></span></div></li><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/kids/45914/মন-চাইছে"><span style="color:#CD0000">ছড়া&nbsp;:&nbsp;</span>মন চাইছে</a></span></div></li><li><div class="more_hl_list"><span><i class="fa fa-angle-right"></i></span><span><a href="http://www.ntvbd.com/kids/45787/শিশুদের-পরিচালিত-ভিডিও-নিউজ-সার্ভিস-প্রিজম-এর-যাত্রা-শুরু">শিশুদের পরিচালিত ভিডিও নিউজ সার্ভিস ‘প্রিজম’-এর যাত্রা শুরু</a></span></div></li></ul></div><!--end more_hl--></div><!--end cat_summary_block--></div><!--end col-md-4--></div><!--end row--></div>
    
    	    <!--call english_content-->
	    <div id="english_content" class="hidden-xs"><!----------------------------------------------------------------------
| ENGLISH CONTENTS SETUP
----------------------------------------------------------------------->
<div class="english_content_caption eng-font">
    <h4><a href="http://en.ntvbd.com" target="_blank">English</a></h4>
    <a href="https://www.facebook.com/ntvenglish" target="_blank"><span class="icon smallFacebookIcon facebook"></span></a>
    <a href="https://twitter.com/ntvdigitals" target="_blank"><span class="icon smallTwitterIcon twitter"></span></a>
    <a href="http://en.ntvbd.com" target="_blank"><i class="fa fa-angle-down"></i></a>
</div><!--end english_content_caption-->

<div id="just_now_eng_content"></div><!--end just_now_eng_content-->

<div class="row"><div class="col-md-4 col-sm-4"><div class="english_content_block eng-font"><ul><li><div class="img pull-left"><img src="//cdn.en.ntvbd.com/site/photo-1460721005?width=87&height=58" width="100%" title="Lack of coordination hits Solar Home System programme hard" alt="Lack of coordination hits Solar Home System programme hard" border="0" /></div><div class="hl"><h4><a href="http://www.en.ntvbd.com/bangladesh/20887/Lack-of-coordination-hits-Solar-Home-System-programme-hard" target="_blank">Lack of coordination hits Solar Home System programme hard</a></h4></div><div class="clr"></div></li><li><div class="hl more_hl"><span><i class="fa fa-angle-right"></i></span><span><h5><a href="http://www.en.ntvbd.com/business/20885/Next-budget-size-likely-to-be-Tk-340006-crore:-report" target="_blank">Next budget size likely to be Tk 3,40,006 crore: report</a></h5></span></div><!--end hl--></li><li><div class="hl more_hl"><span><i class="fa fa-angle-right"></i></span><span><h5><a href="http://www.en.ntvbd.com/bangladesh/20883/Rushanara-Ali-made-Bangladesh-trade-envoy" target="_blank">Rushanara Ali made Bangladesh trade envoy</a></h5></span></div><!--end hl--></li><li><div class="hl more_hl"><span><i class="fa fa-angle-right"></i></span><span><h5><a href="http://www.en.ntvbd.com/bangladesh/20884/Housewife-‘tortured-to-death’-in-Gazipur" target="_blank">Housewife ‘tortured to death’ in Gazipur</a></h5></span></div><!--end hl--></li></ul></div><!--end english_content_block--></div><!--end col-md-4--><div class="col-md-4 col-sm-4"><div class="english_content_block eng-font"><ul><li><div class="img pull-left"><img src="//cdn.en.ntvbd.com/site/photo-1460705235?width=87&height=58" width="100%" title="Users urged to uninstall QuickTime for Windows" alt="Users urged to uninstall QuickTime for Windows" border="0" /></div><div class="hl"><h4><a href="http://www.en.ntvbd.com/sci-tech/20877/Users-urged-to-uninstall-QuickTime-for-Windows" target="_blank">Users urged to uninstall QuickTime for Windows</a></h4></div><div class="clr"></div></li><li><div class="hl more_hl"><span><i class="fa fa-angle-right"></i></span><span><h5><a href="http://www.en.ntvbd.com/world/20874/UN-chief-candidates-pressed-on-how-to-tackle-global-challenges" target="_blank">UN chief candidates pressed on how to tackle global challenges</a></h5></span></div><!--end hl--></li><li><div class="hl more_hl"><span><i class="fa fa-angle-right"></i></span><span><h5><a href="http://www.en.ntvbd.com/life/20873/The-sky’s-the-limit-at-Geneva-inventions-show" target="_blank">The sky’s the limit at Geneva inventions show</a></h5></span></div><!--end hl--></li><li><div class="hl more_hl"><span><i class="fa fa-angle-right"></i></span><span><h5><a href="http://www.en.ntvbd.com/art-culture/20870/Mysterious-Italian-novelist-could-become-first-ever-anonymous-Booker-winner" target="_blank">Mysterious Italian novelist could become first-ever anonymous Booker winner</a></h5></span></div><!--end hl--></li></ul></div><!--end english_content_block--></div><!--end col-md-4--><div class="col-md-4 col-sm-4"><div class="english_content_block eng-font"><ul><li><div class="img pull-left"><img src="//cdn.en.ntvbd.com/site/photo-1460647016?width=87&height=58" width="100%" title="France’s richest man hits back at feelgood cinema hit" alt="France’s richest man hits back at feelgood cinema hit" border="0" /></div><div class="hl"><h4><a href="http://www.en.ntvbd.com/entertainment/20851/France’s-richest-man-hits-back-at-feelgood-cinema-hit" target="_blank">France’s richest man hits back at feelgood cinema hit</a></h4></div><div class="clr"></div></li><li><div class="hl more_hl"><span><i class="fa fa-angle-right"></i></span><span><h5><a href="http://www.en.ntvbd.com/entertainment/20831/Cannes-film-festival-line-up" target="_blank">Cannes film festival line-up</a></h5></span></div><!--end hl--></li><li><div class="hl more_hl"><span><i class="fa fa-angle-right"></i></span><span><h5><a href="http://www.en.ntvbd.com/entertainment/20785/Shankhachil-to-hit-cinemas-today" target="_blank">Shankhachil to hit cinemas today</a></h5></span></div><!--end hl--></li><li><div class="hl more_hl"><span><i class="fa fa-angle-right"></i></span><span><h5><a href="http://www.en.ntvbd.com/entertainment/20775/Ben-Affleck-to-direct-star-in-standalone-Batman-movie" target="_blank">Ben Affleck to direct, star in standalone Batman movie</a></h5></span></div><!--end hl--></li></ul></div><!--end english_content_block--></div><!--end col-md-4--></div><!--end row-->
</div>
        
    <!--call photo_content-->
    <div id="photo_content"><!----------------------------------------------------------------------
| PHOTO CONTENTS SETUP
----------------------------------------------------------------------->
<style>
.pre_btn, .nxt_btn{ cursor:pointer}
</style>
<div class="photo_content_caption">
    <h4><a href="http://photo.ntvbd.com" target="_blank">ছবি</a></h4>
    <a href="https://www.facebook.com/ntvphoto" target="_blank"><span class="icon smallFacebookIcon facebook"></span></a>
    <a href="https://twitter.com/ntvdigitals" target="_blank"><span class="icon smallTwitterIcon twitter"></span></a>
    <a href="http://www.pinterest.com/ntvdigital" target="_blank"><span class="icon smallPinIcon pinterest"></span></a>
    <a href="http://photo.ntvbd.com" target="_blank"><i class="fa fa-angle-down"></i></a>
</div>
<div class="row">
		<div class="col-md-6 col-sm-6">
		<div class="photo_slider_block">
			<div class="img">
				<label>ছবিতে আজ</label>
				<a><img src="//cdn.bn.ntvbd.com/photo/1460687265?width=300&height=210" width="100%" title="" alt="" border="0" />
                </a>
                <a style="display:none"><img src="//cdn.bn.ntvbd.com/photo/1460687294?width=300&height=210" width="100%" title="" alt="" border="0" />
                </a>
                <i class="pre_btn fa fa-angle-left"></i>
                <i class="nxt_btn fa fa-angle-right"></i>
			</div>
            <div class="album_title"><h4><a href="http://photo.ntvbd.com/diner-sobi/15-april-2016/1460687294.ntv">১৫ এপ্রিল ২০১৬</a></h4></div>
		</div>
	</div>
    
    	<div class="col-md-6 col-sm-6">
		<div class="lead_photo_album">
			<div class="img">
				<i class="fa fa-camera"></i>
				<a href="http://photo.ntvbd.com/international/event/baishakh-celebration-at-malaysia-embassy/1460710916.ntv"><img src="//cdn.bn.ntvbd.com/photo/1460710744?width=300&height=210" width="100%" title="" alt="" border="0" />
                </a>
			</div>
			<div class="album_title"><h4><a href="http://photo.ntvbd.com/international/event/baishakh-celebration-at-malaysia-embassy/1460710916.ntv"><span class="preFix"></span>মালয়েশিয়া দূতাবাসের বৈশাখ উদযাপন</a></h4></div>
		</div>
	</div>
<div class="clr"></div><div class="col-xs-6 col-md-3 col-sm-3"><div class="more_photo_album_block"><div class="img"><i class="fa fa-camera"></i><a href="http://photo.ntvbd.com/bangladesh/others/eagle-and-mamun/1460641712.ntv"><img src="//cdn.bn.ntvbd.com/photo/1460641728?width=134&height=94" width="100%" title="" alt="" border="0" /></a></div><div class="album_title"><h5><a href="http://photo.ntvbd.com/bangladesh/others/eagle-and-mamun/1460641712.ntv"><span class="preFix"></span>ঈগল ও মামুন</a></h5></div></div></div><div class="col-xs-6 col-md-3 col-sm-3"><div class="more_photo_album_block"><div class="img"><i class="fa fa-camera"></i><a href="http://photo.ntvbd.com/bangladesh/events/bannya-at-new-year-celebration/1460629578.ntv"><img src="//cdn.bn.ntvbd.com/photo/1460629499?width=134&height=94" width="100%" title="" alt="" border="0" /></a></div><div class="album_title"><h5><a href="http://photo.ntvbd.com/bangladesh/events/bannya-at-new-year-celebration/1460629578.ntv"><span class="preFix"></span>নববর্ষ বরণে বন্যা ও তাঁর দল</a></h5></div></div></div><div class="col-xs-6 col-md-3 col-sm-3"><div class="more_photo_album_block"><div class="img"><i class="fa fa-camera"></i><a href="http://photo.ntvbd.com/bangladesh/others/blissful-mangal-shobhayatra/1460616563.ntv"><img src="//cdn.bn.ntvbd.com/photo/1460616490?width=134&height=94" width="100%" title="" alt="" border="0" /></a></div><div class="album_title"><h5><a href="http://photo.ntvbd.com/bangladesh/others/blissful-mangal-shobhayatra/1460616563.ntv"><span class="preFix"></span>মঙ্গলময় মঙ্গলশোভাযাত্রা</a></h5></div></div></div><div class="col-xs-6 col-md-3 col-sm-3"><div class="more_photo_album_block"><div class="img"><i class="fa fa-camera"></i><a href="http://photo.ntvbd.com/cartoon/event/sumons-cartoon/1460616254.ntv"><img src="//cdn.bn.ntvbd.com/photo/1460608741?width=134&height=94" width="100%" title="" alt="" border="0" /></a></div><div class="album_title"><h5><a href="http://photo.ntvbd.com/cartoon/event/sumons-cartoon/1460616254.ntv"><span class="preFix"></span>সুমনের কার্টুন</a></h5></div></div></div><div class="col-xs-6 col-md-3 col-sm-3"><div class="more_photo_album_block"><div class="img"><i class="fa fa-camera"></i><a href="http://photo.ntvbd.com/bangladesh/others/last-sun-set-of-year/1460571277.ntv"><img src="//cdn.bn.ntvbd.com/photo/1460571170?width=134&height=94" width="100%" title="" alt="" border="0" /></a></div><div class="album_title"><h5><a href="http://photo.ntvbd.com/bangladesh/others/last-sun-set-of-year/1460571277.ntv"><span class="preFix"></span>বছরের শেষ সূর্যাস্ত</a></h5></div></div></div><div class="col-xs-6 col-md-3 col-sm-3"><div class="more_photo_album_block"><div class="img"><i class="fa fa-camera"></i><a href="http://photo.ntvbd.com/bangladesh/others/kite-festival-in-du/1460566882.ntv"><img src="//cdn.bn.ntvbd.com/photo/1460566810?width=134&height=94" width="100%" title="" alt="" border="0" /></a></div><div class="album_title"><h5><a href="http://photo.ntvbd.com/bangladesh/others/kite-festival-in-du/1460566882.ntv"><span class="preFix"></span>ঢাবিতে ঘুড়ি উৎসব</a></h5></div></div></div><div class="col-xs-6 col-md-3 col-sm-3"><div class="more_photo_album_block"><div class="img"><i class="fa fa-camera"></i><a href="http://photo.ntvbd.com/bangladesh/news/eviction-drive-at-kakrail/1460552134.ntv"><img src="//cdn.bn.ntvbd.com/photo/1460552072?width=134&height=94" width="100%" title="" alt="" border="0" /></a></div><div class="album_title"><h5><a href="http://photo.ntvbd.com/bangladesh/news/eviction-drive-at-kakrail/1460552134.ntv"><span class="preFix"></span>কাকরাইলে উচ্ছেদ অভিযান</a></h5></div></div></div><div class="col-xs-6 col-md-3 col-sm-3"><div class="more_photo_album_block"><div class="img"><i class="fa fa-camera"></i><a href="http://photo.ntvbd.com/international/personality/kate-middleton/prince-william-and-catherine-visits-national-park-of-assam/1460535125.ntv"><img src="//cdn.bn.ntvbd.com/photo/1460535065?width=134&height=94" width="100%" title="" alt="" border="0" /></a></div><div class="album_title"><h5><a href="http://photo.ntvbd.com/international/personality/kate-middleton/prince-william-and-catherine-visits-national-park-of-assam/1460535125.ntv"><span class="preFix"></span>আসামের পার্কে উইলিয়াম-কেট</a></h5></div></div></div></div>
</div>                
</div><!--end left_content-->
    
<div class="right_content"><div class="adsSpace300x250" style="margin-top: 10px">
	<!-- Ntv_home_300x250_300x250_300x250_R1 -->
<div id='div-gpt-ad-1422078900996-0' style='width:300px; height:250px;'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1422078900996-0'); });
</script>
</div>
<div class="adsCap">Advertisement</div>
	</div><!--end adsSpace300x250-->

	<!--call most_view_tab-->
	<div><!--MOST VIEWED TAB BLOCK SECTION-->
<div class="most_view_tab_block">
	<div class="btn-group btn-group-justified first-layer">
        <div class="btn-group">
        	<button type="button" class="btn btn-default most_clicks active">সর্বাধিক ক্লিক</button>
        </div>
        <div class="btn-group">
        	<button type="button" class="btn btn-default most_comments">সর্বাধিক মন্তব্য</button>
        </div>        
    </div>
    <div class="btn-group btn-group-justified second-layer">
        <div class="btn-group">
        	<button type="button" class="news active btn btn-default">খবর</button>
        </div>
        <div class="btn-group">
        	<button type="button" class="videos btn btn-default">ভিডিও</button>
        </div>
        <div class="btn-group">
        	<button type="button" class="photos btn btn-default">ছবি</button>
        </div>
    </div>
    <div class="btn-group btn-group-justified third-layer">
        <div class="btn-group">
        	<button type="button" class="todays active btn btn-default">আজ</button>
        </div>
        <div class="btn-group">
        	<button type="button" class="one_month btn btn-default">১ মাস</button>
        </div>
        <div class="btn-group">
        	<button type="button" class="three_month btn btn-default">৩ মাস</button>
        </div>
    </div>
    
    <!--MOST VIEWED CONTENT BLOCK SECTION-->
    <div class="most_viewed_display_block"></div>
</div><!--end most_view_tab_block-->
</div>

<!--<div class="space"></div>-->
<div class="adsSpace300x250"><!-- Ntv_home_300x250_300x250_300x250_R2 -->
<div id='div-gpt-ad-1422078900996-1' style='width:300px; height:250px;'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1422078900996-1'); });
</script>
</div>
<div class="adsCap">Advertisement</div>
</div><!--end adsSpace300x250-->
<!--<div class="space"></div>-->
<!-- Cricket Poll -->
<!--
	<div id="cricket_poll">
		<h3>খেলাধুলা জরিপ</h3>
		<a href="http://www.ntvbd.com/cricketpoll" target="_blank"><img src="http://ntv-bn-cdn.s3.amazonaws.com/images/bangla-aus.jpg" /></a>
		<form>
			<div class="simple_poll" style="height:110px"><div class="" style="padding:15px">আজকের বাংলাদেশ-অস্ট্রেলিয়া ম্যাচে কে জিতবে?</div>
				<div class="poll_result"></div><div class="poll_options"><span><input type="radio" name="cricket_poll_ans" value="0">&nbsp;বাংলাদেশ</span><span><input type="radio" name="cricket_poll_ans" value="1">&nbsp; অস্ট্রেলিয়া</span><span><button type="button" class="btn btn-default cricket_poll">ভোট দিন</button></span></div><div class="err_msg"></div>
				<div style="clear:both;"></div>
			</div>
			<div class="polling_res_summary">
			<div class="row">
				<div class="current_vote" style="margin:5px 20px">ভোটদাতা <span class="recent_vote" >০</span> জন</div>								
			</div>
			</div>
        </form>	
	<style>
		#cricket_poll{
			background:#FFF;
			margin-top:15px;
		}
		#cricket_poll h3{
			padding:4px;
			background:green !important;
			color:#FFF;
			margin:0;
			font-size:18px;
		}	
		#cricket_poll .poll_options{
			padding: 0 15px;
		}
	</style>
	<script type="text/javascript">
		$(function(){
			$('.cricket_poll').on('click',function(){
				 var vote_index = $('input[name=cricket_poll_ans]:checked').val();
				if(vote_index>=0){
					if($('input[name=cricket_poll_ans]').prop('checked'))
						myoption=1;
					else
						myoption=2;
					$.ajax({
						url:'http://www.ntvbd.com/pollProcessing.php',
						type:'post',
						data:{action:'update',myoption:myoption, id:9},
						success:function(res){	
							if(res=='alreadydone'){
								alert('আপনি এর আগেও একবার ভোট দিয়েছেন, তাই এই ভোটটি গৃহীত হলো না।');
							}else{
								$('.recent_vote').html(res);
								window.location='http://www.ntvbd.com/cricketpoll';
							}
						}
					});
				}else{
					alert('অনুগ্রহ করে আপনার পছন্দ নির্বাচন করুন।');
				}
			});
			$.ajax({
				url:'http://www.ntvbd.com/pollProcessing.php',
				type:'post',
				data:{action:'get',id:9},
				success:function(res){						
					$('.recent_vote').html(res);
				}
			});
		});
	</script>
	</div>-->
	<!-- Cricket Poll -->
<!--call polling-->
<div>    <!--POLLING BLOCK SECTION-->
    <div class="polling_block">
        <div class="polling_caption">
            <div class="pull-left img"><img src="http://www.ntvbd.com/templates/ntv-v1/images/main-logo.png" width="100%" height="100%" title="" alt="" border="0" /></div>
            <div class="pull-left"><h4>অনলাইন জরিপ</h4></div>
            <div class="clr"></div>
        </div><!--end polling_caption-->
        <form id="poll_form" action="http://www.ntvbd.com/opinion-poll/home/440/‘আইনশৃঙ্খলা বাহিনীকে নিয়ন্ত্রণে ব্যর্থ বাংলাদেশ’- মার্কিন পররাষ্ট্র দপ্তরের এ প্রতিবেদনের সঙ্গে আপনি কি একমত?" method="post">
			<div class="simple_poll"><div class="poll_ques">‘আইনশৃঙ্খলা বাহিনীকে নিয়ন্ত্রণে ব্যর্থ বাংলাদেশ’- মার্কিন পররাষ্ট্র দপ্তরের এ প্রতিবেদনের সঙ্গে আপনি কি একমত?</div><div class="poll_result" ></div><div class="poll_options"><span><input type="radio" name="poll_ans" value="0" />&nbsp;হ্যাঁ</span><span><input type="radio" name="poll_ans" value="1" />&nbsp; না</span><span><input type="radio" name="poll_ans" value="2" />&nbsp; মন্তব্য নেই</span><span><button type="button" class="poll_submit btn btn-default">ভোট দিন</button></span><!--end submit_btn--></div><!--end poll_options--><div class="err_msg"></div></div><!--end simple_poll--><div class="polling_res_summary">
    <div class="row">
        <div class="col-md-7  col-sm-7">ভোটদাতা <span>১১৮৯</span> জন</div>
								<div class="col-md-5  col-sm-5 related_news"><a href="http://www.ntvbd.com/world/46044/আইনশৃঙ্খলা-বাহিনীকে-নিয়ন্ত্রণে-ব্যর্থ-বাংলাদেশ--যুক্তরাষ্ট্র" class="btn btn-default" target="_blank">সংশ্লিষ্ট খবর </a></div>
		            </div><!--end row-->
</div><!--end polling_options-->
<style>
.related_news a{
	padding:2px 15px;
	margin-right:10px;	
	background:#dfdfde;
}
.related_news a:hover{
	background:#898989;
	color:#FFF !important;
}
</style>
        </form>
    </div><!--end polling_block-->
</div>

	<!--<div class="space"></div>
    <a href="http://www.ntvbd.com/contest/womansworld-eid-quiz" target="_blank"><img src="http://ntv-bn-cdn.s3.amazonaws.com/images/temp/320x100-rupchorcha-ad.jpg" /></a>-->
<!--<div class="space"></div>
<div>
	<a href="http://www.ntvbd.com/challenge-with-colors/" target="_blank" ><img src="http://ntv-bn-cdn.s3.amazonaws.com/images/300x120-challenge-with-colors.jpg" alt="challengequizad" title="challengequizad" /></a>
</div>--><!--end adsSpace300x250-->
<div class="space"></div>
<div>
	<a href="http://wwbmc.com/" target="_blank"><img src="http://ntv-bn-cdn.s3.amazonaws.com/images/aus-new-campaign.gif" alt="Australia Campaign" title="Australia Campaign" /></a>
</div>

<!--call users_points_table-->
<div>
	<div class="users_point_table_block" style="background: none repeat scroll 0 0 #fff; border: 1px solid #ccc; margin-top: 10px; padding: 10px; position: relative">
		<div class="table_caption">
			<div class="pull-left img"><img src="http://www.ntvbd.com/templates/ntv-v1/images/main-logo.png" width="100%" height="100%" title="" alt="" border="0" /></div>
			<div class="pull-left"><h4>পয়েন্টস</h4></div>
			<div class="clr"></div>
		</div>
		<style>
			.pointsTabel{ font-family:Segoe, "Segoe UI", "DejaVu Sans", "Trebuchet MS", Verdana, sans-serif; font-size:12px; width: 100%}
			.pointsTabel td{ border-top:2px solid #FFF; background:#F1F0F0; border-bottom:1px solid #DFDFDE; padding:3px; height:57px}
			.pointsTabel .userName{ font-size:12px}
			.pointsTabel .points{ font-size:10px;}
			.pointsTabel .you td{ background:#ffd964}
			.pointsTabel tr td:last-child{ padding-right:0px}
			.pointsTabel td .sl{ color:#838484; font-size:12px; padding:2px}

			.users_point_table_block .tabview{}
			.users_point_table_block .tabname{ border-bottom:2px solid #dedede; height:30px; margin:0px 0px 10px 0px}
			.users_point_table_block .tabname div{ width:25%; float:left; text-align:center; font-size:15px; padding:5px 0px 5px 0px; cursor:pointer; background:#FFF; color:#444}
			.users_point_table_block .tabname .tabactive{ background:#dedede; color:#016938 !important}
			.users_point_table_block .tabcontent{ background:#FFF;}
			.users_point_table_block .tabcontent .content{ display:none;}
		</style>
		<script>
			$(document).ready(function(e) {
				/*Tab Name*/
				$('.tabview .tabcontent div:nth-child(1)').slideDown();
				$('.tabname div').click(function(){
					var parent = $('.tabname').parent('.tabview');
					parent.find('.tabname div').removeClass('tabactive');
					var index = $(this).index()+1;
					parent.find('.tabname div:nth-child('+index+')').addClass('tabactive');
					parent.find('.tabcontent .content').slideUp();
					parent.find('.tabcontent .content:nth-child('+index+')').slideDown();
				});
				/*Tab Name*/
			});
		</script>
				<div class="tabview">
			<div class="tabname">
				<div class="backgroundtheme tabactive">
					আজ
				</div>
				<div class="backgroundtheme">
					১ মাস
				</div>
				<div class="backgroundtheme">
					৩ মাস
				</div>
				<div class="backgroundtheme">
					৬ মাস
				</div>
			</div>
			<div style="text-align:center">
	<a href="http://www.ntvbd.com/info/point-information">
	<img src="http://ntv-bn-cdn.s3.amazonaws.com/images/cox-today-logo.png" style="width:60%;position:absolute;float:left;">
	<img src="http://ntv-bn-cdn.s3.amazonaws.com/images/COXS-TODAY-Home.jpg" width="278" />
	<p style="background-color:#9287be;color:#fff">পয়েন্টস জিতুন, হোটেল দ্য কক্স টুডে-তে দুই রাত তিন দিন থাকুন</p></a>
	</div>
			<div class="clear"></div>
			<div class="tabcontent">
				<div class="content">
					<table cellpadding="0" cellspacing="0" class="pointsTabel"></table>				</div>
				<div class="content">
					<table cellpadding="0" cellspacing="0" class="pointsTabel"><tr class=""><td class="sl">১</td><td><img src="//graph.facebook.com/10153662555868893/picture" width="36" /></td><td><span class="userName"><a href="http://www.ntvbd.com/user-profile/?id=28550" target="_blank">Kamruzzaman Kajal</a></span><br ><span class="points">পয়েন্টস: 277780</span></td><td><img src="http://ntv-bn-cdn.s3.amazonaws.com/images/points/user-photo.png" /></td><td><img src="http://ntv-bn-cdn.s3.amazonaws.com/images/points/iron.png" /></td></tr><tr class=""><td class="sl">২</td><td><img src="http://ntv-bn-cdn.s3.amazonaws.com/cj_photo/cj_photo-28570.jpg" width="36" /></td><td><span class="userName"><a href="http://www.ntvbd.com/user-profile/?id=28570" target="_blank">riyad</a></span><br ><span class="points">পয়েন্টস: 207120</span></td><td><img src="http://ntv-bn-cdn.s3.amazonaws.com/images/points/user-photo.png" /></td><td><img src="http://ntv-bn-cdn.s3.amazonaws.com/images/points/iron.png" /></td></tr><tr class=""><td class="sl">৩</td><td><img src="//graph.facebook.com/138452429884656/picture" width="36" /></td><td><span class="userName"><a href="http://www.ntvbd.com/user-profile/?id=28950" target="_blank">Rakibul Islam</a></span><br ><span class="points">পয়েন্টস: 127140</span></td><td><img src="http://ntv-bn-cdn.s3.amazonaws.com/images/points/user-photo.png" /></td><td><img src="http://ntv-bn-cdn.s3.amazonaws.com/images/points/member.png" /></td></tr><tr class=""><td class="sl">৪</td><td><img src="//graph.facebook.com/486946208167801/picture" width="36" /></td><td><span class="userName"><a href="http://www.ntvbd.com/user-profile/?id=28593" target="_blank">Imrul Hasan</a></span><br ><span class="points">পয়েন্টস: 117340</span></td><td><img src="http://ntv-bn-cdn.s3.amazonaws.com/images/points/user-photo.png" /></td><td><img src="http://ntv-bn-cdn.s3.amazonaws.com/images/points/member.png" /></td></tr><tr class=""><td class="sl">৫</td><td><img src="https://lh4.googleusercontent.com/-CylsEWyKWw0/AAAAAAAAAAI/AAAAAAAAABM/7u4zD3XPFgk/photo.jpg" width="36" /></td><td><span class="userName"><a href="http://www.ntvbd.com/user-profile/?id=1458" target="_blank">Saifur Rahman Sunny</a></span><br ><span class="points">পয়েন্টস: 82120</span></td><td><img src="http://ntv-bn-cdn.s3.amazonaws.com/images/points/user-social.png" /></td><td><img src="http://ntv-bn-cdn.s3.amazonaws.com/images/points/member.png" /></td></tr></table>				</div>
				<div class="content">
					<table cellpadding="0" cellspacing="0" class="pointsTabel"><tr class=""><td class="sl">১</td><td><img src="https://lh4.googleusercontent.com/-CylsEWyKWw0/AAAAAAAAAAI/AAAAAAAAABM/7u4zD3XPFgk/photo.jpg" width="36" /></td><td><span class="userName"><a href="http://www.ntvbd.com/user-profile/?id=1458" target="_blank">Saifur Rahman Sunny</a></span><br ><span class="points">পয়েন্টস: 1722330</span></td><td><img src="http://ntv-bn-cdn.s3.amazonaws.com/images/points/user-social.png" /></td><td><img src="http://ntv-bn-cdn.s3.amazonaws.com/images/points/platinum.png" /></td></tr><tr class=""><td class="sl">২</td><td><img src="https://lh4.googleusercontent.com/-F6ggRTsNPao/AAAAAAAAAAI/AAAAAAAAARc/lr6rEALwBE8/photo.jpg" width="36" /></td><td><span class="userName"><a href="http://www.ntvbd.com/user-profile/?id=6846" target="_blank">sujon khan</a></span><br ><span class="points">পয়েন্টস: 1324810</span></td><td><img src="http://ntv-bn-cdn.s3.amazonaws.com/images/points/user-social.png" /></td><td><img src="http://ntv-bn-cdn.s3.amazonaws.com/images/points/gold.png" /></td></tr><tr class=""><td class="sl">৩</td><td><img src="//graph.facebook.com/10153662555868893/picture" width="36" /></td><td><span class="userName"><a href="http://www.ntvbd.com/user-profile/?id=28550" target="_blank">Kamruzzaman Kajal</a></span><br ><span class="points">পয়েন্টস: 295320</span></td><td><img src="http://ntv-bn-cdn.s3.amazonaws.com/images/points/user-photo.png" /></td><td><img src="http://ntv-bn-cdn.s3.amazonaws.com/images/points/iron.png" /></td></tr><tr class=""><td class="sl">৪</td><td><img src="https://lh6.googleusercontent.com/-oT3XGGGtqB8/AAAAAAAAAAI/AAAAAAAAAHw/u9cQ61J4SKY/photo.jpg" width="36" /></td><td><span class="userName"><a href="http://www.ntvbd.com/user-profile/?id=6620" target="_blank">Sheikh Azizur Rahman</a></span><br ><span class="points">পয়েন্টস: 286720</span></td><td><img src="http://ntv-bn-cdn.s3.amazonaws.com/images/points/user-social.png" /></td><td><img src="http://ntv-bn-cdn.s3.amazonaws.com/images/points/iron.png" /></td></tr><tr class=""><td class="sl">৫</td><td><img src="https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg" width="36" /></td><td><span class="userName"><a href="http://www.ntvbd.com/user-profile/?id=7152" target="_blank">rabiul hoq</a></span><br ><span class="points">পয়েন্টস: 240380</span></td><td><img src="http://ntv-bn-cdn.s3.amazonaws.com/images/points/user-photo.png" /></td><td><img src="http://ntv-bn-cdn.s3.amazonaws.com/images/points/iron.png" /></td></tr></table>				</div>
				<div class="content">
					<table cellpadding="0" cellspacing="0" class="pointsTabel"><tr class=""><td class="sl">১</td><td><img src="https://lh4.googleusercontent.com/-CylsEWyKWw0/AAAAAAAAAAI/AAAAAAAAABM/7u4zD3XPFgk/photo.jpg" width="36" /></td><td><span class="userName"><a href="http://www.ntvbd.com/user-profile/?id=1458" target="_blank">Saifur Rahman Sunny</a></span><br ><span class="points">পয়েন্টস: 1722330</span></td><td><img src="http://ntv-bn-cdn.s3.amazonaws.com/images/points/user-social.png" /></td><td><img src="http://ntv-bn-cdn.s3.amazonaws.com/images/points/platinum.png" /></td></tr><tr class=""><td class="sl">২</td><td><img src="https://lh4.googleusercontent.com/-F6ggRTsNPao/AAAAAAAAAAI/AAAAAAAAARc/lr6rEALwBE8/photo.jpg" width="36" /></td><td><span class="userName"><a href="http://www.ntvbd.com/user-profile/?id=6846" target="_blank">sujon khan</a></span><br ><span class="points">পয়েন্টস: 1324810</span></td><td><img src="http://ntv-bn-cdn.s3.amazonaws.com/images/points/user-social.png" /></td><td><img src="http://ntv-bn-cdn.s3.amazonaws.com/images/points/gold.png" /></td></tr><tr class=""><td class="sl">৩</td><td><img src="//graph.facebook.com/10153662555868893/picture" width="36" /></td><td><span class="userName"><a href="http://www.ntvbd.com/user-profile/?id=28550" target="_blank">Kamruzzaman Kajal</a></span><br ><span class="points">পয়েন্টস: 295320</span></td><td><img src="http://ntv-bn-cdn.s3.amazonaws.com/images/points/user-photo.png" /></td><td><img src="http://ntv-bn-cdn.s3.amazonaws.com/images/points/iron.png" /></td></tr><tr class=""><td class="sl">৪</td><td><img src="https://lh6.googleusercontent.com/-oT3XGGGtqB8/AAAAAAAAAAI/AAAAAAAAAHw/u9cQ61J4SKY/photo.jpg" width="36" /></td><td><span class="userName"><a href="http://www.ntvbd.com/user-profile/?id=6620" target="_blank">Sheikh Azizur Rahman</a></span><br ><span class="points">পয়েন্টস: 286720</span></td><td><img src="http://ntv-bn-cdn.s3.amazonaws.com/images/points/user-social.png" /></td><td><img src="http://ntv-bn-cdn.s3.amazonaws.com/images/points/iron.png" /></td></tr><tr class=""><td class="sl">৫</td><td><img src="https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg" width="36" /></td><td><span class="userName"><a href="http://www.ntvbd.com/user-profile/?id=7152" target="_blank">rabiul hoq</a></span><br ><span class="points">পয়েন্টস: 240380</span></td><td><img src="http://ntv-bn-cdn.s3.amazonaws.com/images/points/user-photo.png" /></td><td><img src="http://ntv-bn-cdn.s3.amazonaws.com/images/points/iron.png" /></td></tr></table>				</div>
			</div>
		</div>
		<div style="background:#FFF; padding:2px; font-size:14px" align="center"><a href="http://www.ntvbd.com/info/point-information" target="_blank" style="color:#000">এনটিভি পয়েন্টস ও পুরস্কার জেতার নিয়ম</a></div>
		<div style="background:#FFF; padding:2px; font-size:14px" align="center"><a href="http://www.ntvbd.com/info/point-information" target="_blank" style="color:#000">মার্চ মাসে বিজয়ী হলেন যারা</a></div>
	</div>
</div>
<div class="adsSpace300x250"><!-- /23635548/Ntv_home_300x250_R3 -->
<!-- /23635548/Ntv_home_300x250_R3 -->
<div id='div-gpt-ad-1450684008830-1' style='height:250px; width:300px;'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1450684008830-1'); });
</script>
</div>
<div class="adsCap">Advertisement</div>
</div><!--end adsSpace300x250-->

	<div class="space"></div>
	<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:like-box href="https://www.facebook.com/ntvdigital" width="300" height="300" show_faces="true" border_color="#fff" style="background:#fff; text-align:left" stream="false" header="false"></fb:like-box>
<!--
<style>
.artculture_banner{max-width:300px;height:250px;background-image:url("http://ntv-bn-cdn.s3.amazonaws.com/images/art-culture-banner.jpg");position:relative}
.artculture_banner ul {
    list-style: none; /* Remove list bullets */
    padding: 0;
    margin: 0;
	position:absolute;
	bottom:10px;
	width:100%;
	margin:0;
}
.artculture_banner ul li {
	padding:5px;
}
.artculture_banner .first_li{background-color:#b90b00;width:280px;text-align:center;margin-bottom: 4px;margin-left: 9px;}
.artculture_banner .first_li:hover{background-color:#fe5421;width:280px;text-align:center;margin-bottom: 4px;margin-left: 9px;}
.artculture_banner .second_li{background-color:#eb0f01;width:280px;text-align:center;margin-bottom: 4px;margin-left: 9px;}
.artculture_banner .second_li:hover{background-color:#7b0700;width:280px;text-align:center;margin-bottom: 4px;margin-left: 9px;}
.artculture_banner .third_li{background-color:#fe5421;width:280px;text-align:center;margin-left: 9px;}
.artculture_banner .third_li:hover{background-color:#cf0d01;width:280px;text-align:center;margin-left: 9px;}
.artculture_banner .hoverDiv{background-color:transparent;width:300px;height:135px;cursor: pointer;z-index:999}
</style>
<div class="space"></div>
<div class="artculture_banner">
<div class="hoverDiv" onclick="window.open('http://www.ntvbd.com/arts-and-literature','_blank');"></div>
<ul>
<li class="first_li"><a href="http://www.ntvbd.com/arts-and-literature/book-fair" target="_blank" style="color:#fff">বইমেলা</a></li>
<li class="second_li"><a href="http://www.ntvbd.com/arts-and-literature/book-review" target="_blank" style="color:#fff">গ্রন্থ আলোচনা</a></li>
<li class="third_li"><a href="http://www.ntvbd.com/arts-and-literature/interview" target="_blank" style="color:#fff">সাক্ষাৎকার</a></li>
</ul>
</div>
-->
<!--call right_photo_video_content-->
<div><style>
.preFix{ color:#CD0000}
.rightContent{}
.rightContent .selectedPhotoVideo{ list-style:none}
.rightContent .selectedPhotoVideo li{ margin:10px 0px 0px 0px}
.rightContent .selectedPhotoVideo li .photoInfo{ height:50px; width:100%; background:#c8c8c8}
.rightContent .selectedPhotoVideo li .photoIcon{ float:left; background-position:-505px -72px; width:50px; height:50px; display:inline-block}
.rightContent .selectedPhotoVideo li .videoInfo{ height:50px; width:100%; background:#c8c8c8}
.rightContent .selectedPhotoVideo li .videoIcon{ float:left; background-position:-578px -72px; width:50px; height:50px; display:inline-block}
.rightContent .selectedPhotoVideo li .caption{ margin:0px 0px 0px 55px; padding:5px 5px 5px 5px; height:50px; display:block; line-height:21px; overflow:hidden}
.rightContent .selectedPhotoVideo li .caption a{ font-size:14px}
/*Right Panel*/
</style>
<div class="rightContent">
	<ul class="selectedPhotoVideo"><li><div><a href="http://photo.ntvbd.com/entertainment/bollywood/parineeti-chopra/parineetis-private-moments/1460700684.ntv"><img src="//cdn.bn.ntvbd.com/photo/1460700624?width=300&height=210" width="100%"/></a><div class="photoInfo"><div class="icon photoIcon"></div><div class="caption themeWhite"><a href="http://photo.ntvbd.com/entertainment/bollywood/parineeti-chopra/parineetis-private-moments/1460700684.ntv"><span class="preFix"></span>আপন আলোয় পরিণীতি</a></div></div></div><li><li><div><a href="http://video.ntvbd.com/drama/drama-serial/shomrat/shomrat-episode-39-drama-serial-&-telefilm/1460650468.ntv"><div style="background:url(//cdn.bn.ntvbd.com/video/1460650468?width=300&height=210) center no-repeat; background-size:cover; width:300px; height:210px"></div></a><div class="videoInfo"><div class="icon videoIcon"></div><div class="caption themeWhite"><a href="http://video.ntvbd.com/drama/drama-serial/shomrat/shomrat-episode-39-drama-serial-&-telefilm/1460650468.ntv"><span class="preFix">ধারাবাহিক নাটক : </span>সম্রাট, পর্ব ৩৯</a></div></div></div><li><li><div><a href="http://photo.ntvbd.com/entertainment/bangladesh/event/boishakh-celebration-in-fdc/1460703560.ntv"><img src="//cdn.bn.ntvbd.com/photo/1460703486?width=300&height=210" width="100%"/></a><div class="photoInfo"><div class="icon photoIcon"></div><div class="caption themeWhite"><a href="http://photo.ntvbd.com/entertainment/bangladesh/event/boishakh-celebration-in-fdc/1460703560.ntv"><span class="preFix"></span>এফডিসিতে বৈশাখ উদযাপন</a></div></div></div><li><li><div><a href="http://video.ntvbd.com/song/music-n-rhythm/music-n-rhythm-episode-28-singer-:-baul-shafi-mondol-music-show/1460682114.ntv"><div style="background:url(//cdn.bn.ntvbd.com/video/1460682114?width=300&height=210) center no-repeat; background-size:cover; width:300px; height:210px"></div></a><div class="videoInfo"><div class="icon videoIcon"></div><div class="caption themeWhite"><a href="http://video.ntvbd.com/song/music-n-rhythm/music-n-rhythm-episode-28-singer-:-baul-shafi-mondol-music-show/1460682114.ntv"><span class="preFix">সংগীতানুষ্ঠান : </span>মিউজিক এন রিদম,  শিল্পী : বাউল শফি মন্ডল (পর্ব ২৮)</a></div></div></div><li><li><div><a href="http://photo.ntvbd.com/bangladesh/news/boishakh-celebration-in-capital/1460641378.ntv"><img src="//cdn.bn.ntvbd.com/photo/1460646092?width=300&height=210" width="100%"/></a><div class="photoInfo"><div class="icon photoIcon"></div><div class="caption themeWhite"><a href="http://photo.ntvbd.com/bangladesh/news/boishakh-celebration-in-capital/1460641378.ntv"><span class="preFix"></span>রাজধানীতে বৈশাখ উদযাপন</a></div></div></div><li><li><div><a href="http://video.ntvbd.com/special-programme/bangla-noboborsho/special-programme-oitijyer-bangla-banglar-oitijyo/1460643843.ntv"><div style="background:url(//cdn.bn.ntvbd.com/video/1460643843?width=300&height=210) center no-repeat; background-size:cover; width:300px; height:210px"></div></a><div class="videoInfo"><div class="icon videoIcon"></div><div class="caption themeWhite"><a href="http://video.ntvbd.com/special-programme/bangla-noboborsho/special-programme-oitijyer-bangla-banglar-oitijyo/1460643843.ntv"><span class="preFix">বিশেষ প্রামাণ্য অনুষ্ঠান : </span>ঐতিহ্যের বাংলা, বাংলার ঐতিহ্য</a></div></div></div><li><li><div><a href="http://photo.ntvbd.com/entertainment/bangladesh/labonno-liza/labonno-into-the-wild/1460617436.ntv"><img src="//cdn.bn.ntvbd.com/photo/1460617343?width=300&height=210" width="100%"/></a><div class="photoInfo"><div class="icon photoIcon"></div><div class="caption themeWhite"><a href="http://photo.ntvbd.com/entertainment/bangladesh/labonno-liza/labonno-into-the-wild/1460617436.ntv"><span class="preFix"></span>অরণ্যে লাবণ্য</a></div></div></div><li><li><div><a href="http://video.ntvbd.com/drama/special-drama/special-drama-obak-shondesh/1460644161.ntv"><div style="background:url(//cdn.bn.ntvbd.com/video/1460644161?width=300&height=210) center no-repeat; background-size:cover; width:300px; height:210px"></div></a><div class="videoInfo"><div class="icon videoIcon"></div><div class="caption themeWhite"><a href="http://video.ntvbd.com/drama/special-drama/special-drama-obak-shondesh/1460644161.ntv"><span class="preFix">বিশেষ নাটক : </span>অবাক সন্দেশ</a></div></div></div><li><li><div><a href="http://photo.ntvbd.com/entertainment/bollywood/shahrukh-khan/shah-rukh-khan-at-madame-tussauds/1460627519.ntv"><img src="//cdn.bn.ntvbd.com/photo/1460627392?width=300&height=210" width="100%"/></a><div class="photoInfo"><div class="icon photoIcon"></div><div class="caption themeWhite"><a href="http://photo.ntvbd.com/entertainment/bollywood/shahrukh-khan/shah-rukh-khan-at-madame-tussauds/1460627519.ntv"><span class="preFix"></span>মাদাম টুসোদস জাদুঘরে শাহরুখ খান</a></div></div></div><li><li><div><a href="http://video.ntvbd.com/health/swasthyo-protidin/shastho-protidin-episode-2358-health-program/1460693552.ntv"><div style="background:url(//cdn.bn.ntvbd.com/video/1460693552?width=300&height=210) center no-repeat; background-size:cover; width:300px; height:210px"></div></a><div class="videoInfo"><div class="icon videoIcon"></div><div class="caption themeWhite"><a href="http://video.ntvbd.com/health/swasthyo-protidin/shastho-protidin-episode-2358-health-program/1460693552.ntv"><span class="preFix"></span>স্বাস্থ্য প্রতিদিন, পর্ব ২৩৫৮</a></div></div></div><li><li><div><a href="http://photo.ntvbd.com/entertainment/bangladesh/sporshia/lively-orchita-sporshia-in-sunny-noon/1460538429.ntv"><img src="//cdn.bn.ntvbd.com/photo/1460538324?width=300&height=210" width="100%"/></a><div class="photoInfo"><div class="icon photoIcon"></div><div class="caption themeWhite"><a href="http://photo.ntvbd.com/entertainment/bangladesh/sporshia/lively-orchita-sporshia-in-sunny-noon/1460538429.ntv"><span class="preFix"></span>তপ্ত দুপুরে প্রাণোচ্ছল স্পর্শীয়া</a></div></div></div><li><li><div><a href="http://video.ntvbd.com/song/chutir-diner-gaan/chhutir-diner-gaan-episode-143/1460703421.ntv"><div style="background:url(//cdn.bn.ntvbd.com/video/1460703421?width=300&height=210) center no-repeat; background-size:cover; width:300px; height:210px"></div></a><div class="videoInfo"><div class="icon videoIcon"></div><div class="caption themeWhite"><a href="http://video.ntvbd.com/song/chutir-diner-gaan/chhutir-diner-gaan-episode-143/1460703421.ntv"><span class="preFix"></span>ছুটির দিনের গান, পর্ব ১৪৩</a></div></div></div><li><li><div><a href="http://photo.ntvbd.com/entertainment/bangladesh/event/premier-of-shankhachil-movie/1460548509.ntv"><img src="//cdn.bn.ntvbd.com/photo/1460548334?width=300&height=210" width="100%"/></a><div class="photoInfo"><div class="icon photoIcon"></div><div class="caption themeWhite"><a href="http://photo.ntvbd.com/entertainment/bangladesh/event/premier-of-shankhachil-movie/1460548509.ntv"><span class="preFix"></span>শঙ্খচিলের প্রিমিয়ার</a></div></div></div><li><li><div><a href="http://video.ntvbd.com/special-programme/bangla-noboborsho/special-concert-ruchi-boishakhi-utsab-part-04/1460628893.ntv"><div style="background:url(//cdn.bn.ntvbd.com/video/1460628893?width=300&height=210) center no-repeat; background-size:cover; width:300px; height:210px"></div></a><div class="videoInfo"><div class="icon videoIcon"></div><div class="caption themeWhite"><a href="http://video.ntvbd.com/special-programme/bangla-noboborsho/special-concert-ruchi-boishakhi-utsab-part-04/1460628893.ntv"><span class="preFix">বিশেষ কনসার্ট : </span>রুচি বৈশাখী উৎসব, পার্ট ০৪</a></div></div></div><li>  
</div>
</div>
<!--<div class="space"></div>
<div><a href="http://www.ntvbd.com/women-child-abuse" target="_blank"><img src="http://ntv-bn-cdn.s3.amazonaws.com/images/nari-o-shishu-nirjaton-1.jpg" alt="womenchildabuse" title="womenchildabuse" /></a></div>-->
<!--<div style="background-color:#fff">
<iframe width="300" height="150" src="http://www.ntvbd.com/advertise/eid-2015/" name="iframe_a" frameborder="0" scrolling="no"></iframe>
<a href="http://www.ntvbd.com/eid-special" target="iframe_a"></a>
</div>-->

<!--call news_letter_subscribe-->
<div>
	</div>
<!-- /23635548/Desktop_Home_OutOfPage -->
<div id='div-gpt-ad-1454128541201-0-oop'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1454128541201-0-oop'); });
</script>
</div>
<script type="text/javascript" src="http://www.lijit.com/blog_wijits?json=0&id=trakr&uri=http%3A%2F%2Fwww.lijit.com%2Fusers%2Fbablu_chakma&js=1"></script></div><!--end right_content-->

<div class="clr"></div>
</div><!--end main_content-->
            </div><!--end main_content row-->
            
            <div class="row visible-xs">
                <div id="mobile_footer">
<style type="text/css">
	#mobile_footer{
		display:block; position:relative; background:#016938
	}
	#mobile_footer .ntvInfo{
		color:#fff; padding:15px;
		border-bottom:1px solid #fff;
	}
	#mobile_footer .ntvInfo .ntvChairman{
		font-size:16px;
	}
	#mobile_footer .ntvInfo .ntvAddress,
	#mobile_footer .ntvInfo .ntvPhone{
		font-size:14px
	}
	
	#mobile_footer .moreLinks{
		display:none; background:#eee; color:#060
	}
	#mobile_footer .moreLinks ul{
		margin:0;
	}
	#mobile_footer .moreLinks ul > li{
		list-style: none;		
	}
	#mobile_footer .moreLinks ul > li > a{
		display:block;
		padding: 5px 15px;
		background: #666;
		color: #fff; font-size:14px;
		margin-bottom: 1px;
	}	
	#mobile_footer .copyrightInfo{
		display:table; padding:15px; color:#fff
	}
	#mobile_footer .copyrightInfo > div{
		display:table-cell; vertical-align:top
	}
	#mobile_footer .copyrightInfo > .footer-morelink-bar{
		font-size:18px;
	}
	#mobile_footer .copyrightInfo > .copyright{
		padding-left:15px; font-size:14px
	}
</style>
<div class="ntvInfo">
    <div class="ntvChairman"><a style="color:#FFF" href="http://www.ntvbd.com/info/Al-haj-Mohammad-Mosaddak-Ali" target="_blank">চেয়ারম্যান ও ব্যবস্থাপনা পরিচালক: আলহাজ মোহাম্মদ মোসাদ্দেক আলী</a></div>
    <div class="ntvAddress">বিএসইসি ভবন (৭ম তলা), ১০২ কাজী নজরুল ইসলাম এভিনিউ, কারওয়ান বাজার, ঢাকা-১২১৫ ।</div>
    <div class="ntvPhone">টেলিফোন: +৮৮০২৯১৪৩৩৮১-৫, ফ্যাক্স: +৮৮০২৯১৪৩৩৮৬-৭</div>
</div>
<div class="moreLinks">
    <ul>
        <li><a href="http://www.ntvbd.com/info/ntv-profile" target="_blank">এনটিভি সম্পর্কে</a></li>
	<li><a href="#">বিজ্ঞাপন</a></li>
		<li><a href="http://www.ntvbd.com/info/contact-us" target="_blank">যোগাযোগ</a></li>
	<li><a href="http://mail.ntvbd.com/src/login.php" target="_blank">ওয়েব মেইল</a></li>
	<li><a href="http://upload.ntvbd.com/Login" target="_blank">এনটিভি এফটিপি</a></li>
	<li><a href="http://www.ntveurope.net/" target="_blank">ইউরোপ সাবস্ক্রিপশন</a></li>
	<li><a href="http://www.dish.com/entertainment/packages/international/?region=southasian&lang=bangla#international" target="_blank">ইউএসএ সাবস্ক্রিপশন</a></li>
	<li><a href="http://www.ntvbd.com/info/satellite" target="_blank">স্যাটেলাইট ডাউনলিংক</a></li>
	<li><a href="http://www.ntvbd.com/info/privacy-policy" target="_blank">গোপনীয়তার নীতি</a></li>
	<li><a href="http://www.ntvbd.com/info/terms-conditions" target="_blank">শর্ত ও নিয়মাবলী</a><li>
    </ul>
</div>

<div class="copyrightInfo">
    <div class="footer-morelink-bar"><i class="fa fa-bars fa-lg"></i></div>
    <div class="copyright">&copy;&nbsp;সর্বস্বত্ব সংরক্ষিত । এই ওয়েবসাইটের কোনো লেখা, ছবি, ভিডিও অনুমতি ছাড়া ব্যবহার বেআইনি</div>
</div>
</div><!--end mobile_footer-->
            </div><!--end mobile_footer row-->
            
            	            <div class="row hidden-xs">
	                <div id="footer"><style>
.adsSpace650x100{
	background:none !important;
}
.footer .footer_srch_block,.footer .weather_rpt_block,.footer .apps_feed_list,.footer .com_info{ padding-right:0 }
.footer .footer_srch_block{
	float:left; width:250px; margin-right:5px
}
.footer .bottom_ads{
	text-align:center;
	height:92px;
	border: 1px solid #ccc;
	margin-bottom: 4px;
}
.footer .footerSearchBox{ height:90px; padding:15px 15px 15px 15px; width:100%; display:inline-block}
.footer .footerSearch{ position:relative; color:#fff; border-radius:10px 0 0 10px; padding: 0px 0px 0px 10px; margin:0px 0px 10px 0px; width:100%; display:inline-block}
.footer .footerSearch input{ background:none; border:0px; color:#fff; padding:3px 2px 3px 2px; font-size:14px; width:80%}
.footer .searchIcon{ height:26px; width:30px; background-position:-558px 0px; display:inline-block; cursor:pointer}

.footer .footerSearchBox .searchBy{ margin:0px 12px 0px 0px}
.footer .footerSearchBox .ntvIcon{ background-position:-634px 0px; height:15px; width:30px; margin:0px 0px 0px 5px; display:inline-block}
.footer .footerSearchBox .googleIcon{ background-position:-675px 0px; height:15px; width:47px; margin:0px 0px 0px 5px; display:inline-block}
.footer .footerSearchBox .youtubeIcon{ background-position:-729px 0px; height:15px; width:38px; margin:0px 0px 0px 5px; display:inline-block}

.footer .othersContent{ color:#999}
.footer .othersContent .caption{ padding:5px 10px 5px 10px; display:block; font-size:16px; color:#fff; border-bottom:1px solid #999}
.footer .othersContent .content{ padding:10px 10px}

.footer .othersContent .weatherContent{ position:relative}
.footer .othersContent .weatherContent .degree{ font-size:26px; color:#FFF; margin:0px 0px 5px 0px}
.footer .othersContent .weatherContent .city{ font-size:22px; color:#FFF; display:block}
.footer .othersContent .weatherContent .weatherIcon{ position:absolute; right:10px; top:20px}

.footer .othersContent .appsContent{ text-align:center}
.footer .othersContent .appsContent .androidAppsIcon{ background-position:0px -72px; width:32px; height:32px; margin:10px 10px 0px 10px; display:inline-block}
.footer .othersContent .appsContent .iphoneAppsIcon{ background-position:-35px -72px; width:32px; height:32px; margin:10px 10px 0px 10px; display:inline-block}
.footer .othersContent .appsContent .windowAppsIcon{ background-position:-70px -72px; width:32px; height:32px; margin:10px 10px 0px 10px; display:inline-block}
.footer .othersContent .appsContent .rssIcon{ background-position:-105px -72px; width:32px; height:32px; margin:10px 10px 0px 10px; display:inline-block}

.footer .othersContent .socialContent{ text-align:center}
.footer .othersContent .socialContent .facebookIcon{ background-position:-145px -72px; width:32px; height:32px; margin:10px 5px 0px 5px; display:inline-block}
.footer .othersContent .socialContent .twitterIcon{ background-position:-180px -72px; width:32px; height:32px; margin:10px 5px 0px 5px; display:inline-block}
.footer .othersContent .socialContent .googlePlusIcon{ background-position:-215px -72px; width:32px; height:32px; margin:10px 5px 0px 5px; display:inline-block}
.footer .othersContent .socialContent .youtubeIcon{ background-position:-250px -72px; width:80px; height:32px; margin:10px 5px 0px 5px; display:inline-block}
.footer .othersContent .socialContent .dailymotionIcon{ background-position:-360px -72px; width:32px; height:32px; margin:10px 5px 0px 5px; display:inline-block}
.footer .othersContent .socialContent .inIcon{ background-position:-395px -72px; width:32px; height:32px; margin:10px 5px 0px 5px; display:inline-block}
.footer .othersContent .socialContent .pinIcon{ background-position:-430px -72px; width:32px; height:32px; margin:10px 5px 0px 5px; display:inline-block}

.footer .footerInfo{ padding:7px; font-size:16px; color:#FFF; line-height:21px}
.footer .footerLogo{ padding:0px 0px 0px 0px; display:inline-block}
.footer .footerLogo img{ width:90px}
.footer .ntvInfo{ padding:0px 20px 0px 20px; margin:0px 0px 0px 20px; border-left: 3px solid #fff; border-right: 3px solid #fff;}
.footer .ntvInfo .ntvChairman{}
.footer .ntvInfo .ntvChairman a:hover{ color:yellow !important}
.footer .ntvInfo .ntvAddress{ font-size:13px}
.footer .ntvInfo .ntvPhone{ font-size:13px}
.footer .copyrightInfo{ display:block; text-align:center }
.footer .copyrightInfo .copyright{ font-size:13px; }
.footer .copyrightInfo .message{ font-size:13px}

.footer .moreLinks{ border-bottom:5px solid #1e1e1e; margin:10px 0px 10px 0px; padding:5px 10px; position:relative; text-align:center}
.footer .moreLinks ul{ list-style: outside none none; display:inline-block}
.footer .moreLinks li{ border-right:1px solid #ccc; margin:5px 0px 5px 0px; padding:0px 6px 0px 6px; float:left}
.footer .moreLinks li:last-child{ border-right:0; margin:5px 0px 5px 0px; padding:0px 6px 0px 6px}
.footer .moreLinks li a{ color:#646565; font-size:14px}

.footer .bg_img{
	text-align:right
}
.footer .bg_img > img{
	margin-bottom: -7px; margin-right: -7px;
}
.footer .bottom_srch_entry_type{
	display:none;
	position: absolute;
	top: -20px;
	cursor: pointer;
	left: 50%;
}
.footer .bottom_srch_entry_type > .bn_entry_type{
	display: inline-block;
	background: #333;
	font-size:13px;
	color: #fff;
	width: 20px;
	height: 20px;
	text-align:center
}
.footer .bottom_srch_entry_type > .bn_entry_type.active{
	background:#CD0000
}

@media (max-width:640px){
	.footer .footer_srch_block,.footer .weather_rpt_block,.footer .apps_feed_list,.footer .com_info{ padding-right:15px }
	.footer .footer_srch_block{
		float:none; width:100%; margin-right:0
	}
	.footer .bottom_ads{
		float:none; margin-left:0
	}
	.footer .weather_rpt_block,.footer .apps_feed_list{margin-bottom:10px}
	.footer .ntvInfo{
		border-left: 0;
		border-right: 0;
		border-top: 3px solid #fff;
		border-bottom: 3px solid #fff;
		margin: 10px 5px;
		padding: 15px 0px;
	}
}
</style>
<div class="footer"> 
    <!--<div class="footer_srch_block">
        <div class="footerSearchBox themeWhite">
            <div class="footerSearch themeLightGreen">
                <div class="searchIcon icon right"></div>
                <input name="q" id="ntv_bottom_srch_keyword" class="pull-right bn-font srch_keyword" type="text" placeholder="কি খুঁজতে চান?" value="" />
                <div class="bottom_srch_entry_type">
                    	<span class="bn_entry_type active unijoy tooltips-bottom" data-toggle="tooltip" data-placement="top" data-original-title="ইউনিজয়" onClick="switched=false;">অ</span>
			<span class="bn_entry_type phonetic tooltips-bottom" data-toggle="tooltip" data-placement="top" data-original-title="ফনেটিক" onClick="switched=false;">ফ</span>
			<span class="bn_entry_type english eng-font tooltips-bottom" data-toggle="tooltip" data-placement="top" data-original-title="English" onclick="switched=true;">A</span>
                </div>
            </div>
            <div class="clear"></div>
            <div class="_row">
                <div class="left searchBy"><input type="radio" name="srch_type" value="ntv" checked /><span class="icon ntvIcon"></span></div>
                <div class="left searchBy"><input type="radio" name="srch_type" value="google" checked /><span class="icon googleIcon"></span></div>
                <div class="left searchBy"><input type="radio" name="srch_type" value="youtube"  /><span class="icon youtubeIcon"></span></div>
            </div>    
        </div>
    </div>-->
	<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="bottom_ads adsSpace970x90" style="background-color:#EBEBEB;border-style:none"><!-- Ntv_home_728x90_468x60_320x100_B2 -->
<div id='div-gpt-ad-1422078900996-3'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1422078900996-3'); });
</script>
</div>
</div>
	</div>
	</div>
    
    <div class="clr"></div>
    
    <!--<div class="row">
        <div class="col-md-12 col-sm-12" id="menu_category">
		        </div>
    </div>-->
    
    <div class="space"></div>
        <div class="row">
        <div class="col-md-3 col-sm-3 weather_rpt_block">
            <div class="othersContent themeBlack">
                <div class="caption">আবহাওয়া</div><!--end others_caption-->
                <div class="content weatherContent">
                    <div class="degree"> ২৯&deg;সে</div>
                    <div class="city">ঢাকা</div>
                    <img class="weatherIcon" src="http://ntv-bn-cdn.s3.amazonaws.com/images/weather/partlycloudy.png" />
                </div>
            </div>
        </div>
        
        <div class="col-md-4 col-sm-4 apps_feed_list">
            <div class="othersContent themeBlack">
                <div class="caption">অ্যাপস ও ফিড</div>
                <div class="content appsContent">
                	<a class="icon androidAppsIcon"></a>
                    <a class="icon iphoneAppsIcon"></a>
                    <a class="icon windowAppsIcon"></a>
                    <a class="icon rssIcon" href="http://www.ntvbd.com/rss" target="_blank"></a>
                </div>
            </div>
        </div>
        <div class="col-md-5 col-sm-5">
            <div class="othersContent themeBlack">
                <div class="caption">সামাজিক নেটওয়ার্ক</div>
                <div class="content socialContent">
                	<a class="icon facebookIcon" href="https://www.facebook.com/ntvdigital" target="_blank"></a>
                    <a class="icon twitterIcon" href="https://twitter.com/ntvdigitals" target="_blank"></a>
                    <a class="icon googlePlusIcon" href="https://google.com/+Ntvbd" target="_blank"></a>
                    <a class="icon youtubeIcon" href="https://www.youtube.com/channel/UCYqujAD5831EywH1jldBu5w?sub_confirmation=1" target="_blank"></a>
                    <a class="icon dailymotionIcon" href="http://www.dailymotion.com/ntv" target="_blank"></a>
                    <a class="icon inIcon" href="https://www.linkedin.com/company/international-television-channel-ltd.-ntv-?trk=biz-companies-cym" target="_blank"></a>
                    <a class="icon pinIcon" href="http://www.pinterest.com/ntvdigital/" target="_blank"></a>
                </div>
            </div>
        </div>
    </div>

	<div class="space"></div>
    <div class="footerInfo themeGreen">
        <div class="row">
            <div class="col-xs-6 col-md-1 col-sm-1">
                <div class="footerLogo">
                	<a href="http://www.ntvbd.com/"><img src="http://ntv-bn-cdn.s3.amazonaws.com/images/footer-logo.png" /></a>
                </div>
            </div>
            <div class="col-xs-12 col-md-7 col-sm-7 com_info">
                <div class="ntvInfo">
                    <div class="ntvChairman"><a style="color:#FFF" href="http://www.ntvbd.com/info/Al-haj-Mohammad-Mosaddak-Ali" target="_blank">চেয়ারম্যান ও ব্যবস্থাপনা পরিচালক : আলহাজ্ব মোহাম্মদ মোসাদ্দেক আলী</a></div>
                    <div class="ntvAddress">বিএসইসি ভবন (৪র্থ তলা), ১০২ কাজী নজরুল ইসলাম এভিনিউ, কারওয়ান বাজার, ঢাকা-১২১৫ ।</div>
                    <div class="ntvPhone">টেলিফোন: +৮৮০২৯১৪৩৩৮১-৫, ফ্যাক্স: +৮৮০২৯১৪৩৩৮৬-৭</div>
                </div>                
            </div>
            <div class="col-xs-12 col-md-4 col-sm-4">
                                <div class="bg_img"><img src="http://ntv-bn-cdn.s3.amazonaws.com/images/voice_service.png" height="70" title="" alt="" border="0" /></div>
            </div>
        </div>
    </div>
    <div class="moreLinks">
    	<ul>
            <li><a href="http://www.ntvbd.com/info/ntv-profile" target="_blank">এনটিভি সম্পর্কে</a></li>
            <li><a href="http://www.ntvbd.com/info/advertisement" target="_blank">বিজ্ঞাপন</a></li>
                        <li><a href="http://www.ntvbd.com/info/contact-us" target="_blank">যোগাযোগ</a></li>
            <li><a href="http://mail.ntvbd.com/src/login.php" target="_blank">ওয়েব মেইল</a></li>
            <li><a href="http://upload.ntvbd.com/Login" target="_blank">এনটিভি এফটিপি</a></li>
            <li><a href="http://www.ntveurope.net/" target="_blank">ইউরোপ সাবস্ক্রিপশন</a></li>
            <li><a href="http://www.dish.com/entertainment/packages/international/?region=southasian&lang=bangla#international" target="_blank">ইউএসএ সাবস্ক্রিপশন</a></li>
            <li><a href="http://www.ntvbd.com/info/satellite" target="_blank">স্যাটেলাইট ডাউনলিংক</a></li>
            <li><a href="http://www.ntvbd.com/info/privacy-policy" target="_blank">গোপনীয়তার নীতি</a></li>
            <li><a href="http://www.ntvbd.com/info/terms-conditions" target="_blank">শর্ত ও নিয়মাবলী</a></li>
        </ul>
	</div>
    
    <div class="copyrightInfo">
    	<div class="copyright">&copy;&nbsp;সর্বস্বত্ব সংরক্ষিত । এই ওয়েবসাইটের কোনো লেখা, ছবি, ভিডিও অনুমতি ছাড়া ব্যবহার  বেআইনি</div>
	</div>
</div>
</div><!--end footer-->
	            </div><!--end footer row-->
            			
						
        </div>
</center>
    </body>        
</html>
