    function mega_menu_summary(cat_id, pid, par_id){
    	var BASE_URL = $("#base_url").val();
        var URL = BASE_URL+'ajax/mega_menu_summary?rand='+Math.random();

        // Load mega data summary
        $.ajax({
            url: URL,
            type:"POST",
            data:{ cat_id : cat_id, par_id : par_id, rand : Math.random() },
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
        var URL = '';

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
        if($('.most_view_tab_block .second-layer .btn.active').hasClass('news')) var URL = '?cat_id=';
        else if($('.most_view_tab_block .second-layer .btn.active').hasClass('videos')) var URL = '';
        else if($('.most_view_tab_block .second-layer .btn.active').hasClass('photos')) var URL = '';

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
        if($('.most_view_tab_block .second-layer .btn.active').hasClass('news')) var URL = '?host=&cat_id=';
        else if($('.most_view_tab_block .second-layer .btn.active').hasClass('videos')) var URL = '?host=video.ntvbd.com';
        else if($('.most_view_tab_block .second-layer .btn.active').hasClass('photos')) var URL = '?host=photo.ntvbd.com';

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
                var URL = '?q='+keyword+'&cx='+encodeURIComponent('partner-pub-2048928514082800:7777012178')+'&cof='+encodeURIComponent('FORID:10')+'&ie=UTF-8&sa=Search';
                window.location.href = URL;
            }else if(srch_type=='youtube'){
                var URL = '/?q='+keyword+'';
                window.location.href = URL;
            }
            else{
                /*var URL = ''+keyword;*/
                var URL = '?q='+keyword+'&cx='+encodeURIComponent('partner-pub-2048928514082800:7777012178')+'&cof='+encodeURIComponent('FORID:10')+'&ie=UTF-8&sa=Search';
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
                var par_id 	= $(this).attr('data-par');
                var pid		= $(this).attr('parent-data');
                $('#menu_category div.mega_list_block > div.sub_mega_list > ul > li').removeClass('active');
                $(this).addClass('active');
                if(cat_id>0) mega_menu_summary(cat_id, pid, par_id);
            }
        });

        $('#menu_category > ul > li.mega_parent').hover(function(){
            /**
             * SETUP CURRECT POSITION
             */
            // get the current position
            var pos = $('div.mega_list_block',this).position();
            // setup compare position
            var com_pos = pos.left+450, limit_pos = 1190;
            if(com_pos>limit_pos){
                var diff_pos = com_pos - limit_pos;
                $('div.mega_list_block',this).css('margin-left','-'+diff_pos+'px');
            }

            $('div.mega_list_block > div.sub_mega_list > ul > li').removeClass('active');
            var cat_id 	= $('div.mega_list_block > div.sub_mega_list > ul > li:first-child',this).addClass('active').attr('data-val');
            var par_id 	= $('div.mega_list_block > div.sub_mega_list > ul > li:first-child',this).addClass('active').attr('data-par');
            var pid 	= $('div.mega_list_block > div.sub_mega_list > ul > li:first-child',this).addClass('active').attr('parent-data');
            if(cat_id>0) mega_menu_summary(cat_id, pid, par_id);
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
        var URL = '?cat_id=';
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
                var URL = '?q='+keyword;
                if(category!='') URL = URL + '&category=' + category;
                window.location.href = URL;
            }
        });

        $('.google-srch-btn').on('click', function(e){
            var category = $('.srch_category').val();
            var keyword = $('.srch_keyword').val().trim().toLowerCase().replace(/\s/g,'+');
            if(category!='') keyword = keyword + ' site:'+category;
            if(keyword==''){
                $('.srch_keyword').css('background','#FF9').focus()
            }else{
                var URL = '?q='+encodeURIComponent(keyword)+'&cx='+encodeURIComponent('partner-pub-2048928514082800:7777012178')+'&cof='+encodeURIComponent('FORID:10')+'&ie=UTF-8&sa=Search';
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
                var URL = '';
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
                var URL = '';
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
                    var URL = '' + sel_date;
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